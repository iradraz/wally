<div class="container wow fadeIn" data-wow-duration="5s">
    <h3 class="text-center text-info">Registration Form</h3>
    <form action="<?php echo base_url('/user/register_user'); ?>" method="post">
        <div class="form-group text-info col-md-6">
            <label for="first">* First Name:</label>
            <input type="first" class="form-control" id="first" value="<?php echo set_value('first'); ?>" placeholder="John" name="first">
            <label for="last">* Last Name:</label>
            <input type="last" class="form-control" id="last" value="<?php echo set_value('last'); ?>" placeholder="Snow" name="last">
            <span class="text-danger"><?php echo form_error('first'); ?></span>
            <span class="text-danger"><?php echo form_error('last'); ?></span>
        </div>
        <div class="form-group text-info col-md-6">
            <label for="phone">Phone Number:</label>
            <input type="phone" class="form-control" id="phone" value="<?php echo set_value('phone'); ?>" placeholder="Enter Phone Number" name="phone">
            <span class="text-danger"><?php echo form_error('phone'); ?></span>
        </div>
        <div class="form-group text-info col-md-6">
            <label for="email">* Email: </label>
            <input type="email" class="form-control" id="email" value="<?php echo set_value('email'); ?>" placeholder="Enter Email" name="email">
            <span class="text-danger"><?php echo form_error('email'); ?></span>
        </div>
        <div class="form-group text-info col-md-6">
            <label for="pswd">* Password:</label>
            <input type="password" class="form-control" placeholder="Enter Password" name="pswd">
            <input type="password" class="form-control mt-2" placeholder="Enter Password Verification" name="pswdvrfy">
            <span class="text-danger"><?php echo form_error('pswd'); ?><?php echo form_error('pswdvrfy'); ?></span>
        </div>
        <div class="form-group form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember"> Remember me
            </label>
        </div>
        <ul>
            <div>
                <button type="submit" class="btn btn-info">Submit</button>

                </form>
                <a href="<?php echo base_url('/home'); ?>" class="ml-5">Back Home</a>
                <div class="mt-2">
                    <span class="text-center text-danger">all fields with <b>*</b> mark are required!</span>
                </div>
            </div>
        </ul>
</div>