import { ViewController } from "./viewcontroller.js";

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

        fetch('/API', {
            method: 'POST',
            body: formData
        })
        .then(res => {
            if ( !res.ok ) {
                throw new Error(`${res.status} ${res.statusText}`);
            }
            return res.json();
        })
        .then(data => {
            // Call viewcontroller
            const Controller = new ViewController(data, this.action);

            Controller.handleFormPost(this.form);
        })
        .catch(error => {
            console.error(`Issue calling the API. ${error}`);
        })
    }
}