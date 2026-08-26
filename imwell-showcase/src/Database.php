<?php

namespace Showcase;

use PDO;

/**
 * Read-mostly PDO connection to the MAIN application's database.
 *
 * The showcase site owns no schema of its own; organizations, features and
 * members all live in the main app. The only writes it ever performs are the
 * two in Repository::activate() (setting a member's chosen password and
 * consuming their activation token).
 */
class Database
{
    protected static $pdo;

    public static function pdo()
    {
        if (static::$pdo instanceof PDO) {
            return static::$pdo;
        }

        $host = Config::get('DB_HOST', '127.0.0.1');
        $port = Config::get('DB_PORT', '3306');
        $name = Config::get('DB_DATABASE');
        $user = Config::get('DB_USERNAME');
        $pass = Config::get('DB_PASSWORD', '');

        if (! $name || ! $user) {
            throw new \RuntimeException(
                'Database credentials not found. Copy .env.example to .env, or place '
                . 'this folder alongside the main application so its .env can be read.'
            );
        }

        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $host, $port, $name);

        static::$pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);

        return static::$pdo;
    }

    public static function select($sql, array $bindings = [])
    {
        $stmt = static::pdo()->prepare($sql);
        $stmt->execute($bindings);

        return $stmt->fetchAll();
    }

    public static function selectOne($sql, array $bindings = [])
    {
        $rows = static::select($sql, $bindings);

        return $rows ? $rows[0] : null;
    }

    public static function statement($sql, array $bindings = [])
    {
        $stmt = static::pdo()->prepare($sql);

        return $stmt->execute($bindings);
    }
}
