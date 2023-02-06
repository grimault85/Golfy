<?php

require_once './model/class/PostModel.php';


$postModel = new PostModel();

try {

    $posts = $postModel->selectPost();
} catch (PDOException $e) {
    return $e->getMessage();
}
