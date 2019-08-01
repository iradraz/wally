<div class="row">
    <div class="alert alert-success" id="message" style="display: none;">
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-3">
        <h3>Fees rate for supported currencies:</h3>
        <table class="table wow slideInLeft " data-wow-duration="1s">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Currency</th>
                    <th scope="col">Fee Rate</th>
                    <th scope="col">Change Date</th>

                    <th scope="col">Action</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($currencies_data as $key => $value) { ?>
                    <?php echo '<tr>'; ?>
                    <?php echo '<th scope="row">' . $currencies_data[$key]['currency_id'] . '</th>'; ?>
                    <?php echo '<td>' . $currencies_data[$key]['currency_name'] . '</td>'; ?>
                    <?php
                    $currency = $currencies_data[$key]['currency_name'];
                    $fmt = new NumberFormatter("@currency=$currency", NumberFormatter::CURRENCY);
                    $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
                    ?>
                    <?php echo '<td>' . $symbol . ' ' . $currencies_data[$key]['fee_rate'] . '</td>'; ?>
                    <?php echo '<td>' . $currencies_data[$key]['change_date'] . '</td>'; ?>
                    <?php echo '<td id="' . $currencies_data[$key]['currency_id'] . '"><a href="#" class="delete_data btn btn-danger btn-sm" id="' . $currencies_data[$key]['currency_id'] . '"><span class="glyphicon glyphicon-remove"></span> Edit </a></td>'; ?>
                    <?php
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <!--try add ajax call here to sequence the currencies-->        
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">

    </div>
</div>