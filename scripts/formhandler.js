import { displayMessage } from "../view/messages.js";
import { displayUsers, removeUsers } from "../view/displayUsers.js";
import { getNode, removeNode } from "./nodehandler.js";

export class FormHandler {

    postData(e) {
        // Hides users if action is not a read user action
        removeUsers(e.submitter.value);

        // Create new FormData object
        const formData = new FormData(e.target);
        // Append form action from button
        formData.append('action', e.submitter.value);

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