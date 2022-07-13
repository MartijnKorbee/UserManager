import { getNode, insertNode, removeNode } from "../scripts/nodehandler.js";

// Create template
const userTemplate = document.createElement('template');
// Insert html
userTemplate.innerHTML = `
    <div class="row table-row" style="display: flex;">
    <div class="col s12 teal lighten-5" style="margin: auto; padding: 0; max-width: 600px;">
        <table class="centered">
            <thead class="teal lighten-3 white-text">
                <h5 class="bold" style="padding: 10px 20px;">USER DETAILS:</h5>
                <tr>
                    <th>ID</th>
                    <th>USERNAME</th>
                    <th>PASSWORD</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <!-- table rows -->
            </tbody>
        </table>
    </div>
    </div>
`

function displayUsers(users) {
    
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