<?php
require_once '../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '../../');
$dotenv->load();

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
        $succes = false;
        $displayMessage = true;
        $message = "Enter a username and password.";

        $result = json_encode([
            'succes' => $succes,
            'displayMessage' => $displayMessage,
            'message' => $message
        ]);

        print $result;
    }
};

// CLASS DATABASE
class Database extends \mysqli {
    /*
    Database class that is responsible for and holds the connection.
    */
    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        parent::__construct(
            $_ENV['DB_SERVER'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_NAME']
        );
    }
} 

// CLASS USERMANAGER
class UserManager extends Database {
    /*
    UserManager class holds all functionalities of the UserManager.
    */

    /* userExists
    Protected method to check if user exists.
    Used for CRUD methods on single user. 
    */
    protected function userExists($username) {
        $query=<<<QUERY
        SELECT username FROM users WHERE username='$username'
        QUERY;

        $result = $this->query($query)->num_rows;
        
        return ($result) ? true : false;
    }

    /* authUser
    Protected method to authenticate user.
    Used for CRUD methods on single user.
    */
    protected function authUser($username, $password) {
        $query=<<<QUERY
        SELECT password FROM users WHERE username='$username'
        QUERY;

        $hash = $this->query($query)->fetch_row()[0];

        return password_verify($password, $hash);
    }

    /* createUser
    Public method to create users if they don't exists.
    If they do, return false and set the error message.
    */
    public function createUser($username, $password) {
        if ( !$this->userExists($username) ) {
            // Encrypt password
            $password = password_hash($password, PASSWORD_DEFAULT);

            $query=<<<QUERY
            INSERT INTO users (username, password)
            VALUES ('$username', '$password')
            QUERY;

            $result = $this->query($query);
            $message = "Added user: $username";

            return [$result, $message];

        } else {
            $message = "User already exists";
            return [false, $message];
        }
    }

    /* readUser
    Public method to read user details.
    Only returns user details after password authentication.
    */
    public function readUser($username, $password) {
        // Check if user exists
        if ( $this->userExists($username) ) {
            // Authenticate
            if ( $this->authUser($username, $password) ) {
                $query=<<<QUERY
                SELECT * FROM users WHERE username='$username'
                QUERY;

                $user = $this->query($query)->fetch_all(MYSQLI_ASSOC);
                $message = "User found";

                return [true, $message, $user];
            }
            else {
                $message = "Invalid password";
                return [false, $message, null];
            }
        } else {
            $message = "User not found";
            return [false, $message, null];
        }
    }

    /* updateUser
    Public method to update user details.
    */
    public function updateUser($username, $password) {
        // Check if user exists
        if ( $this->userExists($username) ) {
            // Encrypt password
            $password = password_hash($password, PASSWORD_DEFAULT);

            $query=<<<QUERY
            UPDATE users
            SET password='$password'
            WHERE username='$username'
            QUERY;

            $result = $this->query($query);
            $message = "Updated user: $username";

            return [$result, $message];
        }
        else {
            $message = "User not found";
            return [false, $message];
        }
    }

    /* delUser
    Public method to delete user details.
    Only deletes user details after password authentication.
    */
    public function delUser($username, $password) {
        // Check if user exists
        if ( $this->userExists($username) ) {
            // Authenticate
            if ( $this->authUser($username, $password) ) {
                $query=<<<QUERY
                DELETE FROM users WHERE username='$username' 
                QUERY;

                $user = $this->query($query);
                $message = "Deleted user: $username";

                return [true, $message];
            }
            else {
                $message = "Invalid password";
                return [false, $message];
            }
        } else {
            $message = "User not found";
            return [false, $message, null];
        }
    }

    /* readAllUsers
    Public method to read all users.
    */
    public function readAllUsers() {
        $query=<<<QUERY
        SELECT * FROM users
        QUERY;

        $users = $this->query($query)->fetch_all(MYSQLI_ASSOC);

        if ( count($users) == 0 ) {
            $message = "No users found";
            return [false, $message, $users];
        }

        return [true, null, $users];
    }

    /* delAllUsers
    Public method to delte all users.
    */
    public function delAllUsers() {
        $query=<<<QUERY
        DELETE FROM users
        QUERY;

        $result = $this->query($query);
        $message = "Deleted all users";

        return [$result, $message];
    }
}

?>