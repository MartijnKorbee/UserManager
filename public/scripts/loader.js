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

    /** insertLoader
     * Inserts loader and creates a promise
     */
    async insertLoader(loaderTimeOut) {
        this.insertNode(this.parentNode, this.newNode(), this.currentNode(), 'first');

        await new Promise(resolve => setTimeout(resolve, loaderTimeOut));
    }

    /**
     * Remove loader
     */
    removeLoader() {
        this.currentNode().remove();
    }
}