<?php

require_once './model/class/UserModel.php';

$users = new UserModel();

try {

    $userNb = count($users->allUser());
} catch (PDOException $e) {
    return $e->getMessage();
}
