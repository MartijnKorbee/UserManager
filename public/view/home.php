<?php include('header.php') ?>

<div id="main">
    <!-- MESSAGES -->
    <div class="container center-container">
        <div class="row" style="display: flex;">
            <div class="col s12 z-depth-2" style="margin: auto; padding: 20px; max-width: 600px;">
                <!-- FORM -->
                <div class="row form-row">
                    <form id="signup" class="col s12" method="POST">
                        <!-- FORM INPUT -->
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" maxlength="24" data-length="12" name="username" id="username">
                                <label for="username">Username</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="password" maxlength="24" name="password" id="password">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" maxlength="24" name="firstname" id="firstname">
                                <label for="firstname">First name</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" maxlength="24" name="lastname" id="lastname">
                                <label for="password">Last name</label>
                            </div>
                        </div>
                        <!-- END FORM INPUT -->
                        <!-- FORM BUTTONS -->
                        <div class="row">
                            <div class="col s6 center">
                                <!-- CREATE USER -->
                                <button class="btn green waves-effect waves-light bold-text" type="submit" name="action" value="createUser" form="signup">
                                    <span>CREATE USER</span>
                                    <i class="material-icons left">add_to_photos</i>
                                </button>
                            </div>
                            <div class="col s6 center">
                                <!-- UPDATE USER -->
                                <button class="btn orange waves-effect waves-light bold-text" type="submit" name="action" value="updateUser" form="signup">
                                    <span>UPDATE USER</span>
                                    <i class="material-icons left">file_upload</i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 center">
                                <!-- READ USER -->
                                <button class="btn blue waves-effect waves-light bold-text" type="submit" name="action" value="readUser">
                                    <span>READ USER</span>
                                    <i class="material-icons left">account_box</i>
                                </button>
                            </div>
                            <div class="col s6 center">
                                <!-- READ ALL USERS -->
                                <button class="btn blue waves-effect waves-light bold-text" type="submit" name="action" value="readAllUsers" form="signup">
                                    <span>READ ALL USERS</span>
                                    <i class="material-icons left">contacts</i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 center">
                                <!-- DELETE USER -->
                                <button class="btn red waves-effect waves-light bold-text" type="submit" name="action" value="delUser" form="signup">
                                    <span>DELETE USER</span>
                                    <i class="material-icons left">delete_forever</i>
                                </button>
                            </div>
                            <div class="col s6 center">
                                <!-- DELETE ALL USERS -->
                                <button class="btn red waves-effect waves-light bold-text" type="submit" name="action" value="delAllUsers" form="signup">
                                    <span>DELETE ALL USERS</span>
                                    <i class="material-icons left">delete_sweep</i>
                                </button>
                            </div>
                        </div>
                        <!-- END FORM BUTTONS -->
                    </form>
                </div>
                <!-- END FORM -->
            </div>
        </div>
        <!-- DISPLAY USERS -->
    </div>
</div>

<?php include('footer.php') ?>