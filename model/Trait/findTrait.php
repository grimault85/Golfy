<?php

trait findTrait
{
    private PDO $db;

    public function findByEmail(string $email): bool|array
    {
        $q = $this->db->prepare('SELECT name FROM user WHERE email = :email');
        $q->execute(['email' => $email]);
        return $q->fetch();
    }
}
