<?php
$session_data = $this->session->userdata();
$locale = 'he-IL'; //browser or user locale
//$fmt = new NumberFormatter("@currency=$currency", NumberFormatter::CURRENCY);
//$symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
header("Content-Type: text/html; charset=UTF-8;");
?>
<link href="<?php echo base_url('css/pagination.css');?>" rel="stylesheet">
<script src="<?php echo base_url('jquery/pagination.js');?>"></script>
<?php if (empty($currencies_summary)) { ?>
    <div class="container-fluid wow fadeIn" data-wow-duration="2s">

        <div class="row justify-content-center">
            <div class="col-3" style="min-width: 250px;">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Please deposit funds to proceed</h5>
                        <a href="<?php echo base_url('client/deposit'); ?>" class="btn btn-primary">Add Funds Here</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <script>
            $(document).ready(function ()
            {
                $("#tab").pagination({
                    items: 7,
                    contents: 'contents',
                    previous: 'Previous',
                    next: 'Next',
                    position: 'bottom',
                });
            });
        </script>
        <div class="row justify-content-center">
            <div class="col-4">
                <h5 class="text-center text-primary">Current Account Statement</h5>
                <table class="table table-success">
                    <thead class="table-stiped thead-light">
                        <tr>

                            <?php foreach ($currencies_summary as $key => $value) { ?>
                                <?php if (($currencies_summary[$key]['sum(amount)']) + ($currencies_summary[$key]['sum(fee_paid)'] > 0)) echo '<th scope="col">' . $currencies_summary[$key]['currency_name'] . '</th>'; ?>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo '<tr>'; ?>
                        <?php foreach ($currencies_summary as $key => $value) { ?>
                            <?php
                            $currency = $currencies_summary[$key]['currency_name'];
                            $fmt = new NumberFormatter("@currency=$currency", NumberFormatter::CURRENCY);
                            $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
                            ?>
                            <?php if (($currencies_summary[$key]['sum(amount)']) + ($currencies_summary[$key]['sum(fee_paid)'] > 0)) echo '<th scope="col">' . $symbol . ' ' . (number_format(($currencies_summary[$key]['sum(amount)']) + ($currencies_summary[$key]['sum(fee_paid)']), 2)) . '</th>'; ?>
                        <?php } ?>

                        <?php echo '</tr>'; ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-8 col-centered" >

                <h5 class="text-primary text-center">Transaction Log</h5>
                <table class="table table-striped table-secondary table-hover">
                    <thead class="thead-light">
                        <tr>
                             <!--   <th scope="col" style="width: 1.33%"></th>  -->
                            <th scope="col" style="width: 8.33%">Transaction ID#</th>
                            <th scope="col" style="width: 8.33%">Action</th>

                            <th scope="col" style="width: 8.33%">Currency</th>
                            <th scope="col" style="width: 10.33%">Amount</th>
                            <th scope="col" style="width: 10.33%">Fee</th>
                            <th scope="col" style="width: 15.33%">Transaction Date</th>

                        </tr>
                    </thead>
                    <tbody class="contents">
                        <?php foreach ($transactions as $key => $value) { ?>
                            <?php echo '<tr>'; ?>
                            <!--     <?php echo '<th scope="row">' . ($key + 1) . '</th>'; ?> -->
                            <?php echo '<td scope="row">' . $transactions[$key]['transaction_id'] . '</td>'; ?>
                            <?php echo '<td scope="row">' . $transactions[$key]['action'] . '</td>'; ?>
                            <?php echo '<td>' . $transactions[$key]['currency_name'] . '</td>'; ?>
                            <?php
                            $currency = $transactions[$key]['currency_name'];
                            $fmt = new NumberFormatter("@currency=$currency", NumberFormatter::CURRENCY);
                            $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
                            ?>
                            <?php echo '<td>' . $symbol . ' ' . $transactions[$key]['amount'] . '</td>'; ?>
                            <?php echo '<td>' . (($transactions[$key]['fee_paid'] == 0) ? '0' : $symbol . ' ' . number_format($transactions[$key]['fee_paid'], 2)) . '</td>'; ?>    
                            <?php echo '<td>' . $transactions[$key]['transaction_date'] . '</td>'; ?>
                            <?php
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } ?>