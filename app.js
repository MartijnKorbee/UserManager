import { FormHandler } from './scripts/formhandler.js';

const FormCapture = new FormHandler();

addFormEventListener();

function addFormEventListener() {
    document.querySelector("form#signup").addEventListener('submit', e => {
        // Prevent default form action
        e.preventDefault();

        FormCapture.postData(e);
    })
}