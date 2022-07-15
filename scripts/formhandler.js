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

        fetch('controller/controller.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            // Call viewcontroller
            const Controller = new ViewController(data, this.action);

            Controller.handleFormPost(this.form);
        })
    }
}