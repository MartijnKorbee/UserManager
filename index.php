<?php
require_once 'vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Initial variables
$users=null; #Controls display users in view/display_users.php
$displayMessage=null; #Controls the display of message in view/message.php
$success=null; #Controls message color

require_once 'modal/database.php';
require_once 'modal/usermanager.php';
require_once 'controller/controller.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Manager</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Materialize icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- Custome stylesheet -->
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

    <div class="container center-container">
        <div class="row" style="display: flex;">
            <div class="col s12 teal lighten-5" style="margin: auto; padding: 20px; max-width: 600px;">
                <!-- DISPLAY MESSAGES -->
                <?php include 'view/messages.php'; ?>
                <!-- END DISPLAY MESSAGES -->
                
                <!-- FORM -->
                <?php include 'view/form.php'; ?>
                <!-- END FORM -->
            </div>
        </div>
        
        
        <!-- DISPLAY READ RESULTS -->
        <?php include 'view/display_users.php'; ?>
        <!-- DISPLAY READ RESULTS -->
    </div>
    
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>