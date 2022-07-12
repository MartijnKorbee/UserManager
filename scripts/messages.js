import { getNode, insertNode, hideNode, removeNode } from "./nodehandler.js";

function displayMessage(message, succes) {
    
    // Get messages template
    let msgTemplate = document.querySelector("template[name='messages']");

    // Clone template
    let newNode = msgTemplate.content.cloneNode(true);

    // Set message
    newNode.querySelector('span.message__text').innerText = message;
    // Set message color
    let messageColor = (succes) ? "green" : "red";
    newNode.querySelector('div.card').classList.add(messageColor);

    // get Nodes
    let parentNode = document.querySelector('div.form-row');
    let currentNode = "div.message-row";

    // Insert elements with nodeHandler
    insertNode(parentNode, newNode, getNode(currentNode), "first");

    // Hide message node after 3 seconds
    hideNode(getNode(currentNode), 3000);
}  

export { displayMessage };