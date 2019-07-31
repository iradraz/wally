<div class="container contact-form">
    <form action="<?php echo base_url('/client/feedback_post'); ?>" method="post">
        <div class="row justify-content-center ">
            <div class="col-10">
                <div class="contact-image text-center">
                    <img src="<?php echo base_url('/img/footer-logo.png'); ?>" alt="wally" height="100" width="90" style="padding-bottom: 15px;"/>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Drop Us a Message :)</h5>
                        <h6 class="card-subtitle mb-6 text-muted"><textarea name="feedback_text" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea></h6>
                        <span class="text-danger"><?php echo form_error('feedback_text'); ?></span>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>