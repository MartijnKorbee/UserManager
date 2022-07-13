<?php
require_once '../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '../../');
$dotenv->load();

require_once '../modal/database.php';
require_once '../modal/usermanager.php';

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

    // return error message
    $success = false;
    $displayMessage = true;
    $message = "Something went wrong when connecting to the database.";

    $result = [
        'succes' => false,
        'displayMessage' => true,
        'message' => $message
    ];

    print $result;

    exit;
}

if ( isset($_POST['action']) && $connected ) {
    
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
                } else {
                    $displayMessage = false;
                }

                $response = json_encode([
                    'succes' => $success,
                    'displayMessage' => $displayMessage,
                    'message' => $message,
                    'users' => $users
                ]);

                print $response;
            break;

            // DELETE ALL USERS
            case 'delAllUsers':
                [$success, $message] = $UserManager->delAllUsers();

                $displayMessage = true;

                $response = json_encode([
                    'succes' => $success,
                    'displayMessage' => $displayMessage,
                    'message' => $message,
                ]);

                print $response;
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

                $response = json_encode([
                    'succes' => $success,
                    'displayMessage' => $displayMessage,
                    'message' => $message,
                ]);

                print $response;
            break;

            // READ USER
            case 'readUser':
                [$success, $message, $users] = $UserManager->readUser($username, $password);

                $displayMessage = true;

                $response = json_encode([
                    'succes' => $success,
                    'displayMessage' => $displayMessage,
                    'message' => $message,
                    'users' => $users
                ]);

                print $response;
            break;            
            
            // UPDATE USER
            case 'updateUser':
                [$success, $message] = $UserManager->updateUser($username, $password);
                
                $displayMessage = true;

                $response = json_encode([
                    'succes' => $success,
                    'displayMessage' => $displayMessage,
                    'message' => $message,
                ]);

                print $response;
            break;

            // DELETE USER
            case 'delUser':
                [$success, $message] = $UserManager->delUser($username, $password);

                $displayMessage = true;

                $response = json_encode([
                    'succes' => $success,
                    'displayMessage' => $displayMessage,
                    'message' => $message,
                ]);

                print $response;
            break;

            // DO NOTHING
            default:
                break;
        }

    }
    // Show error if username and password are blank
    else {
        $result = json_encode([
            'succes' => false,
            'displayMessage' => true,
            'message' => "Enter a username and password."
        ]);

        print $result;
    }
}
// Return message if not connected
else {
    $result = json_encode([
        'succes' => false,
        'displayMessage' => true,
        'message' => "Not connected to database."
    ]);
}

?>