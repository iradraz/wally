<?php
$locale = 'he-IL'; //browser or user locale
header("Content-Type: text/html; charset=UTF-8;");
?>
<h3 style="text-align: center;">Add Support To a Currency</h3>
<div class="row">
    <div class="alert alert-success" id="message" style="display: none;">
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-3">
        <?php echo form_open('admin/currencies'); ?>
        <div class="form-group">
            <label>Currency:</label>
            <input type="text" name="currency" id="currency" class="form-control" maxlength="3"  placeholder="Ex: USD">
        </div>
        <input type="submit" value="ADD" id="add_data">
        <span class="text-danger"><?php echo form_error('currency'); ?></span>
        <?php echo form_close() ?>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <h3>Supported currencies:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Currency ID</th>
                    <th scope="col">Currency Name</th>
                    <th scope="col">Symbol</th>
                    <th scope="col">ACTION</th>
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
                    echo '<td>' . $symbol . '</td>';
                    ?>

                    <?php echo '<td id="' . $currencies_data[$key]['currency_id'] . '"><a href="#" class="delete_data btn btn-danger btn-sm" id="' . $currencies_data[$key]['currency_id'] . '"><span class="glyphicon glyphicon-remove"></span> Remove </a></td>'; ?>
                    <?php
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <!--try add ajax call here to sequence the currencies-->        
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".delete_data").click(function () {
            var del_id = $(this).attr('id');
            var parent = $(this).parent();
            var grandparent = $(this).parent().parent();
            var r = confirm("Deletion of the content is irreversible, PRESS OK TO DELETE");
            if (r == true) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('currencies/remove_currency'); ?>',
                    data: 'delete_id=' + del_id,
                    success: function (data) {
                        parent.slideUp(400, function () {
                            grandparent.remove();
                        });
                    },
                    error: function () {
                        alert("Error");
                    }
                });
            } else {
                txt = "Deletion Canceled!";
            }
        });
    });
//    $(document).ready(function () {
//        $(".add_data").click(function () {
//
//            $.ajax({
//                type: 'POST',
//                url: '<?php // echo base_url('currencies/add_currency'); ?>',
//                data: 'currency_name=' + currency,
//                success: function (data) {
//                    alert("sucess");
//                },
//                error: function () {
//                    alert("Error");
//                }
//            });
//        });
//    });
</script>
<!--naama-->