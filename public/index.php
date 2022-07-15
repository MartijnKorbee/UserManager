<?php 

if ( $_SERVER['REQUEST_URI'] == '/' ) {
    include('view/home.html');
}

if ( $_SERVER['REQUEST_URI'] == '/API' ) {
    include('../controller/controller.php');
}

?>