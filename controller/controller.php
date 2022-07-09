<?php

use modal\UserManager\UserManager;

// Initiates DB connection and UserManager
try {
    $UserManager = new UserManager();
    
    // Set connected -> Form enabled
    $connected = true;
    
} catch (\Exception $error) {
    // Set connected -> Form disabled
    $connected = false;

    $datetime = new \DateTime('NOW');
    $datetime = $datetime->format('c');
    $errorMessage = $error->getMessage();
    $errorFile = $error->getFile() . ":" . $error->getLine();
    
    $error=<<<ERROR
    $datetime
    $errorMessage
    $errorFile\n
    ERROR;
    
    // Log error to connection log
    \error_log($error, 3, 'connection.log');

    // Display error message to user
    $displayMessage = true;
    $success = false;
    $message = "Something went wrong when connecting to the database.";
}

if ( isset($_POST['action']) ) {
    
    // Retrieve POST data
    $action = $_POST['action'];
    // Retieve and clean POST data
    $username = $UserManager->real_escape_string($_POST['username']);
    $password = $UserManager->real_escape_string($_POST['password']);

    // Handle all type actions
    if ( $action == 'readAllUsers' || $action == 'delAllUsers') {

        switch ($action) {
            // READ ALL USERS
            case 'readAllUsers':
                [$success, $message, $users] = $UserManager->readAllUsers();

                if ( !$success ) {
                    $displayMessage = true;
                }
            break;

            // DELETE ALL USERS
            case 'delAllUsers':
                [$success, $message] = $UserManager->delAllUsers();

                $displayMessage = true;
            break;
            
            // DO NOTHING
            default:
                break;
        }
    } 
    // Check if username and password are filled else show error message
    elseif ( $username != null && $password != null ) {   
        switch ($action) {
            // CREATE USER
            case 'createUser':
                [$success, $message] = $UserManager->createUser($username, $password);

                $displayMessage = true;
            break;

            // READ USER
            case 'readUser':
                [$success, $message, $users] = $UserManager->readUser($username, $password);

                $displayMessage = true;
            break;            
            
            // UPDATE USER
            case 'updateUser':
                [$success, $message] = $UserManager->updateUser($username, $password);
                
                $displayMessage = true;
            break;

            // DELETE USER
            case 'delUser':
                [$success, $message] = $UserManager->delUser($username, $password);

                $displayMessage = true;
            break;

            // DO NOTHING
            default:
                break;
        }

    }
    // Show error if username and password are blank
    else {
        $succes = false;
        $displayMessage = true;
        $message = "Enter a username and password.";
    }
};

?>