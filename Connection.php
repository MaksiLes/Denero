<?php

class Connection
{
    private static ?PDO $pdo;

    protected function __construct() {}

    protected function __clone() {}

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): ?PDO
    {
        static::$pdo = null;
//        if (!isset(static::$pdo)) {
//            $dsn = sprintf("mysql:host=%s;port=%d;dbname=%s", $cfg->getHost(), $cfg->getPort(), $cfg->getDbName());
//
//            static::$pdo = new PDO(
//                $dsn,
//                $cfg->getUserName(),
//                $cfg->getPass(),
//                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
//            );
//        }

        return static::$pdo;
    }
}
