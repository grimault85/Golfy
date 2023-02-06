<?php

require_once './model/class/DB.php';
require './model/class/UserModel.php';


class PostModel extends DB
{


    public function insertPost(string $title, string $content): void
    {


        $q = $this->getPdo()->prepare(
            'INSERT INTO post (title, content, created_at, user_id)
            VALUES (:title, :content, NOW(), :user_id)'
        );
        $q->execute([
            'title' => $title,
            'content' => $content,
            'user_id' => Session::getId()
        ]);
    }

    public function selectPost(): bool|array
    {

        $q = $this->getPdo()->prepare(
            'SELECT title, content, post.created_at, user.name FROM post JOIN user ON post.user_id = user.id
            '
        );
        $q->execute();
        return $q->fetch();
    }

    public function getTitle(): bool|array
    {

        $q = $this->getPdo()->prepare('SELECT title
        FROM post
        WHERE user_id = :user_id
        ');
        $q->execute([
            'user_id' => Session::getId()
        ]);
        return $q->fetch();
    }
}
