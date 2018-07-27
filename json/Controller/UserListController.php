<?php
declare(strict_types = 1);

// json/Controller/UserListController.php
namespace Json\Controller;

use Json\Model\UserListModel;

class UserListController
{
    public function userListAction(int $level, int $listLimit): array
    {
        $userListModel = new UserListModel();
        $userListModel->dbConnect();

        $userList = $userListModel->getUserList($level, $listLimit);

        $userListModel->dbClose();

        return array('userList' => $userList);
    }
}
