<?php

// Notifs
$error = null;
$notif = null;
// test Post for insert or delete
if (isset($_POST) && !empty($_POST)) {
    // Check Empty fields
    foreach ($_POST as $attrName => $field) {
        if (empty($field)) {
            $error = 'Il y un champ vide';
        }
    }
    if (is_null($error)) {
        // Extraction du post
        extract($_POST); // $email, $password

        // Check email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check pwd

            if (strlen($password) >= 6) {
                // Call Modeluser

                require 'model/class/UserModel.php';
                $userM = new UserModel();
                // Check if user exist
                $user = $userM->findByEmail($email);
                // Check
                if ($user) {
                    // Check password

                    if (password_verify($password, $user['password'])) {
                        // TODO isAdmin
                        session::init($user['name'], $email, $user['role_id']);
                        $notif = 'Connexion avec succès';
                    } else $error = 'Mot de pass incorrect';
                } else $error = 'Aucun utilisateur n\'existe avec cet email';
            } else $error = 'Mot de pass trop court';
        } else $error = 'Email incorrect';
    }
}
print_r(Session::getLogged());
