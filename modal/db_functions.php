<?php 

require_once 'modal/db_connection.php';

function readUser($username, $password) {
    
    $CONNECTION = $GLOBALS['CONNECTION'];
    
    $query = <<<QUERY
    SELECT * FROM users WHERE username='$username'
    QUERY;
    $result = mysqli_query($CONNECTION, $query);

    if ( $result )
    {
        // Check if user exists
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ( count($rows) > 0 )
        {   
            // Check if password is correct
            if ( password_verify($password, $rows[0]['password']) )
            {
                $user = $rows;
                return [$user, true];
            }
            else 
            {
                return [false, false];
            }
        }
        else 
        {
            return [false, false];
        }
    }
    else
    {
        die("Action failed: " . mysqli_error($CONNECTION));
    }
}

function readAllUsers() {
    
    $CONNECTION = $GLOBALS['CONNECTION'];

    $query = <<<QUERY
    SELECT * FROM users
    QUERY;
    $result = mysqli_query($CONNECTION, $query);

    if ( $result )
    {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ( count($rows) > 0 )
        {   
            $users = $rows;
            return [$users, true];
        }
        else 
        {
            return [false, false];
        }
    }
    else
    {
        die("Action failed: " . mysqli_error($CONNECTION));
    }
}

function createUser($username, $password) {

    $CONNECTION = $GLOBALS['CONNECTION'];

    $query = <<<QUERY
    SELECT username FROM users WHERE username='$username'
    QUERY;
    $result = mysqli_query($CONNECTION, $query);

    if ( $result )
    {   
        // Check if user exists
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ( count($rows) == 0 ) 
        {

            // Encrypt password
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Create new user
            $query = <<<QUERY
            INSERT INTO users (username, password)
            VALUES ('$username', '$password')
            QUERY;
            $result = mysqli_query($CONNECTION, $query);

            if ( $result )
            {
                return true;
            }
            else
            {
                die("Action failed: " . mysqli_error($CONNECTION));
            }
        }   
        else
        {
            return false;
        }
    }
    else
    {
        die("Action failed: " . mysqli_error($CONNECTION));
    }
}

function updateUser($username, $password) {

    $CONNECTION = $GLOBALS['CONNECTION'];

    $query = <<<QUERY
    SELECT username FROM users WHERE username='$username'
    QUERY;
    $result = mysqli_query($CONNECTION, $query);

    if ( $result )
    {
        // Check if user exists
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ( count($rows) > 0 ) 
        {
            // Encrypt password
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Update user
            $query = <<<QUERY
            UPDATE users
            SET password='$password'
            WHERE username='$username'
            QUERY;
            $result = mysqli_query($CONNECTION, $query);

            if ( $result )
            {
                return true;
            }
            else
            {
                die("Action failed: " . mysqli_error($CONNECTION));
            }
        }
        else
        {
            return false;
        }
    }
    else
    {
        die("Action failed: " . mysqli_error($CONNECTION));
    }
}

function delUser($username, $password) {

    $CONNECTION = $GLOBALS['CONNECTION'];

    // Check if user exists
    $query = <<<QUERY
    SELECT * FROM users WHERE username='$username'
    QUERY;
    $result = mysqli_query($CONNECTION, $query);

    if ( $result )
    {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ( count($rows) > 0 )
        {   
            // If user exists and password is correct -> delete user
            if ( password_verify($password, $rows[0]['password']) )
            {   
                $query = <<<QUERY
                DELETE FROM users WHERE username='$username' 
                QUERY;
                $result = mysqli_query($CONNECTION, $query);

                if ( $result )
                {
                    return true;
                }
                else
                {
                    die("Action failed: " . mysqli_error($CONNECTION));
                }
            }
            else
            {
                return false;
            }
        }
        else 
        {
            return false;
        }
    }
    else
    {
        die("Action failed: " . mysqli_error($CONNECTION));
    }
}

function delAllUsers() {

    $CONNECTION = $GLOBALS['CONNECTION'];

    // Check if user exists and password is correct
    $query = <<<QUERY
    SELECT * FROM users
    QUERY;
    $result = mysqli_query($CONNECTION, $query);

    if ( $result )
    {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ( count($rows) > 0 )
        {   
            // If user exists and password is correct -> delete user
            $query = <<<QUERY
            DELETE FROM users; 
            QUERY;
            $result = mysqli_query($CONNECTION, $query);

            if ( $result )
            {
                return true;
            }
            else
            {
                die("Action failed: " . mysqli_error($CONNECTION));
            }
        }
        else 
        {
            return false;
        }
    }
    else
    {
        die("Action failed: " . mysqli_error($CONNECTION));
    }
}

?>