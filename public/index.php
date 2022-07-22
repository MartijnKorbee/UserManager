<?php 

session_set_cookie_params(['SameSite'=>'Strict']);
session_start();

switch ($_SERVER['REQUEST_URI']) {
    
    case '/':
        include('view/home.php');
        break;

    case '':
        include('view/home.php');
        break;
    
    case '/home':
        include('view/home.php');
        break;
    
    case '/API':
        include('../API/controller/controller.php');
        break;

    default:
        http_response_code(404);
        include 'view/404.php';
        break;
}

?>