<?php

class Display
{
    public $layout = './views/layout.phtml';

    public function home(): void
    {
        $content =  './views/pages/home.phtml';
        include $this->layout;
    }

    public function signUp(): void
    {
        $content =  './views/auth/signUp.phtml';
        include $this->layout;
    }

    public function login(): void
    {
        $content =  './views/auth/login.phtml';
        include $this->layout;
    }

    public function userSpace(bool|array $title): void
    {
        $content =  './views/userAccount/userSpace.phtml';

        include $this->layout;
    }

    public function createPost(): void
    {
        $content =  './views/userAccount/createPost.phtml';
        include $this->layout;
    }

    public function blog($title,  $blogContent,  $name,  $date, ?array $comments): void
    {
        $content =  './views/pages/blog.phtml';
        include $this->layout;
    }

    public function backOffice(int $userNb): void
    {
        $content =  './views/admin/backOffice.phtml';
        include $this->layout;
    }
}
