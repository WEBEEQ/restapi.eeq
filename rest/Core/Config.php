<?php
declare(strict_types = 1);

// rest/Core/Config.php
namespace Rest\Core;

class Config
{
    protected static $user = 'user';
    protected static $password = 'lSp8GJ7F8b$fC@8hK6FbZ6I9L';

    public static function getUser(): string
    {
        return self::$user;
    }

    public static function getPassword(): string
    {
        return self::$password;
    }
}
