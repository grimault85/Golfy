<?php

require_once './model/class/PostModel.php';


$postModel = new PostModel();
$posts = $postModel->selectPost();
