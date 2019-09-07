<script type="text/javascript" src="<?php echo base_url('jquery/tabledit.min.js'); ?>"></script>
<script>
    $('#example3').Tabledit({
        url: 'example.php',
        editButton: false,
        deleteButton: false,
        hideIdentifier: true,
        columns: {
            identifier: [0, 'id'],
            editable: [[2, 'firstname'], [3, 'Email']]
        }
    });
</script>
<table class="table" id="my-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Firstname</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>John</td>
            <td>Doe</td>
            <td>john@example.com</td>
        </tr>
        <tr>
            <td>Mary</td>
            <td>Moe</td>
            <td>mary@example.com</td>
        </tr>
        <tr>
            <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
        </tr>
    </tbody>
</table>

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
                <?php echo '<td>' . $currencies_data[$key]['fee_rate'] . '%</td>'; ?>
                <?php echo '<td>' . $currencies_data[$key]['change_date'] . '</td>'; ?>
                <?php echo '<td id="' . $currencies_data[$key]['currency_id'] . '"><a href="#" class="delete_data btn btn-danger btn-sm" id="' . $currencies_data[$key]['currency_id'] . '"><div class="edit">edit</div></td>'; ?>
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