<?php

require_once './model/class/DB.php';
require_once './model/class/UserModel.php';


class CommentModel extends DB
{


    public function insertComment(string $content): void
    {


        $q = $this->getPdo()->prepare(
            'INSERT INTO Comments (comment, user_id, created_at)
            VALUES (:content, :user_id, NOW())'
        );
        $q->execute([
            'content' => $content,
            'user_id' => Session::getId()
        ]);
    }

    public function selectComment(): bool|array
    {

        $q = $this->getPdo()->prepare(
            'SELECT Comments.id ,comment, Comments.created_at, user.name 
            FROM Comments 
            JOIN user ON Comments.user_id = user.id
            '
        );
        $q->execute();
        return $q->fetchAll();
    }

    public function deleteComment($comId): void
    {

        $q = $this->getPdo()->prepare(
            'DELETE FROM golfy.Comments 
            WHERE id = :id
        '
        );
        $q->execute([
            'id' => $comId
        ]);
    }
}
