<?php
declare(strict_types = 1);

// rest/Controller/DeleteUserController.php
namespace Rest\Controller;

use Rest\Core\Config;
use Rest\Model\DeleteUserModel;

class DeleteUserController
{
    public function deleteUserAction(string $user, string $password, int $id): array
    {
        $message = '';
        $ok = false;

        if ($user == Config::getUser() && $password == Config::getPassword()) {
            $deleteUserModel = new DeleteUserModel();
            $deleteUserModel->dbConnect();

            if (!$deleteUserModel->isUserId($id)) {
                $message .= 'Baza nie zawiera danych dla podanego id.' . "\r\n";
            }
            if ($message == '') {
                if ($deleteUserModel->deleteUserData($id)) {
                    $message .= 'Dane osoby zostały usunięte.' . "\r\n";
                    $ok = true;
                } else {
                    $message .= 'Usuwanie danych osoby nie powiodło się.' . "\r\n";
                }
            }

            $deleteUserModel->dbClose();
        } else {
            $message .= 'Błędna autoryzacja przesyłanych danych.' . "\r\n";
        }

        return array('message' => $message, 'success' => $ok);
    }
}
