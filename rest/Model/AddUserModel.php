<?php
declare(strict_types = 1);

// rest/Model/AddUserModel.php
namespace Rest\Model;

use AppBundle\Core\DataBase;

class AddUserModel extends DataBase
{
    public function addUserData(
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
            'INSERT INTO `users` (
                `province_id`,
                `city_id`,
                `user_active`,
                `user_name`,
                `user_surname`,
                `user_description`,
                `user_ranking`,
                `user_number`,
                `user_ip`,
                `user_date`
            )
            VALUES (' . $province . ', ' . $city . ", 1, '" . $name . "', '" . $surname
                . "', '" . $description . "', 0, 0, '" . $ip . "', '" . $date . "')"
        );
    }
}
