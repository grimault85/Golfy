<?php

require_once './model/class/DB.php';
require './model/class/UserModel.php';


class PostModel extends DB
{
    // public string $table = 'post';

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

    public function isPost(): bool
    {

        $q = $this->getPdo()->prepare('SELECT title
        FROM post
        WHERE user_id = :user_id
        LIMIT 1
        ');
        $q->execute([
            'user_id' => Session::getId()
        ]);
        $q->fetch();

        return !is_null($q) ? true : false;
    }
}
