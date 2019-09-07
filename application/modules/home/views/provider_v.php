<style>
    .newsletter-bg {
        background-image: url('img/shake_hands_background.jpg');
        background-repeat: no-repeat;
        background-size: 720px auto;
    }

    .bg {
        background-position: center top;
        padding: 100px 300px;
        height: 100vh
    }

    .wrap {
        position: relative;
    }

    .newsletter-bg {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 30px;
        margin: 0 auto;
        background-position: center -200px;
        -webkit-filter: blur(20px);
    }

    .newsletter-text {
        border: 2px solid white;
        padding: 50px;
        margin: 0 auto;
        position: relative;
        max-width: 500px;
        h2 {
            color: white;
            margin-top: 0;
            text-align: center;
            text-transform: uppercase;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
        }
    }
</style>

<div class="card text-primary" style="opacity:0.8">
    <h1>Are you are provider?</h1>
    <h2 class="text-warning">Lets shake hands and work together</h2>
    <p class="text-warning">Fill the form at the bottom of the page and send it to our BackOffice directly.</p>
</div>
<div class="bg">
    <?php // echo form_open_multipart('/home/provider'); ?>
    <form action="<?php echo base_url('/home/provider'); ?>" enctype="multipart/form-data" method="post">
        <div class="form-group text-info col-md-6">
            <label for="provider_name">* Provider Name:</label>
            <input class="form-control" value="<?php echo set_value('provider_name'); ?>" placeholder="Cloud Currency" name="provider_name" required>
            <span class="text-danger"><?php echo form_error('first'); ?></span>
            <span class="text-danger"><?php echo form_error('last'); ?></span>
        </div>
        <div class="form-group text-info col-md-6">
            <label for="currencies">* Supported Currencies:</label>
            <textarea type="text" class="form-control" placeholder="EURUSD, GBPUSD" name="supported_currencies" required></textarea>
            <span class="text-danger"><?php echo form_error('supported_currencies'); ?></span>
        </div>
        <div class="form-group text-info col-md-6">
            <label for="email">* Email: </label>
            <input type="email" class="form-control" id="email" value="<?php echo set_value('contact_email'); ?>" placeholder="Enter Email" name="contact_email" required>
            <span class="text-danger"><?php echo form_error('contact_email'); ?></span>
        </div>
        <div class="form-group text-info col-md-6">
            <label for="phone">Phone Number:</label>
            <input type="phone" class="form-control" id="phone" value="<?php echo set_value('phone'); ?>" placeholder="Enter Phone Number" name="contact_phone">
            <span class="text-danger"><?php echo form_error('contact_phone'); ?></span>
        </div>
        <div class="form-group text-info col-md-6">
            <label for="file">Choose API file (PDF only):</label>
            <input type="file" id="file" name="file" accept="application/pdf">
            <span class="text-danger"><?php echo form_error('file'); ?></span>
        </div>

        <ul>
            <div>
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </ul>
    </form>
</div>
