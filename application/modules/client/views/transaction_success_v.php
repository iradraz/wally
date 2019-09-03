<?php
$session_data = $this->session->userdata();
$locale = 'he-IL'; //browser or user locale
$fmt = new NumberFormatter("@currency=$currency", NumberFormatter::CURRENCY);
$symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
header("Content-Type: text/html; charset=UTF-8;");
?>
<div class="loader">
    <img src="<?php
    $random = rand(1, 4);
    echo base_url('img/loader' . $random . '.gif');
    ?>" alt="Loading..." />
</div>
<div class="container">
    <div class="progress" style="margin-bottom: 5px;">
        <div class="progress-bar" role="progressbar" aria-valuenow="100"
             aria-valuemin="0" aria-valuemax="100" style="width:100%">
            <span class="sr-only">100% Complete</span>
        </div>
    </div>
    <div class="container-fluid text-info text-center">
        <h2>Success!!</h2>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">  
                        <div class="card-body text-center">
                            <h3 class="text-info">You just added <?php echo $symbol . number_format($amount, 2) . ' ' . $currency . ''; ?> into your account</h3>
                            <p class="card-text">Review your wallet data </p>
                            <a href="<?php echo base_url('/client/wallet'); ?>" class="card-link">My Wallet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>