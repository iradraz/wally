<div class="row justify-content-center">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Feedback Section</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text text-center">Generated all the feedbacks of the system from the database</p>
                <a href="#" class="card-link"></a>
                <a href="#" class="card-link"></a>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Feedback List</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Review</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php  //echo '<pre>'; print_r($feedback_data); echo '</pre>'; die ; ?>
                        <?php foreach ($feedback_data as $key => $value) { ?>
                            <?php echo '<tr>'; ?>
                            <?php echo '<th scope="row">'.$feedback_data[$key]['feedback_id'].'</th>'; ?>
                            <?php echo '<td>'.$feedback_data[$key]['user_firstname'].'</td>'; ?>
                            <?php echo '<td>'.$feedback_data[$key]['user_lastname'].'</td>'; ?>
                            <?php echo '<td>' . $feedback_data[$key]['feedback_text'] . '</td>'; ?>
                            <?php echo '</tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>