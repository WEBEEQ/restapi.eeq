<?php
declare(strict_types = 1);

// rest/Model/UpdateUserModel.php
namespace Rest\Model;

use AppBundle\Core\DataBase;

class UpdateUserModel extends DataBase
{
    public function isUserId(int $id): bool
    {
        $result = $this->dbQuery(
            'SELECT * FROM `users`
            WHERE `users`.`user_id` = ' . $id
        );
        if ($this->dbFetchArray($result)) {
            return true;
        }

        return false;
    }

    public function updateUserData(
        int $id,
        int $province,
        int $city,
        string $name,
        string $surname,
        string $description,
        string $ip,
        string $date
    ): bool {
        $province = ($province >= 1) ? (string) $province : 'NULL';
        $city = ($city >= 1) ? (string) $city : 'NULL';

        return $this->dbQuery(
            'UPDATE `users`
            SET `users`.`province_id` = ' . $province . ', `users`.`city_id` = ' . $city . ",
                `users`.`user_name` = '" . $name . "', `users`.`user_surname` = '" . $surname . "',
                `users`.`user_description` = '" . $description . "', `users`.`user_ip` = '" . $ip . "',
                `users`.`user_date` = '" . $date . "'
            WHERE `users`.`user_id` = " . $id
        );
    }
}
