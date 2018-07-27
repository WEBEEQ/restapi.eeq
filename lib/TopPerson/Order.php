<?php
declare(strict_types = 1);

namespace Library\TopPerson;

use Library\TopPerson\{Config, Http};

class Order
{
    public static function addUser(array $data): array
    {
        $response = array();

        try {
            $response = Http::doPost(Config::getAddUserPathUrl(), Config::getAuth(), $data);
        } catch (TopPersonException $e) {
            $response['response']['message'] = $e->getMessage() . ': ' . $e->getCode();
        }

        return $response;
    }

    public static function updateUser(array $data): array
    {
        $response = array();

        try {
            $response = Http::doPut(Config::getUpdateUserPathUrl(), Config::getAuth(), $data);
        } catch (TopPersonException $e) {
            $response['response']['message'] = $e->getMessage() . ': ' . $e->getCode();
        }

        return $response;
    }

    public static function deleteUser(array $data): array
    {
        $response = array();

        try {
            $response = Http::doDelete(Config::getDeleteUserPathUrl(), Config::getAuth(), $data);
        } catch (TopPersonException $e) {
            $response['response']['message'] = $e->getMessage() . ': ' . $e->getCode();
        }

        return $response;
    }
}
