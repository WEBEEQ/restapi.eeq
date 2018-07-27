<?php
declare(strict_types = 1);

// json/Model/UserListModel.php
namespace Json\Model;

use AppBundle\Core\DataBase;

class UserListModel extends DataBase
{
    public function getUserList(int $level, int $listLimit): array
    {
        $arrayResult = array();
        $i = 1;

        $result = $this->dbQuery(
            "SELECT * FROM `users`
            LEFT JOIN `provinces` ON `users`.`province_id` = `provinces`.`province_id`
            LEFT JOIN `cities` ON `users`.`city_id` = `cities`.`city_id`
            WHERE `users`.`user_active` = 1 AND `users`.`user_date` <= '" . date('Y-m-d H:i:s') . "'
            ORDER BY `users`.`user_number` DESC, `users`.`user_date` ASC LIMIT "
                . (($level - 1) * $listLimit) . ', ' . $listLimit
        );
        while ($row = $this->dbFetchArray($result)) {
            $arrayResult[$i]['user_name'] = $row['user_name'];
            $arrayResult[$i]['user_surname'] = $row['user_surname'];
            $arrayResult[$i]['user_ranking'] = $row['user_ranking'];
            $arrayResult[$i]['province_name'] = $row['province_name'];
            $arrayResult[$i]['city_name'] = $row['city_name'];
            $i++;
        }

        return $arrayResult;
    }
}
