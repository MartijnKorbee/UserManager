import { getNode, insertNode, hideNode, removeNode } from "../scripts/nodehandler.js";

// Create template element
const  msgTemplate = document.createElement('template');
// Insert innerHTML
msgTemplate.innerHTML = `
    <div class="row message-row scale-transition">
    <div class="col s12">
        <div class="card">
            <div class="card-content white-text" style="padding: 12px 24px;">
                <span class="message__text"></span>
            </div>
        </div>
    </div>
    </div>
`;

function displayMessage(message, succes) {

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