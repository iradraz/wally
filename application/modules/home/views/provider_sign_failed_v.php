<?php
header( "refresh:6; url=/wally/#page2" ); 
?>
<div class="container-fluid text-info text-center">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">  
                    <div class="card-body text-center">
                        <h3 class="text-info">There was an error uploading the file</h3>
                        <p class="card-text">Reason: <?php echo $error['error']; ?></p>
                        <h4>review the errors and proceed...</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>