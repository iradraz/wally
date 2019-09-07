<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-5" style="min-width: 250px;">
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text">User Management Section</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-10" style="flex-grow: 1; min-width: 500px;">
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
                        <tbody><?php // print_r($users);die;            ?>
                            <?php foreach ($users as $key => $value) { ?>
                                <?php echo '<tr>'; ?>
                                <?php echo '<th scope="row">' . ($key + 1) . '</th>'; ?>
                                <?php echo '<td scope="row">' . $users[$key]['user_id'] . '</td>'; ?>                            
                                <?php echo '<td scope="row">' . $users[$key]['user_firstname'] . '</td>'; ?>
                                <?php echo '<td>' . $users[$key]['user_lastname'] . '</td>'; ?>

                                <?php echo '<td>' . $users[$key]['user_email'] . '</td>';
                                ?>
                                <?php echo '<td scope="row">' . $users[$key]['user_phone'] . '</td>'; ?>                            
                                <?php echo '<td scope="row">' . $users[$key]['user_registered_date'] . '</td>'; ?>
                                <?php echo '<td scope="row">' . $users[$key]['user_last_login'] . '</td>'; ?>
                                <?php echo ($users[$key]['user_role'] == 'client') ? '<td scope="row" class="text-primary">Active</td>' : '<td scope="row" class="text-danger">Suspended</td>'; ?>
                                <?php
                                echo ($users[$key]['user_role'] == 'client') ?
                                        '<td id="' . $users[$key]['user_id'] . '"><a href="#" class="suspend_user btn btn-danger btn-sm" id="' . $users[$key]['user_id'] . '"><span class="glyphicon glyphicon-remove"></span> Suspend </a></td>' :
                                        '<td id="' . $users[$key]['user_id'] . '"><a href="#" class="unsuspend_user btn btn-danger btn-sm" id="' . $users[$key]['user_id'] . '"><span class="glyphicon glyphicon-add"></span> Revert </a></td>'
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
    </div>
</div>