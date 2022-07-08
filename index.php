<?php 
require 'controller/form.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Manager</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Materialize icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- Custome stylesheet -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
    <div class="container center-container">
        <div class="row" style="display: flex;">
            <div class="col s12 teal lighten-6" style="margin: auto; padding: 20px; max-width: 600px;">
                <?php if ( $warning || $result) { ?>          
                <div class="row">
                    <div class="col s12">
                        <?php if ( $result && $action != 'readUser' && $action != 'readAllUsers') { ?>
                            <div class="card <?php print $cardColor ?>">
                                <div class="card-content white-text">
                                    <span><?php print $successMsg; ?></span>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <?php if ( $warning ) { ?>
                        <div class="card red darken-1">
                            <div class="card-content white-text">
                                <span><?php print $test123; ?></span>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>

                <div class="row">
                    <form id="signup" class="col s12" action="index.php" method="POST">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" maxlength="12" name="username" id="username" class="validate">
                                <label for="username">Username</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="password" maxlength="16" name="password" id="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 center">
                                <button class="btn green lighten-1 bold-text" type="submit" name="action" value="createUser" form="signup">
                                    <span>CREATE USER</span>
                                    <i class="material-icons left">add_to_photos</i>
                                </button>
                            </div>
                            <div class="col s6 center">
                                <button class="btn orange lighten-1 bold-text" type="submit" name="action" value="updateUser" form="signup">
                                    <span>UPDATE USER</span>
                                    <i class="material-icons left">file_upload</i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 center">
                                <button class="btn blue lighten-1 bold-text" type="submit" name="action" value="readUser" form="signup">
                                    <span>READ USER</span>
                                    <i class="material-icons left">account_box</i>
                                </button>
                            </div>
                            <div class="col s6 center">
                                <button class="btn blue lighten-1 bold-text" type="submit" name="action" value="readAllUsers" form="signup">
                                    <span>READ ALL USERS</span>
                                    <i class="material-icons left">contacts</i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 center">
                                <button class="btn red lighten-1 bold-text" type="submit" name="action" value="delUser" form="signup">
                                    <span>DELETE USER</span>
                                    <i class="material-icons left">delete_forever</i>
                                </button>
                            </div>
                            <div class="col s6 center">
                                <button class="btn red lighten-1 bold-text" type="submit" name="action" value="delAllUsers" form="signup">
                                    <span>DELETE ALL USERS</span>
                                    <i class="material-icons left">delete_sweep</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php if ( $result && ($action == 'readUser' || $action == 'readAllUsers') ) { ?>
                    <table class="centered">
                        <thead class="teal lighten-3 white-text">
                            <h5 class="bold">USER DETAILS:</h5>
                            <tr>
                                <th>ID</th>
                                <th>USERNAME</th>
                                <th>PASSWORD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user as $user) { ?>
                                <tr>
                                    <td><?php print $user['id']; ?></td>
                                    <td><?php print $user['username']; ?></td>
                                    <td style="word-wrap: anywhere; text-align: left;"><?php print $user['password']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
    
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>