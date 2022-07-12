<div class="row form-row">
    <form id="signup" class="col s12" method="POST">
        <!-- FORM INPUT -->
        <div class="row">
            <div class="input-field col s12">
                <input <?php ($connected) ? : print "disabled" ?> type="text" maxlength="12" name="username" id="username" class="validate">
                <label for="username">Username</label>
            </div>
            <div class="input-field col s12">
                <input <?php ($connected) ? : print "disabled" ?> type="password" maxlength="16" name="password" id="password" class="validate">
                <label for="password">Password</label>
            </div>
        </div>
        <!-- END FORM INPUT -->

        <!-- FORM BUTTONS -->
        <div class="row">
            <div class="col s6 center">
                <!-- CREATE USER -->
                <button <?php ($connected) ? : print "disabled" ?> class="btn green waves-effect waves-light bold-text" type="submit" name="action" value="createUser" form="signup">
                    <span>CREATE USER</span>
                    <i class="material-icons left">add_to_photos</i>
                </button>
            </div>
            <div class="col s6 center">
                <!-- UPDATE USER -->
                <button <?php ($connected) ? : print "disabled" ?> class="btn orange waves-effect waves-light bold-text" type="submit" name="action" value="updateUser" form="signup">
                    <span>UPDATE USER</span>
                    <i class="material-icons left">file_upload</i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col s6 center">
                <!-- READ USER -->
                <button <?php ($connected) ? : print "disabled" ?> class="btn blue waves-effect waves-light bold-text" type="submit" name="action" value="readUser">
                    <span>READ USER</span>
                    <i class="material-icons left">account_box</i>
                </button>
            </div>
            <div class="col s6 center">
                <!-- READ ALL USERS -->
                <button <?php ($connected) ? : print "disabled" ?> class="btn blue waves-effect waves-light bold-text" type="submit" name="action" value="readAllUsers" form="signup">
                    <span>READ ALL USERS</span>
                    <i class="material-icons left">contacts</i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col s6 center">
                <!-- DELETE USER -->
                <button <?php ($connected) ? : print "disabled" ?> class="btn red waves-effect waves-light bold-text" type="submit" name="action" value="delUser" form="signup">
                    <span>DELETE USER</span>
                    <i class="material-icons left">delete_forever</i>
                </button>
            </div>
            <div class="col s6 center">
                <!-- DELETE ALL USERS -->
                <button <?php ($connected) ? : print "disabled" ?> class="btn red waves-effect waves-light bold-text" type="submit" name="action" value="delAllUsers" form="signup">
                    <span>DELETE ALL USERS</span>
                    <i class="material-icons left">delete_sweep</i>
                </button>
            </div>
        </div>
        <!-- END FORM BUTTONS -->
    </form>
</div>