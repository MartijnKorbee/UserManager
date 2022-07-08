<?php 
$cardColor = ($success) ? "green" : "red";
if ( $displayMessage ) { ?>          
    <div class="row">
        <div class="col s12">
            <div class="card <?php print $cardColor ?>">
                <div class="card-content white-text" style="padding: 12px 24px;">
                    <?php print $message; ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>