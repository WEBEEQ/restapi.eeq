<?php
declare(strict_types = 1);

// rest/Model/DeleteUserModel.php
namespace Rest\Model;

use AppBundle\Core\DataBase;

class DeleteUserModel extends DataBase
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

    public function deleteUserData(int $id): bool
    {
        return $this->dbQuery(
            'DELETE FROM `users`
            WHERE `users`.`user_id` = ' . $id
        );
    }
}
