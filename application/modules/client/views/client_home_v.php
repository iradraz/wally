
<?php $session_data = $this->session->userdata(); ?>


<div class="container-fluid wow fadeIn" data-wow-duration="2s">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">  
                <div class="card-body">
                    <h5 class="card-title"><?php echo $session_data['user_firstname']; ?> Wally Wallet</h5>
                    <p class="card-text">The system is under construction, please give us a Feedback here</p>
                    <a href="<?php echo base_url('/client/feedback'); ?>" class="card-link">Feedback our service</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Wally Wallet</h5>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <p class="card-text">Soon you will be able to see all the transaction transparently</p>
                    <a href="<?php echo base_url('/client/subscribe'); ?>" class="card-link">Subscribe!</a>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Wally Wallet</h5>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <p class="card-text">Add funds to your account</p>
                    <a href="<?php echo base_url('/client/deposit'); ?>" class="card-link">Add funds!</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-6" style="text-align: center">
            <div class="card">  
                <div class="card-body">
                    <h5 class="card-title">Wally Wallet</h5>
                    <p class="card-text">View your Wallet</p>
                    <a href="<?php echo base_url('/client/wallet'); ?>" class="card-link">My Wallet</a>
                </div>
            </div>
        </div>
    </div>
</div>

