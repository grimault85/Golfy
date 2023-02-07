<?php
require_once './model/class/PostModel.php';
require_once './model/class/UserModel.php';



$error = null;

// test Post for insert or delete
//TODO conditionner a la session
if (isset($_POST) && !empty($_POST)) {

    extract($_POST);

    // Validate only if at least one field is filled
    if (!empty($name) || !empty($email) || !empty($password)) {

        require 'model/class/UserModel.php';
        $userM = new UserModel();

        // Check name length
        if (!empty($name) && strlen($name) <= 30) {
            try {

                $userM->updateName($name);
            } catch (PDOException $e) {
                return $e->getMessage();
            }
            $_SESSION['user']['name'] = $name;
        }

        // Check email format
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            try {

                $userM->updateEmail($email);
            } catch (PDOException $e) {
                return $e->getMessage();
            }
            $_SESSION['user']['email'] = $email;
        }

        // Check password length
        if (!empty($password) && strlen($password) >= 6) {
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
            try {

                $userM->updatePassword($passwordHashed);
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
    } else {
        $error = 'Au moins un champ doit être rempli.';
    }
}

$postM = new PostModel();
try {
    $title = $postM->getTitle();
} catch (PDOException $e) {
    return $e->getMessage();
}

Session::setError($error);
