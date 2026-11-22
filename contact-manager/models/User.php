<?php
require_once __DIR__ . '/Database.php';

class User
{
    public static function findByUsername(string $username): ?array
    {
        $st = Database::connect()->prepare('SELECT * FROM users WHERE username = :u');
        $st->execute([':u' => $username]);
        return $st->fetch() ?: null;
    }
}
