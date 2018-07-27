<?php
declare(strict_types = 1);

// rest/Controller/AddUserController.php
namespace Rest\Controller;

use Rest\Core\Config;
use Rest\Model\AddUserModel;

class AddUserController
{
    public function addUserAction(
        string $user,
        string $password,
        string $name,
        string $surname,
        int $province,
        int $city,
        string $description,
        string $remoteAddress,
        string $date
    ): array {
        $message = '';
        $ok = false;

        if ($user == Config::getUser() && $password == Config::getPassword()) {
            $addUserModel = new AddUserModel();
            $addUserModel->dbConnect();

            if (strlen($name) < 1) {
                $message .= 'Imię musi zostać podane.' . "\r\n";
            } elseif (strlen($name) > 50) {
                $message .= 'Imię może zawierać maksymalnie 50 znaków.' . "\r\n";
            }
            if (strlen($surname) < 1) {
                $message .= 'Nazwisko musi zostać podane.' . "\r\n";
            } elseif (strlen($surname) > 100) {
                $message .= 'Nazwisko może zawierać maksymalnie 100 znaków.' . "\r\n";
            }
            if ($message == '') {
                $userData = $addUserModel->addUserData(
                    $province,
                    $city,
                    $name,
                    $surname,
                    $description,
                    $remoteAddress,
                    $date
                );

                if ($userData) {
                    $message .= 'Dane osoby zostały dodane.' . "\r\n";
                    $ok = true;
                } else {
                    $message .= 'Dodanie danych osoby nie powiodło się.' . "\r\n";
                }
            }

            $addUserModel->dbClose();
        } else {
            $message .= 'Błędna autoryzacja przesyłanych danych.' . "\r\n";
        }

        return array('message' => $message, 'success' => $ok);
    }
}
