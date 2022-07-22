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
        const Message = new Messages(this.succes, this.message);

        // Disable form
        this.disableForm(form);

        // Delete user table
        if ( this.action != 'readAllUsers' ) {
            Users.deleteUserTable();
        }

        switch (this.succes) {
            case true:
                // Random loaderTimeOut
                let loaderTimeOut = (Math.floor(Math.random() * 2500) + 500);

                // Show loader
                FormLoader.insertLoader(loaderTimeOut)
                    // Wait and then display results
                    .then(() => {
                        // Reset form
                        form.reset();
                        
                        // Remove loader
                        FormLoader.removeLoader();

                        // Enable form
                        this.enableForm(form);

                        // Display message
                        if ( this.displayMessage ) {
                            Message.insertMessage(3000);
                        }

                        // Display user table
                        if ( this.action == 'readUser' || this.action == 'readAllUsers' ) {
                            Users.insertUserTable(this.users);
                        }
                    });    
                break;
        
            case false:
                if ( this.displayMessage ) {
                    // Display message and enable form
                    Message.insertMessage(2000)
                        .then(() => this.enableForm(form));
                }
                break;

            default:
                break;
        }
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


