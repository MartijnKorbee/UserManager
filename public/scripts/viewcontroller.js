import { DisplayUsers } from "./displayusers.js";
import { Messages } from "./messages.js";
import { Loader } from "./loader.js";

export class ViewController {

    /*
    Controls the view.
    */

    constructor(res, action) {
        this.action = action;
        this.res = res;
        this.succes = res.succes;
        this.displayMessage = res.displayMessage;
        this.message = res.message;
        this.users = (res.users) ? res.users : null;
    }

    /*handleFormPost
    Handles the formpost and decides what to change in the view.
    */
    handleFormPost(form) {
        // Initiate view classes
        const FormLoader = new Loader();
        const Users = new DisplayUsers(this.users);

        // Delete user table
        if ( this.action != 'readAllUsers' || !this.succes) {
            Users.deleteUserTable();
        }

        // Display message
        if ( this.displayMessage && !this.succes ) {
            this.showMessage(this.succes, this.message);
        }
        
        // If succes time out before showing results
        if ( this.succes ) {

            // Show loader and disable form
            FormLoader.insertLoader();
            // Disable form
            this.disableForm(form);
            // Reset form
            this.resetForm(form);
            
            // Set timeout to display loader before showing results
            let loaderTimeOut = (Math.floor(Math.random() * 2500) + 500);
            setTimeout(() => {

                // Hide loader
                FormLoader.hideLoader();

                // Display message
                if ( this.displayMessage == true ) {
                    this.showMessage(this.succes, this.message);
                }

                // Enable form
                this.enableForm(form);

                // Display user table
                if ( this.action == 'readUser' || this.action == 'readAllUsers' ) {
                    Users.insertUserTable(this.users);
                }
            }, loaderTimeOut)
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

    /** disableForm
     * Disables form while loading res
     */
    disableForm(form) {
        for (let i=0; i<form.elements.length; i++) {
            form.elements[i].disabled = true;
        }
    }

    /** enableForm
     * Disables form while loading res
     */
     enableForm(form) {
        for (let i=0; i<form.elements.length; i++) {
            form.elements[i].disabled = false;
        }
    }
}


