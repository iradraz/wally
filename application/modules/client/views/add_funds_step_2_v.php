<?php
$session_data = $this->session->userdata();
$locale = 'he-IL'; //browser or user locale
$currency = $post_data['currency'];
$fmt = new NumberFormatter("@currency=$currency", NumberFormatter::CURRENCY);
$symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
header("Content-Type: text/html; charset=UTF-8;");
?>

<div class="container">
    <div class="progress" style="margin-bottom: 5px;">
        <div class="progress-bar" role="progressbar" aria-valuenow="75"
             aria-valuemin="0" aria-valuemax="100" style="width:75%">
            <span class="sr-only">75% Complete</span>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-8"> 
                <div class="card">  
                    <div class="card-body">
                        <form action="<?php echo base_url('/client/transaction'); ?>" method="post">
                            <h5 class="card-title">Wally Deposit Review</h5>
                            <p class="card-text">Proceed with Depositing <?php echo $symbol . number_format($post_data['amount'], 2) . ' ' . $post_data['currency'] . '?'; ?></p>
                            <input type="hidden" name="amount" value="<?php echo $post_data['amount']; ?>">
                            <input type="hidden" name="currency" value="<?php echo $post_data['currency']; ?>">

                            <button type="submit" name="submit" value="back" class="btn btn-warning">Go Back</button>
                            <button type="submit" name="submit" value="submit" class="btn btn-info">Yes, Make a Deposit</button>
                            <a href="<?php echo base_url(); ?>"<button type="Cancel" class="btn btn-danger" style="float: right">No, Cancel</button><a/>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>