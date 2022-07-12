import { getNode, insertNode, removeNode } from "./nodehandler.js";

function displayUsers(users) {
    
    // Get users template
    let userTemplate = document.querySelector("template[name='users']");

    // Clone template
    let newNode = userTemplate.content.cloneNode(true);

    // Insert user rows in user table
    users.forEach((user) => {
        
        // Create user row HTML
        let userRow = `
        <tr>
            <td>${user.id}</td>
            <td>${user.username}</td>
            <td id="password">${user.password}</td>
        </tr>
        `

        // Insert user row
        newNode.querySelector('tbody').innerHTML += userRow;
    });

    // get Nodes
    let parentNode = document.querySelector('div.container');
    let currentNode = getNode('div.table-row');

    // Insert elements with nodeHandler
    insertNode(parentNode, newNode, currentNode);
}

function removeUsers(action=null) {
    // Remove user display
    let userNode = getNode("div.table-row");
    
    if ( userNode && !(action == 'readUser' || action == 'readAllUsers')) {
        removeNode(userNode);
    }
}

export { displayUsers, removeUsers };