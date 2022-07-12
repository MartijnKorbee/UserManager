function insertNode(parentNode, newNode, currentNode, position=null) {
    // check if message node exists and replace
    if ( currentNode ) {
        parentNode.replaceChild(newNode, currentNode);
    } else {
        switch (position) {
            case 'first':
                parentNode.insertBefore(newNode, parentNode.firstChild);
            break;

            default:
                parentNode.appendChild(newNode);
            break;
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