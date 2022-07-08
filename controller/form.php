<?php
    
require_once  'modal/db_functions.php';

if ( isset($_POST['action']) )
{

    $username = mysqli_real_escape_string($GLOBALS['CONNECTION'], $_POST['username']);
    $password = mysqli_real_escape_string($GLOBALS['CONNECTION'], $_POST['password']);
    $action = $_POST['action'];

    if ( ($username != null && $password != null) )
    {
        // ### readUser
        if ( $action == 'readUser' )
        {   
            [$user, $result] = readUser($username, $password);

            if ( !$result )
            {
                $warning = true;
                $errorMsg = "Username and password incorrect.";
            }
        }

        // ### createUser
        if ( $action == 'createUser' )
        {   
            $result = createUser($username, $password);
            $cardColor = "green lighten-2";

            $successMsg = "Added user: $username with password: $password";

            if ( !$result )
            {
                $warning = true;
                $errorMsg = "User already exists.";
            }
        }

        // ### updateUser
        if ( $action == 'updateUser' )
        {
            $result = updateUser($username, $password);
            $cardColor = "orange lighten-2";

            $successMsg = "Updated user: $username and password: $password";

            if ( !$result )
            {
                $warning = true;
                $errorMsg = "User not found.";
            }
        }

        ### delUser
        if ( $action == 'delUser' )
        {
            $result = delUser($username, $password);
            $cardColor = "red lighten-2";

            $successMsg = "Removed user: $username";

            if ( !$result )
            {
                $warning = true;
                $errorMsg = "Username and password incorrect.";
            }
        }
    }
    elseif ( $action == 'readAllUsers' || $action == 'delAllUsers')
    {
        // ### readAllUsers
        if ( $action == 'readAllUsers' )
        {   
            [$user, $result] = readAllUsers();

            if ( !$result )
            {
                $warning = true;
                $errorMsg = "No users found.";
            }
        }

        ### delAllUsers
        if ( $action == 'delAllUsers' )
        {
            $result = delAllUsers();
            $cardColor = "red lighten-2";

            $successMsg = "Deleted all users.";

            if ( !$result )
            {
                $warning = true;
                $errorMsg = "No users found.";
            }
        }
    }
    else 
    {
        $warning = true;
        $errorMsg = "Enter a username and password.";
    }
};
?>