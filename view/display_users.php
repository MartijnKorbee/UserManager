<?php $users=null; if ( $users ) { ?>
    <div class="row" style="display: flex;">
        <div class="col s12 teal lighten-5" style="margin: auto; padding: 20px; max-width: 600px;">
            <table class="centered">
                <thead class="teal lighten-3 white-text">
                    <h5 class="bold">USER DETAILS:</h5>
                    <tr>
                        <th>ID</th>
                        <th>USERNAME</th>
                        <th>PASSWORD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?php print $user['id']; ?></td>
                            <td><?php print $user['username']; ?></td>
                            <td style="word-wrap: anywhere; text-align: left;"><?php print $user['password']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>


