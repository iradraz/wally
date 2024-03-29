<?php $post_data = $this->input->post(); ?>
<style>
    .overlay{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
        background-color: rgba(0,0,0,0.5); /*dim the background*/
    }
</style>
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
    <script>
        $(document).ready(function () {
            $("#myform").on("submit", function () {
                $(".loader").fadeIn();
                $(".overlay").fadeIn(500);
                $("#proceed").hide();

            });//submit
        });//document ready
    </script>
    <div class="row justify-content-center">
        <div class="col-5">
            <h5 class="text-center text-info">Current Account Statement</h5>
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

    <br>
    <div class="row justify-content-center">
        <form action="<?php echo base_url('/client/check_exchange'); ?>" id="myform" method="post">
            <div class="form-group text-warning col-md-12" style="display: inline-block;font-size:20px;font-weight: bold">
                <div style="float: left;">
                    <label for="exch_from_currency">EXCHANGE FROM:</label>
                    <select name="exch_from_currency">
                        <?php
                        if (isset($post_data['exch_from_currency'])) {
                            $currency = $post_data['exch_from_currency'];
                        } else {
                            $currency = $transactions_summary[0]['currency_name'];
                        }
                        ?>
                        <?php
                        foreach ($currencies_summary as $key => $value)
                            if (($currencies_summary[$key]['sum(amount)']) + ($currencies_summary[$key]['sum(fee_paid)'] > 0)) {
                                ?>
                                <option value="<?php echo $currencies_summary[$key]['currency_name'] ?>"><?php echo $currencies_summary[$key]['currency_name'] ?></option>
                            <?php } ?>

                        <?php
                        foreach ($transactions_summary as $key => $value)
                            if (($currencies_summary[$key]['sum(amount)']) + ($currencies_summary[$key]['sum(fee_paid)'] > 0)) {
                                ?>
                                <?php echo ($transactions_summary[$key]['SUM(transactions.amount)'] == 0 ? '' : '<option value="' . $transactions_summary[$key]['currency_name'] . '">' . $transactions_summary[$key]['currency_name'] . '</option>'); ?>
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
                    <input type="number" step="0.01" class="form-control" id="amount" min="20" value="<?php echo set_value('amount'); ?>" placeholder="Enter amount of currency to sell" name="amount" required>
                    <span class="text-danger"><?php echo form_error('amount'); ?></span>
                </div>
            </div>

            <ul>
                <div>
                    <div class="overlay" style="display:none;"></div>
                    <button type="submit" class="btn btn-warning position-relative wow bounceInLeft" data-wow-duration="3s" id="proceed" value="submit" style="left:160px;">Proceed >>></button>
                    <div class="loader text-center" style="display: none;">
                        <img src="<?php
                        $random = rand(1, 4);
                        echo base_url('img/loader' . $random . '.gif');
                        ?>" alt="Loading..." />
                    </div>
                </div>
            </ul>
        </form>
    </div>

</div>
