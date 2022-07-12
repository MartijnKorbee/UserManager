import { FormHandler } from './formhandler.js';

const FormCapture = new FormHandler();

addFormEventListener();

function addFormEventListener(event) {
    document.querySelector("form#signup").addEventListener('submit', e => {
        // Prevent default form action
        e.preventDefault();

        FormCapture.postData(e);
    })
}