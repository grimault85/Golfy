<?php

$error = null;

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


        if (strlen($content) > 10) {

            require './model/class/CommentModel.php';
            $commentM = new CommentModel();
            try {
                $comments = $commentM->insertComment($content);
            } catch (PDOException $e) {

                return $e->getMessage();
            }
        } else $error = 'Le contenu du commentaire est trop court';
    }
}


$commentModel = new CommentModel();

try {

    $comments = $commentModel->selectComment();
} catch (PDOException $e) {
    return $e->getMessage();
}

Session::setError($error);
