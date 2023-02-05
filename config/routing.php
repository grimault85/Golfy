<?php

// Routing des requêtes HTTP
$route = $_SERVER['REQUEST_URI'];
require_once './config/class/Session.php';
require 'controller/class/Display.php';
Session::start();
$controller = new Display();

// Règles de routage
switch ($route) {
    case '/':
        $controller->home();
        break;
    case '/login':
        require './controller/login.php';
        $controller->login();
        break;
    case '/userSpace':
        if (Session::isAdmin()) {
            $controller->backOffice();
        } else $controller->userSpace();
        break;
    case '/signUp':
        require './controller/signUp.php';
        $controller->signUp();
        break;
    case '/logout':
        require './controller/logout.php';
        $controller->home();
        break;
    default:
        http_response_code(404);
        require './views/pages/404.phtml';
        break;
}
