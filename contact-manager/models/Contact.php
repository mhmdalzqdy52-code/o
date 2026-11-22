<?php
require_once __DIR__ . '/Database.php';

class Contact
{
    public static function all(): array
    {
        return Database::connect()->query('SELECT * FROM contacts ORDER BY id DESC')->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $st = Database::connect()->prepare('SELECT * FROM contacts WHERE id = :id');
        $st->execute([':id' => $id]);
        return $st->fetch() ?: null;
    }

    public static function create(string $name, string $email, string $phone): void
    {
        $st = Database::connect()->prepare(
            'INSERT INTO contacts (name, email, phone) VALUES (:name, :email, :phone)'
        );
        $st->execute([':name' => $name, ':email' => $email, ':phone' => $phone]);
    }

    public static function update(int $id, string $name, string $email, string $phone): void
    {
        $st = Database::connect()->prepare(
            'UPDATE contacts SET name = :name, email = :email, phone = :phone WHERE id = :id'
        );
        $st->execute([':name' => $name, ':email' => $email, ':phone' => $phone, ':id' => $id]);
    }

    public static function delete(int $id): void
    {
        $st = Database::connect()->prepare('DELETE FROM contacts WHERE id = :id');
        $st->execute([':id' => $id]);
    }
}
