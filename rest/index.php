<?php
declare(strict_types = 1);

require('../rest/Core/core.php');

use AppBundle\Core\Param;
use Rest\Controller\{
    AddUserController,
    DeleteUserController,
    UpdateUserController
};

switch ($_GET['option']) {
    case 'add-user':
        $user = $_SERVER['PHP_AUTH_USER'] ?? '';
        $password = $_SERVER['PHP_AUTH_PW'] ?? '';

        $data = json_decode(file_get_contents("php://input"), true);

        $name = Param::prepareString((string) $data['name']);
        $surname = Param::prepareString((string) $data['surname']);
        $province = Param::prepareInt((string) $data['province']);
        $city = Param::prepareInt((string) $data['city']);
        $description = Param::prepareString((string) $data['description']);

        $remoteAddress = $_SERVER['REMOTE_ADDR'];
        $date = date('Y-m-d H:i:s');

        $addUserController = new AddUserController();
        $array = $addUserController->addUserAction(
            $user,
            $password,
            $name,
            $surname,
            $province,
            $city,
            $description,
            $remoteAddress,
            $date
        );
        break;
    case 'update-user':
        $user = $_SERVER['PHP_AUTH_USER'] ?? '';
        $password = $_SERVER['PHP_AUTH_PW'] ?? '';

        $data = json_decode(file_get_contents("php://input"), true);

        $id = Param::prepareInt((string) $data['id']);
        $name = Param::prepareString((string) $data['name']);
        $surname = Param::prepareString((string) $data['surname']);
        $province = Param::prepareInt((string) $data['province']);
        $city = Param::prepareInt((string) $data['city']);
        $description = Param::prepareString((string) $data['description']);

        $remoteAddress = $_SERVER['REMOTE_ADDR'];
        $date = date('Y-m-d H:i:s');

        $updateUserController = new UpdateUserController();
        $array = $updateUserController->updateUserAction(
            $user,
            $password,
            $id,
            $name,
            $surname,
            $province,
            $city,
            $description,
            $remoteAddress,
            $date
        );
        break;
    case 'delete-user':
        $user = $_SERVER['PHP_AUTH_USER'] ?? '';
        $password = $_SERVER['PHP_AUTH_PW'] ?? '';

        $data = json_decode(file_get_contents("php://input"), true);

        $id = Param::prepareInt((string) $data['id']);

        $deleteUserController = new DeleteUserController();
        $array = $deleteUserController->deleteUserAction($user, $password, $id);
        break;
    default:
        $array = null;
        break;
}

echo json_encode($array);
