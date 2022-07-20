import { FormHandler } from './scripts/formhandler.js';

addFormEventListener();

function addFormEventListener() {
    
    let formElement = document.querySelector("form#signup");
    
    if ( formElement ) {
        formElement.addEventListener('submit', e => {
            // Prevent default form action
            e.preventDefault();
    
            const FormCapture = new FormHandler(e.submitter.value, e.target);
    
            FormCapture.postData(e);
        })
    }

}