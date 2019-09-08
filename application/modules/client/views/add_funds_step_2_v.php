<?php
$locale = 'he-IL'; //browser or user locale
$fmt = new NumberFormatter("@currency=USD", NumberFormatter::CURRENCY);
$symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);

$session_data = $this->session->userdata();
header("refresh:5; url=/wally");
?>
<div class="loader text-center">
    <img src="<?php
    $random = rand(1, 4);
    echo base_url('img/loader' . $random . '.gif');
    ?>" alt="Loading..." />
</div>
<div class="container">
    <div class="progress" style="margin-bottom: 5px;">
        <div class="progress-bar" role="progressbar" aria-valuenow="75"
             aria-valuemin="0" aria-valuemax="100" style="width:100%">
            <span class="sr-only">100% Complete</span>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-8"> 
                <div class="card">  
                    <div class="card-body">
                        <h1 class="text-warning text-center">Deposit Success!</h1>
                        <h2 class="text-primary text-center">You just funded your account with <?php echo $get_data['AMOUNT'] . ' ' . $symbol; ?> </h1>
                            <div class="container wow fadeInLeft" data-wow-delay="1.5s" data-wow-duration="1s">
                                <h3 class="text-center">Redirecting now to your wallet</h3>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>