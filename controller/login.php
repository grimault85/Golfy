<?php

// Notifs
$error = null;

// test Post for insert or delete
if (FormValidator::isPostEmpty()) {
    // Check Empty fields
    FormValidator::isFieldsEmpty();

    if (is_null($error)) {
        // Extraction du post
        extract($_POST); // $email, $password

        // Check email
        if (FormValidator::isEmail($email)) {
            // Check pwd

            if (FormValidator::isPassword($password)) {
                // Call Modeluser

                require 'model/class/UserModel.php';
                $userM = new UserModel();
                // Check if user exist
                try {

                    $user = $userM->findByEmail($email);
                } catch (PDOException $e) {
                    return $e->getMessage();
                }
                // Check
                if ($user) {
                    // Check password

                    if (password_verify($password, $user['password'])) {
                        session::init($user['id'], $user['name'], $email, $user['role_id']);
                    } else $error = 'Mot de pass incorrect';
                } else $error = 'Aucun utilisateur n\'existe avec cet email';
            } else $error = 'Mot de pass trop court';
        } else $error = 'Email incorrect';
    }
}
Session::setError($error);
