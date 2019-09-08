<script type="text/javascript" src="<?php echo base_url('jquery/tabledit.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        $('.editBtn').on('click', function () {
            //hide edit span
            $(this).closest("tr").find(".editSpan").hide();
            //show edit input
            $(this).closest("tr").find(".editInput").show();
            //hide edit button
            $(this).closest("tr").find(".editBtn").hide();
            //show edit button
            $(this).closest("tr").find(".saveBtn").show();

        });

        $('.saveBtn').on('click', function () {
            var trObj = $(this).closest("tr");
            var ID = $(this).closest("tr").attr('id');
            var inputData = $(this).closest("tr").find(".editInput").serialize();
            $.ajax({
                type: 'POST',
                url: 'admin/update_fee',
                dataType: "json",
                data: 'action=edit&fee_id=' + ID + '&' + inputData,
                success: function (response) {
                    if (response.status == 'ok') {
                        trObj.find(".editSpan.fee_rate").text(response.data.fee_rate);

                        trObj.find(".editInput.fee_rate").text(response.data.fee_rate);

                        trObj.find(".editInput").hide();
                        trObj.find(".saveBtn").hide();
                        trObj.find(".editSpan").show();
                        trObj.find(".editBtn").show();
                    } else {
                        alert(response.msg);
                    }
                }
            });
        });

//        $('.deleteBtn').on('click', function () {
//            //hide delete button
//            $(this).closest("tr").find(".deleteBtn").hide();
//
//            //show confirm button
//            $(this).closest("tr").find(".confirmBtn").show();
//
//        });

//        $('.confirmBtn').on('click', function () {
//            var trObj = $(this).closest("tr");
//            var ID = $(this).closest("tr").attr('id');
//            $.ajax({
//                type: 'POST',
//                url: 'admin/confirm_delete_fee',
//                dataType: "json",
//                data: 'action=delete&id=' + ID,
//                success: function (response) {
//                    if (response.status == 'ok') {
//                        trObj.remove();
//                    } else {
//                        trObj.find(".confirmBtn").hide();
//                        trObj.find(".deleteBtn").show();
//                        alert(response.msg);
//                    }
//                }
//            });
//        });
    });
</script>
<div class="container text-center col-3">
    <div class="row">
        <div class="panel panel-default users-content">
            <table class="table table-striped">
                <h3>Fees rate for supported currencies:</h3>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Currency</th>
                        <th>Fee Rate</th>
                        <th>Change Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="userData"><?php // print_r($currencies_data);die;  ?>
                    <?php if (!empty($currencies_data)): foreach ($currencies_data as $key => $value): ?>
                            <tr id="<?php echo $currencies_data[$key]['fee_id']; ?>">
                                <td><?php echo $currencies_data[$key]['fee_id']; ?></td>
                                <td>
                                    <span class=" fname"><?php echo $currencies_data[$key]['currency_name']; ?></span>
                                    <input class=" fname form-control input-sm" type="text" name="currency_name" value="<?php echo $currencies_data[$key]['currency_name']; ?>" style="display: none;">
                                </td>
                                <td>
                                    <span class="editSpan fee_rate"><?php echo $currencies_data[$key]['fee_rate']; ?>%</span>
                                    <input class="editInput form-control input-sm fee_rate" type="text" name="fee_rate" value="<?php echo $currencies_data[$key]['fee_rate']; ?>%" style="display: none;">
                                </td>
                                <td>
                                    <span class="change_date"><?php echo $currencies_data[$key]['change_date']; ?></span>
                                    <input class="change_date form-control input-sm" type="text" name="email" value="<?php echo $currencies_data[$key]['change_date']; ?>" style="display: none;">
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-sm btn-danger editBtn" style="float: none;"><span class="glyphicon glyphicon-pencil">Edit</span></button>
                                        <!--<button type="button" class="btn btn-sm btn-default deleteBtn" style="float: none;"><span class="glyphicon glyphicon-trash"></span></button>-->
                                    </div>
                                    <button type="button" class="btn btn-sm btn-success saveBtn" style="float: none; display: none;">Save</button>
                                    <!--<button type="button" class="btn btn-sm btn-danger confirmBtn" style="float: none; display: none;">Confirm</button>-->
                                </td>
                            </tr>
                        <?php endforeach;
                    else:
                        ?>
                        <tr><td colspan="5">No user(s) found......</td></tr>
<?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
