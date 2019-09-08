<script>
    $(document).ready(function () {
        $('.susBtn').on('click', function () {
            $(this).closest("tr").find(".susBtn").hide();
            //show edit button
            $(this).closest("tr").find(".revBtn").fadeIn(500);
            var trObj = $(this).closest("tr");
            var ID = $(this).closest("td").attr('id');
            $.ajax({
                type: 'POST',
                url: 'admin/suspend_revert',
                dataType: "json",
                data: 'user_id=' + ID,
                success: function (response) {
                    if (response.status == 'ok') {
                        trObj.find(".active_user").text(response.data.user_role);
                        trObj.find(".active_user").removeClass('text-primary');
                        trObj.find(".active_user").addClass('text-danger');
                        $('#success').fadeIn(500).delay(2000).fadeOut('slow').text('Client has been suspended!').css("color","red");

                    } else {
                        alert(response.msg);
                    }
                }
            });
        });

        $('.revBtn').on('click', function () {
            $(this).closest("tr").find(".revBtn").hide();
            //show edit button
            $(this).closest("tr").find(".susBtn").fadeIn(500);
            var trObj = $(this).closest("tr");
            var ID = $(this).closest("td").attr('id');
            $.ajax({
                type: 'POST',
                url: 'admin/suspend_revert',
                dataType: "json",
                data: 'user_id=' + ID,
                success: function (response) {
                    if (response.status == 'ok') {
                        trObj.find(".active_user").text(response.data.user_role);
                        trObj.find(".active_user").removeClass('text-danger');
                        trObj.find(".active_user").addClass('text-primary');
                        $('#success').fadeIn(500).delay(2000).fadeOut('slow').text('Client has been granted').css("color","green");

                    } else {
                        alert(response.msg);
                    }
                }
            });
        });
    });
</script>

<div class="container-fluid">
    <!--    <div class="row justify-content-center">
            <div class="col-5" style="min-width: 250px;">
                <div class="card text-center">
                    <div class="card-body">
                        <p class="card-text">User Management Section</p>
                    </div>
                </div>
            </div>
        </div>-->

    <div class="row justify-content-center">
        <div class="col-9" style="flex-grow: 1; min-width: 500px;">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary text-center ">User Management</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">User ID #</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Registration Date</th>
                                <th scope="col">Last Login Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">ACTION</th>

                            </tr>
                        </thead>
                        <tbody><?php // print_r($users);die;                                 ?>
                            <?php foreach ($users as $key => $value) { ?>
                                <?php echo '<tr>'; ?>
                                <?php echo '<th scope="row">' . ($key + 1) . '</th>'; ?>
                                <?php echo '<td scope="row" id=' . $users[$key]['user_id'] . '>' . $users[$key]['user_id'] . '</td>'; ?>                            
                                <?php echo '<td scope="row">' . $users[$key]['user_firstname'] . '</td>'; ?>
                                <?php echo '<td>' . $users[$key]['user_lastname'] . '</td>'; ?>

                                <?php echo '<td>' . $users[$key]['user_email'] . '</td>';
                                ?>
                                <?php echo '<td scope="row">' . $users[$key]['user_phone'] . '</td>'; ?>                            
                                <?php echo '<td scope="row">' . $users[$key]['user_registered_date'] . '</td>'; ?>
                                <?php echo '<td scope="row">' . $users[$key]['user_last_login'] . '</td>'; ?>
                                <?php
                                echo ($users[$key]['user_role'] == 'client') ? '<td scope="row" class="text-primary active_user" style="min-width:110px;">Active</td><td scope="row" class="text-danger active_user" style="display:none; max-width:35px;">Suspended</td>' :
                                        '<td scope="row" class="text-danger active_user" style="min-width:110px;">Suspended</td><td scope="row" class="text-primary active_user" style="display:none;">Active</td>';
                                ?>
                                <?php
                                echo ($users[$key]['user_role'] == 'client') ?
                                        '<td class="susBtn" id="' . $users[$key]['user_id'] . '"><a href="#" class="suspend_user btn btn-danger btn-sm" id="' . $users[$key]['user_id'] . '"><span class="glyphicon glyphicon-remove"></span> Suspend </a></td>' .
                                        '<td class="revBtn" id="' . $users[$key]['user_id'] . '" style="display:none;"><a href="#" class="unsuspend_user btn btn-danger btn-sm" id="' . $users[$key]['user_id'] . '"><span class="glyphicon glyphicon-add"></span> Revert </a></td>' :
                                        '<td class="susBtn" id="' . $users[$key]['user_id'] . '" style="display:none;"><a href="#" class="suspend_user btn btn-danger btn-sm" id="' . $users[$key]['user_id'] . '"><span class="glyphicon glyphicon-add"></span> Suspend </a></td>' .
                                        '<td class="revBtn" id="' . $users[$key]['user_id'] . '" ><a href="#" class="unsuspend_user btn btn-danger btn-sm" id="' . $users[$key]['user_id'] . '"><span class="glyphicon glyphicon-remove"></span> Revert </a></td>'
                                ?>

                                <?php
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>               
                </div>               
            </div>
        </div>
        <div class="col-2">
            <div class="" id="success" style="display: none;">Action executed succesfully.</div>

        </div>
    </div>
</div>