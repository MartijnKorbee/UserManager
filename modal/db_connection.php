<?php 

$server = 'localhost';
$user = 'root';
$password = 'waldo_nuts';
$data_base = 'PHP_App';

$CONNECTION = mysqli_connect($server, $user, $password, $data_base);

if ( !$CONNECTION )
{
    die("Connection failed: " . mysqli_error($GLOBALS['CONNECTION']));
}

?>