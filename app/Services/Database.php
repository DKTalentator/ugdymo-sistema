<?php

declare(strict_types=1);

namespace App\Services;

use PDO;

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../Config/config.php';

            $dsn = 'mysql:host=' . $config['DB_HOST']
                 . ';dbname=' . $config['DB_NAME']
                 . ';charset=utf8mb4';

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            self::$pdo = new PDO($dsn, $config['DB_USER'], $config['DB_PASS'], $options);
        }

        return self::$pdo;
    }
}
