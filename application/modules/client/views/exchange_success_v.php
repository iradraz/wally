<?php
$session_data = $this->session->userdata();
$locale = 'he-IL'; //browser or user locale
$currency1 = $post_data['source'];
$currency2 = $post_data['target'];
$fmt1 = new NumberFormatter("@currency=$currency1", NumberFormatter::CURRENCY);
$fmt2 = new NumberFormatter("@currency=$currency2", NumberFormatter::CURRENCY);

$symbol1 = $fmt1->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
$symbol2 = $fmt2->getSymbol(NumberFormatter::CURRENCY_SYMBOL);

$session_data = $this->session->userdata();
header("refresh:7; url=/wally");
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
                        <h1 class="text-warning text-center">Exchange Success!</h1>
                        <h2 class="text-primary text-center">You just Exchanged <?php echo $post_data['sourceAmount'] . ' ' . $symbol1 . ' into ' . $post_data['targetAmount'] . ' ' . $symbol2; ?> </h2>
                        <div class="container wow fadeInLeft" data-wow-delay="1.5s" data-wow-duration="2s">
                            <h3 class="text-center"> Redirecting now to your wallet</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>