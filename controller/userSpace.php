<?php
require_once './model/class/PostModel.php';
require_once './model/class/UserModel.php';



$error = null;

// test Post for insert or delete

if (FormValidator::isPostEmpty()) {

    extract($_POST);

    // Validate only if at least one field is filled
    if (!empty($name) || !empty($email) || !empty($password)) {

        require 'model/class/UserModel.php';
        $userM = new UserModel();

        // Check name length
        if (!empty($name) && FormValidator::isShortName($name, 30)) {
            $userM->updateName($name);
            $_SESSION['user']['name'] = $name;
        }

        // Check email format
        if (!empty($email) && FormValidator::isEmail($email)) {
            $userM->updateEmail($email);
            $_SESSION['user']['email'] = $email;
        }

        // Check password length
        if (!empty($password) && FormValidator::isPassword($password)) {
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
            $userM->updatePassword($passwordHashed);
        }
    } else {
        $error = 'Au moins un champ doit être rempli.';
    }
}

$postM = new PostModel();

$title = $postM->getTitle();

Session::setError($error);
