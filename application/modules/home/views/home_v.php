<?php $random = rand(0, 1); ?>
<div class="wrapper">
    <h3 class="text-center text-info mt-4 wow bounceInDown" data-wow-duration="2.8s">Safe and Simple Shopping</h3>
    <div class="text-center mt-4">
        <?php $this->load->view('templates/slideshow_v'); ?>
    </div>
    <h3 class="text-center text-info mt-4 wow bounceInUp" data-wow-duration="2.8s">Instant Money Transfers</h3>
    <ul class="main-menu__list text-center">
        <a href="<?php echo base_url('user/login'); ?>" class="btn btn-warning btn-sm wow <?php echo ($random == 0 ? 'rotateInDownRight' : 'slideInLeft'); ?>" data-wow-duration="2s" style="margin:10px;">LOGIN</a>
        <a href="<?php echo base_url('user/register'); ?>" class="btn btn-warning btn-lg wow <?php echo ($random == 0 ? 'rotateInDownLeft' : 'slideInRight'); ?>" data-wow-duration="2s">REGISTER NEW ACCOUNT</a>
    </ul>
</div>

