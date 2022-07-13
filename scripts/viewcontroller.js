import { DisplayUsers } from "../view/displayusers.js";
import { Messages } from "../view/messages.js";

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
    handleFormPost() {
        if ( this.displayMessage == true ) {
            this.showMessage(this.succes, this.message);
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
        const Message = new Messages(succes, message);
        // Insert message
        Message.insertMessage();
        // Hide
        Message.hideMessage(3000);
    }
}


