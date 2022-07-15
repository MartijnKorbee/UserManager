import { DisplayUsers } from "./displayusers.js";
import { Messages } from "./messages.js";

export class ViewController {

    /*
    Controls the view.
    */

    constructor(data, action) {
        this.action = action;
        this.data = data;
        this.succes = data.succes;
        this.displayMessage = data.displayMessage;
        this.message = data.message;
        this.users = (data.users) ? data.users : null;
    }

    /*handleFormPost
    Handles the formpost and decides what to change in the view.
    */
    handleFormPost(form) {
        if ( this.displayMessage == true ) {
            this.showMessage(this.succes, this.message);
        }

        if ( this.succes ) {
            this.resetForm(form);
        }

        const Users = new DisplayUsers(this.users);

        if ( (this.action == 'readUser' || this.action == 'readAllUsers') && this.succes ) {
            Users.insertUserTable(this.users);
        } else {
            Users.deleteUserTable();
        }
    }

    /* showMessage
    Displays the succes or error message. 
    */
    showMessage() {
        // Create message object
        const Message = new Messages(this.succes, this.message);
        // Insert message
        Message.insertMessage();
        // Hide
        Message.hideMessage(3000);
    }

    /*resetForm
    If succes is true reset the form
    */
    resetForm(form) {
        form.reset();
    }
}


