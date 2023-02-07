<?php


require_once './model/class/CommentModel.php';


$commentModel = new CommentModel();

try {

    $comment = $commentModel->deleteComment($_GET['id']);
} catch (PDOException $e) {
    return $e->getMessage();
}

Session::setError($error);
