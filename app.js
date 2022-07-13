import { FormHandler } from './scripts/formhandler.js';

addFormEventListener();

function addFormEventListener() {
    document.querySelector("form#signup").addEventListener('submit', e => {
        // Prevent default form action
        e.preventDefault();

        const FormCapture = new FormHandler(e.submitter.value, e.target);

        FormCapture.postData(e);
    })
}