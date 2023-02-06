<?php

$error = null;
$isRegistered = null;

// test Post for insert or delete
if (FormValidator::isPostEmpty()) {
    // Check Empty fields
    FormValidator::isFieldsEmpty();

    if (is_null($error)) {
        // Extraction du post
        extract($_POST);
        // Check name
        if (FormValidator::isShortName($name, 30)) {
            // Check Email
            if (FormValidator::isEmail($email)) {
                // Check pwd
                if (FormValidator::isPassword($password)) {
                    require 'model/class/UserModel.php';
                    $userM = new UserModel();

                    try {
                        $user = $userM->findByEmail($email);
                    } catch (PDOException $e) {
                        return $e->getMessage();
                    }

                    // Check
                    if ($user) {
                        $error = 'Un utilisateur existe déjà avec cet email';
                    } else {
                        // Hashage pwd

                        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

                        try {
                            $userM->insertUser($name, $email, $passwordHashed);
                        } catch (PDOException $e) {
                            return $e->getMessage();
                        }


                        $_SESSION['registered'] = 'ok';
                    }
                } else $error = 'Le champ password est trop court';
            } else $error = 'Le champ email n\'est pas valide';
        } else $error = 'Le champ name est trop long';
    }
}
Session::setError($error);
