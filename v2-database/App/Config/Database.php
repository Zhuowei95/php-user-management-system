<?php
namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $configPaths = [
                __DIR__ . '/config.php',
                dirname(__DIR__, 2) . '/config/config.php',
            ];

            $configFile = null;
            foreach ($configPaths as $path) {
                if (file_exists($path)) {
                    $configFile = $path;
                    break;
                }
            }

            if ($configFile === null) {
                throw new PDOException(
                    'Missing config.php. Copy config.example.php to App/Config/config.php or to config/config.php first.'
                );
            }

            $config = require $configFile;
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                $config['host'],
                $config['port'],
                $config['dbname'],
                $config['charset']
            );

            self::$connection = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }

        return self::$connection;
    }
}
