<?php

declare(strict_types=1);

require './model/database.php';

abstract class DB
{
    // Controller
    private ?PDO $connexion;
    // Model
    private $_table = null;

    public function __construct()
    {
        $this->connexion = new PDO(
            'mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME . ';charset=utf8;',
            DB_USERNAME,
            DB_PASSWORD,
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    protected function getPdo(): PDO
    {
        return $this->connexion;
    }
}
