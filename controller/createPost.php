<?php

$error = null;
$isPosted = null;

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
        // Check title

        if (strlen($title) < 160) {

            if (strlen($content) > 100) {
                // Check pwd

                require 'model/class/PostModel.php';
                $postM = new postModel();
                // Check if user exist
                try {

                    $post = $postM->insertPost($title, $content);
                } catch (PDOException $e) {
                    return $e->getMessage();
                }

                $_SESSION['posted'] = 'ok';
            } else $error = 'Le contenu de l\'article est trop court';
        } else $error = 'Le champ title est trop long';
    }
}
Session::setError($error);
