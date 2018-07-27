<?php
declare(strict_types = 1);

require('../json/Core/core.php');

use AppBundle\Core\Param;
use Json\Controller\UserListController;

switch ($_GET['option']) {
    case 'user-list':
        $level = Param::prepareInt($_GET['level'], 1);

        $userListController = new UserListController();
        $array = $userListController->userListAction($level, 100);
        break;
    default:
        $array = null;
        break;
}

echo json_encode(array('code' => 100, 'success' => true, 'outData' => $array));
