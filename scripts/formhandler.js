import { DisplayUsers } from "../view/displayusers.js";
import { Messages } from "../view/messages.js";

export class FormHandler {

    constructor(action, form) {
        this.action = action;
        this.form = form;
    }
    
    postData() {
        // Create new FormData object
        const formData = new FormData(this.form);
        // Append form action from button
        formData.append('action', this.action);

        fetch('/controller/controller.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {

            // Check for a message
            if ( data.displayMessage == true ) {
                // Create message object
                const Message = new Messages(data.succes, data.message);
                // Insert message
                Message.insertMessage();
                // Hide
                Message.hideMessage(3000);
            }

            const Users = new DisplayUsers(data.users);

            // Check if action is read user related
            if ( this.action == 'readUser' || this.action == 'readAllUsers') {
                if ( data.users && data.succes) {
                    // Insert users table
                    Users.insertUserTable(data.users);
                } else {
                    Users.deleteUserTable();
                }
            } 
            // Delete user table the method checks if it exists
            else {
                Users.deleteUserTable();
            }
        })
    }
}