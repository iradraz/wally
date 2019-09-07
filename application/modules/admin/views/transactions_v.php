
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-5" style="min-width: 250px;">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Wally Wallet</h5>
                    <p class="card-text">Review all users transaction log</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-10" style="flex-grow: 1; min-width: 500px;">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary text-center ">Transaction Log</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Transaction ID #</th>
                                <th scope="col">User ID #</th>
                                <th scope="col">Action</th>
                                <th scope="col">Currency</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Commission</th>
                                <th scope="col">Transaction Date</th>

                            </tr>
                        </thead>
                        <tbody><?php // print_r($transactions);die;?>
                            <?php foreach ($transactions as $key => $value) { ?>
                                <?php echo '<tr>'; ?>
                                <?php echo '<th scope="row">' . ($key + 1) . '</th>'; ?>
                                <?php echo '<td scope="row">' . $transactions[$key]['transaction_id'] . '</td>'; ?>
                                <?php echo '<td scope="row">' . $transactions[$key]['user_id'] . '</td>'; ?>                            
                                <?php echo '<td scope="row">' . $transactions[$key]['action'] .  '</td>'; ?>
                                <?php echo '<td>' . $transactions[$key]['currency_name'] . '</td>'; ?>
                                <?php
                                $currency = $transactions[$key]['currency_name'];
                                $fmt = new NumberFormatter("@currency=$currency", NumberFormatter::CURRENCY);
                                $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
                                ?>
                                <?php echo '<td>' . $symbol . ' ' . $transactions[$key]['amount'] . '</td>';
                                ?>
                                <?php echo '<td scope="row">' . $transactions[$key]['fee_paid'] . '</td>'; ?>                            
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
    </div>
</div>