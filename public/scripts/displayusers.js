import { NodeHandler } from "./nodehandler.js";

export class DisplayUsers extends NodeHandler {

    constructor(users) {
        super();
        this.parentNode = document.querySelector('div#main');
        this.currentNode = () => this.getNode('div.user-table');
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
            <div class="container center-container user-table">
                <div class="row user-table__row" style="display: flex;">
                    <div class="col s12 z-depth-2" style="margin:auto; padding:0; max-width:600px; max-height:250px; overflow-y:scroll;">
                        <table class="centered">
                            <thead class="teal darken-3 white-text">
                                <tr>
                                    <th>ID</th>
                                    <th>USERNAME</th>
                                    <th>FIRSTNAME</th>
                                    <th>LASTNAME</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <!-- table rows -->
                            </tbody>
                        </table>
                    </div>
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
                <td>${user.firstname}</td>
                <td>${user.lastname}</td>
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