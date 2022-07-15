<?php 

if ( $_SERVER['REQUEST_URI'] == '/' ) {
    include('view/home.html');
}

if ( $_SERVER['REQUEST_URI'] == '/API' ) {
    include('../API/controller/controller.php');
}

?>