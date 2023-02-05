<?php

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
        extract($_POST);
        // Check name
        if (strlen($name) <= 30) {
            // Check Email
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Check pwd
                if (strlen($password) >= 6) {
                    require 'model/class/UserModel.php';
                    $userM = new UserModel();
                    // Check if user exist
                    $user = $userM->findByEmail($email);
                    // Check
                    if ($user) {
                        $error = 'Un utilisateur existe déjà avec cet email';
                    } else {
                        // Hashage pwd
                        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
                        // Test si dirthdate field exist
                        $userM->insert($name, $email, $passwordHashed);
                        // Notif
                        $notif = 'L\'utilisateur a été enregistré avec succès';
                    }
                } else $error = 'Le champ password est trop court';
            } else $error = 'Le champ email n\'est pas valide';
        } else $error = 'Le champ name est trop long';
    }
}
