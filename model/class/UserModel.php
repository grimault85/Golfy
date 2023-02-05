<?php
require_once './model/class/DB.php';
class UserModel extends DB
{
    // public string $table = 'user';

    public function insertUser(string $name, string $email, string $passwordHashed): void
    {
        $q = $this->getPdo()->prepare(
            'INSERT INTO user (name, email, password, role_id, created_at)
            VALUES (:name, :email, :password, 2, NOW())'
        );
        $q->execute([
            'name' => $name,
            'email' => $email,
            'password' => $passwordHashed
        ]);
    }

    public function findByEmail(string $email): bool|array
    {
        $q = $this->getPdo()->prepare('SELECT id, name, password, created_at, role_id FROM user WHERE email = :mail');
        $q->execute(['mail' => $email]);
        return $q->fetch();
    }
}
