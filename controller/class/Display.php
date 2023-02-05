<?php

class Display
{
    public $layout = './views/layout.phtml';

    public function home()
    {
        $content =  './views/pages/home.phtml';
        include $this->layout;
    }

    public function signUp()
    {
        $content =  './views/auth/signUp.phtml';
        include $this->layout;
    }

    public function login()
    {
        $content =  './views/auth/login.phtml';
        include $this->layout;
    }

    public function userSpace()
    {
        $content =  './views/userAccount/userSpace.phtml';
        include $this->layout;
    }

    public function backOffice()
    {
        $content =  './views/admin/backOffice.phtml';
        include $this->layout;
    }
}
