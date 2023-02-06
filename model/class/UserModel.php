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

    public function allUser(): bool|array
    {

        $q = $this->getPdo()->prepare(
            'SELECT name 
            FROM user 
            WHERE role_id = 2
        '
        );
        $q->execute();
        return $q->fetchAll();
    }

    public function findByEmail(string $email): bool|array
    {
        $q = $this->getPdo()->prepare('SELECT id, name, password, created_at, role_id FROM user WHERE email = :mail');
        $q->execute(['mail' => $email]);
        return $q->fetch();
    }

    public function updateName(string $name): void
    {

        $q = $this->getPdo()->prepare(
            'UPDATE user 
            SET name= :name
            WHERE id = :id'
        );
        $q->execute([
            'name' => $name,
            'id' => Session::getId()
        ]);
    }

    public function updateEmail(string $email): void
    {

        $q = $this->getPdo()->prepare(
            'UPDATE user 
            SET email= :email
            WHERE id = :id'
        );
        $q->execute([
            'email' => $email,
            'id' => Session::getId()
        ]);
    }

    public function updatePassword(string $passwordHashed): void
    {

        $q = $this->getPdo()->prepare(
            'UPDATE user 
            SET password= :password
            WHERE id = :id'
        );
        $q->execute([
            'password' => $passwordHashed,
            'id' => Session::getId()
        ]);
    }
}
