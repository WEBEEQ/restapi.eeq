<?php
declare(strict_types = 1);

namespace Library\TopPerson;

class Config
{
    protected static $url = 'http://127.0.0.10';
    protected static $addUserPath = '/rest/dodawanie';
    protected static $updateUserPath = '/rest/aktualizacja';
    protected static $deleteUserPath = '/rest/usuwanie';
    protected static $user = 'user';
    protected static $password = 'lSp8GJ7F8b$fC@8hK6FbZ6I9L';

    public static function getAddUserPathUrl(): string
    {
        return self::$url . self::$addUserPath;
    }

    public static function getUpdateUserPathUrl(): string
    {
        return self::$url . self::$updateUserPath;
    }

    public static function getDeleteUserPathUrl(): string
    {
        return self::$url . self::$deleteUserPath;
    }

    public static function getAuth(): array
    {
        return array('user' => self::$user, 'password' => self::$password);
    }
}
