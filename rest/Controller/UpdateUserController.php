<?php
declare(strict_types = 1);

// rest/Controller/UpdateUserController.php
namespace Rest\Controller;

use Rest\Core\Config;
use Rest\Model\UpdateUserModel;

class UpdateUserController
{
    public function updateUserAction(
        string $user,
        string $password,
        int $id,
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
            $updateUserModel = new UpdateUserModel();
            $updateUserModel->dbConnect();

            if (!$updateUserModel->isUserId($id)) {
                $message .= 'Baza nie zawiera danych dla podanego id.' . "\r\n";
            }
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
                $userData = $updateUserModel->updateUserData(
                    $id,
                    $province,
                    $city,
                    $name,
                    $surname,
                    $description,
                    $remoteAddress,
                    $date
                );

                if ($userData) {
                    $message .= 'Dane osoby zostały zmienione.' . "\r\n";
                    $ok = true;
                } else {
                    $message .= 'Zmiana danych osoby nie powiodła się.' . "\r\n";
                }
            }

            $updateUserModel->dbClose();
        } else {
            $message .= 'Błędna autoryzacja przesyłanych danych.' . "\r\n";
        }

        return array('message' => $message, 'success' => $ok);
    }
}
