<?php $post_data = $this->input->post(); ?>

    <div class="container wow fadeIn" data-wow-duration="2s">
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="1"
             aria-valuemin="0" aria-valuemax="100" style="width:1%">
            <span class="sr-only">10% Complete</span>
        </div>
    </div>
        <br>
    <h2 class="text-center text-info">Exchange funds in your account</h2>
    <br><br>
    
    <div class="row justify-content-center">
        <div class="col-3">
            <h5 class="text-center text-info">Current Account Statement</h5>
            <table class="table table-success">
                <thead class="table-stiped thead-light">
                    <tr>
                        <?php // echo '<pre>' ;print_r($currencies_summary); echo '</pre>'; die;?>
                        <?php foreach ($currencies_summary as $key => $value) { ?>
                            <?php echo ($currencies_summary[$key]['amount'] == 0 ? '' : '<th scope="col">' . $currencies_summary[$key]['currency_name'] . '</th>'); ?>
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
                        <?php echo ($currencies_summary[$key]['amount'] == 0 ? '' : '<th scope="col">' . $symbol . ($currencies_summary[$key]['amount'] + $currencies_summary[$key]['fee_paid'])) . '</th>'; ?>
                    <?php } ?>

                    <?php echo '</tr>'; ?>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <div class="row justify-content-center">
        <form action="<?php echo base_url('/client/deposit/2'); ?>" method="post">
            <div class="form-group text-warning col-md-12" style="display: inline-block;font-size:20px;font-weight: bold">
                <div style="float: left;">
                    <label for="exch_from_currency">EXCHANGE FROM:</label>
                    <select name="exch_from_currency">
                        <?php
                        if (isset($post_data['exch_from_currency'])) {
                            $currency = $post_data['exch_from_currency'];
                        } else {
                            $currency = $currencies_summary[0]['currency_name'];
                        }
                        ?>
                        <option value="<?php echo $currency ?>" selected hidden><?php echo $currency ?></option>
                        <?php foreach ($currencies_summary as $key => $value) { ?>
                            <?php echo ($currencies_summary[$key]['SUM(transactions.amount)'] == 0 ? '' : '<option value="' . $currencies_summary[$key]['currency_name'] . '">' . $currencies_summary[$key]['currency_name'] . '</option>'); ?>
                        <?php } ?>

                    </select>
                    <div style="position: relative" class="wow rubberBand" data-wow-duration="2s" data-wow-iteration="5">
                        <span class="text-danger"><?php echo form_error('exch_from_currency'); ?></span>
                        <img src="<?php echo base_url('./img/down.png'); ?>" height="70" width="70" alt="up"  style="position: absolute;margin-left: 70px;">
                    </div>
                </div>
                <div style="float: right;margin-left: 50px;font-size:20px;font-weight: bold">
                    <label for="exch_to_currency">EXCHANGE TO:</label>
                    <select name="exch_to_currency">
                        <?php
                        if (isset($post_data['exch_to_currency'])) {
                            $currency = $post_data['exch_to_currency'];
                        } else {
                            $currency = $available_currencies[0]['currency_name'] ? $available_currencies[0]['currency_name'] : '';
                        }
                        ?>
                        <option value="<?php echo $currency ?>" selected hidden><?php echo $currency ?></option>
                        <?php foreach ($available_currencies as $key => $value) { ?>
                            <?php echo '<option value="' . $available_currencies[$key]['currency_name'] . '">' . $available_currencies[$key]['currency_name'] . '</option>'; ?>
                        <?php } ?>
                    </select>
                    <div style="position:relative">
                        <span class="text-danger"><?php echo form_error('exch_to_currency'); ?></span>
                        <img src="<?php echo base_url('./img/up.png'); ?>" class="wow rubberBand" data-wow-duration="2.3s" data-wow-iteration="5" height="70" width="70" alt="up" style="position: absolute;margin-left: 70px;">
                    </div>
                </div>

                <span style="clear: clear"></span>
                <div class="form-group text-warning col-md-12" style="margin-top: 150px;font-size:20px;font-weight: bold">

                    <div class="text-center" > <label for="amount">Amount:</label></div>
                    <input type="number" step="0.01" class="form-control" id="amount" min="20" value="<?php echo set_value('amount'); ?>" placeholder="Enter amount of currency to sell" name="amount">
                    <span class="text-danger"><?php echo form_error('amount'); ?></span>
                </div>
            </div>

            <ul>
                <div>
                    <button type="submit" class="btn btn-warning position-relative wow bounceInLeft" data-wow-duration="3s" style="left:160px;">Proceed >>></button>
                </div>
            </ul>
        </form>
    </div>
    
</div>