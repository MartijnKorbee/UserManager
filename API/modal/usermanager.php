<?php

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
    public function createUser($username, $password, $firstname, $lastname) {
        if ( !$this->userExists($username) ) {
            // Encrypt password
            $password = password_hash($password, PASSWORD_DEFAULT);

            $query=<<<QUERY
            INSERT INTO users (username, password, firstname, lastname)
            VALUES ('$username', '$password', '$firstname', '$lastname')
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
                SELECT id, username, firstname, lastname FROM users WHERE username='$username'
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
    public function updateUser($username, $password, $firstname, $lastname) {
        // Check if user exists
        if ( $this->userExists($username) ) {
            // Authenticate 
            if ( $this->authUser($username, $password) ) {
    
                $query=<<<QUERY
                UPDATE users
                SET firstname='$firstname', lastname='$lastname'
                WHERE username='$username'
                QUERY;
    
                $result = $this->query($query);
                $message = "Updated user: $username";
    
                return [$result, $message];
            }
            else {
                $message = "Invalid password";
                return [false, $message, null];
            }
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
        SELECT id, username, firstname, lastname FROM users
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
