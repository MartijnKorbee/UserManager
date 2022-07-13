import { NodeHandler } from "../scripts/nodehandler.js";

export class Messages extends NodeHandler {
    
    constructor(succes, message) {
        super();
        this.message = message;
        this.succes = succes;
        this.parentNode = this.getNode('div.form-row');
        this.currentNode = () => this.getNode('div.message-row');
    }

    /* newNode
    Creates the new message box
    */
    newNode() {
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
        
        // Clone template (creates the new node)
        let newNode = msgTemplate.content.cloneNode(true);

        // Set message
        newNode.querySelector('span.message__text').innerText = this.message;
        // Set message color
        let messageColor = (this.succes) ? "green" : "red";
        newNode.querySelector('div.card').classList.add(messageColor);

        return newNode;
    }

    /* insertMessage
    Injects the message box into the DOM
     */
    insertMessage() {
        this.insertNode(this.parentNode, this.newNode(), this.currentNode(), 'first');
    }

    /* hideMessage
    */
    hideMessage(timeout) {
        this.hideNode(timeout, this.currentNode());
    }
}