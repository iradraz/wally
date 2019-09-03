<?php
$session_data = $this->session->userdata();
$locale = 'he-IL'; //browser or user locale
$fmt = new NumberFormatter("@currency=USD", NumberFormatter::CURRENCY);

$symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);

$session_data = $this->session->userdata();
header("refresh:10; url=/wally");
?>
<div class="container">
    <div class="progress" style="margin-bottom: 5px;">
        <div class="progress-bar" role="progressbar" aria-valuenow="75"
             aria-valuemin="0" aria-valuemax="0" style="width:100%">
            <span class="sr-only">0% Complete</span>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-10"> 
                <div class="card">  
                    <div class="card-body">
                        <h1 class="text-danger text-center">Deposit Failed!</h1>
                        <h2 class="text-danger text-center">Failed to deposit <?php echo $get_data['AMOUNT'] . ' ' . $symbol; ?> into your account</h2>
                        <h3 class="text-primary text-center">This event has been logged, Review your steps and proceed</h3>
                        <div class="container wow fadeInLeft" data-wow-delay="1.5s" data-wow-duration="2s">
                            <h3 class="text-center"> Redirecting back to your wallet</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>