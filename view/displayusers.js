import { NodeHandler } from "../scripts/nodehandler.js";

export class DisplayUsers extends NodeHandler {

    constructor(users) {
        super();
        this.parentNode = document.querySelector('div.container');
        this.currentNode = () => this.getNode('div.table-row');
        this.users = users;
    }

    /* newNode
    Creates the new user table
    */ 
    newNode(users) {
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
        `;
        
        // Clone template
        const newNode = userTemplate.content.cloneNode(true);

        // Insert user rows in user table
        users.forEach((user) => {
            
            // Create user row HTML
            const userRow = `
            <tr>
                <td>${user.id}</td>
                <td>${user.username}</td>
                <td id="password">${user.password}</td>
            </tr>
            `
        
            // Insert user row
            newNode.querySelector('tbody').innerHTML += userRow;
        });

        return newNode;
    }

    /* Insert elements with nodeHandler
    Injects the users table into the DOM 
    */
    insertUserTable(users) {
        this.insertNode(this.parentNode, this.newNode(users), this.currentNode());
    }

    /* deleteUserTable
    Can be called to delete the user table. Checks if table exists.
    */
    deleteUserTable() {
        let node = this.currentNode();

        if ( node ) {
            node.remove();
        }
    }
}