import { DisplayUsers } from "./displayusers.js";
import { Messages } from "./messages.js";
import { Loader } from "./loader.js";

export class ViewController {

    /*
    Controls the view.
    */

    constructor(res, action, form) {
        this.action = action;
        this.res = res;
        this.succes = res.succes;
        this.displayMessage = res.displayMessage;
        this.message = res.message;
        this.users = (res.users) ? res.users : null;
        this.form = form;
    }

    /*handleFormPost
    Handles the formpost and decides what to change in the view.
    */
    handleFormPost() {
        // Initiate view classes
        const FormLoader = new Loader();
        const Users = new DisplayUsers(this.users);
        const Message = new Messages(this.succes, this.message);

        // Disable form
        this.toggleFormInput();

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
                        this.form.reset();
                        
                        // Remove loader
                        FormLoader.removeLoader();

                        // Display message
                        if ( this.displayMessage ) {
                            Message.insertMessage()
                            .then(() => this.toggleFormInput());
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
                    Message.insertMessage()
                        .then(() => this.toggleFormInput());
                }
                break;

            default:
                break;
        }
    }

    /** toggleFormInput
     * Enables or Disables form while loading res
     */
    toggleFormInput() {

        // Get current state and reverse
        let state = ( this.form.elements[0].disabled ) ? false : true;

        for (let i=0; i<this.form.elements.length; i++) {
            this.form.elements[i].disabled = state;
        }
    }
}


