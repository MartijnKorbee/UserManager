import { displayMessage } from "../view/messages.js";
import { displayUsers, removeUsers } from "../view/displayUsers.js";

export class FormHandler {

    constructor(action, form) {
        this.action = action;
        this.form = form;
    }
    
    methods 
        postData(e) {
            // Hides users if action is not a read user action
            removeUsers(this.action);

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

                // Check for a message and call displayMessage
                if ( data.displayMessage == true ) {
                    displayMessage(data.message, data.succes);
                }

                // Check for users and call displayUsers
                if ( data.users ) {
                    displayUsers(data.users);
                } 
                // If authentication failed hide user display
                else if (data.succes == false) {
                    removeUsers();
                }
            })
        }
}