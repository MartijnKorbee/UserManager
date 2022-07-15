/* NodeHandler
Class responsible for inserting, updating or removing DOM nodes
*/
export class NodeHandler {

    /* getNode
    Checks and returns node else defaults to false.
    */
    getNode(element) {
        let node = document.querySelector(element);

        return (node) ? node : false;
    }

    /* insertNode
    Inserts node in to DOM takes arg position to insert as first element.
    */
    insertNode(parentNode, newNode, currentNode, nodePosition=null) {
        if ( currentNode) {
            parentNode.replaceChild(newNode, currentNode);
        } else {
            switch (nodePosition) {
                case 'first':
                    parentNode.insertBefore(newNode, parentNode.firstChild);
                break;
            
                default:
                    parentNode.appendChild(newNode);
                break;
            }
        }
    }

    /* hideNode
    Hides node after timeout, timeout defaults to 0 to instantly hide the node.
    */
    hideNode(timeout, node) {
        
        setTimeout(() => {
            node.classList.add("hide-element");
            setTimeout(() => {
                node.remove();
            }, 1000)
        }, timeout)
    }
}