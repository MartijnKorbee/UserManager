import { NodeHandler } from "./nodehandler.js";

export class Loader extends NodeHandler {

    constructor() {
        super();
        this.parentNode = this.getNode('div.container');
        this.currentNode = () => this.getNode('div.loader-box');
    }

    /** newNode
     * Creates the loader node
     */
    newNode() {
        // Create template element
        const  msgTemplate = document.createElement('template');
        // Insert innerHTML
        msgTemplate.innerHTML = `
        <div class="row loader-box" style="display:flex; margin:10px auto;">
            <div class="col s12" style="max-width:600px;margin:auto;">
                <div class="progress">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </div>
        `;
        
        // Clone template (creates the new node)
        let newNode = msgTemplate.content.cloneNode(true);

        return newNode;        
    }

    insertLoader() {
        this.insertNode(this.parentNode, this.newNode(), this.currentNode(), 'first');
    }

    hideLoader() {
        this.currentNode().style.display = 'none';
    }
}