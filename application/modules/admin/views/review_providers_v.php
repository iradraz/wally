<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-5" style="min-width: 250px;">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-primary">Wally Wallet</h5>
                    <p class="card-text">Review Providers</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8" style="flex-grow: 1; min-width: 500px;">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary text-center ">Providers Review</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Provider Name</th>
                                <th scope="col">Supported Currencies</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>

                                <th scope="col">Developers API</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">ACTION</th>

                            </tr>
                        </thead>
                        <tbody><?php // print_r($providers);die;        ?>
                            <?php foreach ($providers as $key => $value) { ?>
                                <?php echo '<tr>'; ?>
                                <?php echo '<th scope="row">' . ($key + 1) . '</th>'; ?>                  
                                <?php echo '<td scope="row">' . $providers[$key]['provider_name'] . '</td>'; ?>
                                <?php echo '<td>' . $providers[$key]['supported_currencies'] . '</td>'; ?>
                                <?php echo '<td scope="row">' . $providers[$key]['contact_phone'] . '</td>'; ?>  

                                <?php echo '<td scope="row">' . $providers[$key]['contact_email'] . '</td>'; ?>
                                <?php $first = explode('.pdf', $providers[$key]['file']); ?>
                                <?php echo '<td scope="row"><a href="' . base_url('files/') . $providers[$key]['provider_name'] . '/' . $providers[$key]['file'] . '">' . $first[0] . '</a></td>' ?> 
                                <?php echo '<td>' . $providers[$key]['creation_date'] . '</td>'; ?>
                                <?php echo '<td id="' . $providers[$key]['provider_id'] . '"><a href="#" class="delete_data btn btn-danger btn-sm" id="' . $providers[$key]['provider_id'] . '"><span class="glyphicon glyphicon-remove"></span> Remove </a></td>'; ?>

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