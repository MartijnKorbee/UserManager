/* NodeHandler
Class responsible for inserting, updating or removing DOM nodes
*/
export class NodeHandler {

    constructor(parentNode, newNode, currentNode) {
        this.parentNode = document.querySelector(parentNode);
        this.newNode = newNode;
        this.currentNode = currentNode;
    }

    method
        /* insertNode
        Inserts node in to DOM takes arg position to insert as first element.
        */
        insertNode(nodePosition=null) {
            if ( this.currentNode) {
                this.parentNode.replaceChild(this.newNode, this.currentNode);
            } else {
                switch (this.nodePosition) {
                    case 'first':
                        this.parentNode.insertBefore(this.newNode, this.parentNode.firstChild);
                    break;
                
                    default:
                        this.parentNode.appendChild(this.newNode);
                    break;
                }
            }
        }

}

// Get node element 
function getNode(element) {
    let currentNode = document.querySelector(element);

    return (currentNode) ? currentNode : false;
}

// Hide node after timeout initiate timeout 0 to directly hide
function hideNode(node, timeout=0) {
    setTimeout(() => {
        node.classList.add("scale-out");
        setTimeout(() => {node.remove();}, 175)
    }, timeout)
}

// Remove node
function removeNode(node) {
    node.remove();
}

export { getNode, insertNode, removeNode, hideNode };