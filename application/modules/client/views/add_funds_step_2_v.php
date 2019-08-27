<?php
$session_data = $this->session->userdata();
header("refresh:3; url=/wally");
?>

<div class="container">
    <div class="progress" style="margin-bottom: 5px;">
        <div class="progress-bar" role="progressbar" aria-valuenow="75"
             aria-valuemin="0" aria-valuemax="100" style="width:100%">
            <span class="sr-only">75% Complete</span>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-8"> 
                <div class="card">  
                    <div class="card-body">
                        <h1>congrats, you just funded your account with <?php echo $get_data['AMOUNT']; ?> USD</h1>
                        <div class="container wow fadeInLeft" data-wow-delay="1.5s" data-wow-duration="2s">
                            <h2> Redirecting to your wallet</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>