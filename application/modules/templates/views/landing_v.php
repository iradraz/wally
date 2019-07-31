<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url('/css/animate.css'); ?>">
        <!--<script src="<?php // echo base_url('/jquery/jquery-3.4.1.min.js');    ?>" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('/jquery/jquery-3.4.1.slim.min.js'); ?>" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('/jquery/wow.min.js'); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/fullpage.css'); ?>" />
        <script>
            new WOW().init();
        </script>
        <title>Wally</title>
        <style>
            .section.jumbotron{
                background-image: url("<?php echo base_url('img/background.jpg') ?>");
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
            }
            .section.s2{
                background-image: url("<?php echo base_url('img/shake_hands_background.jpg') ?>");
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
            }
            .section.s3{
                background-image: url("<?php echo base_url('img/stock.jpg') ?>");
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
            }
            .section.s4{
                background-image: url("<?php echo base_url('img/about_us_background.jpg') ?>");
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body>
        <header></header>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>-->
        <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
        <div id="fullpage">
            <div class="section jumbotron wow fadeIn" data-wow-duration="2.8s">
                <div class="col-12">
                    <h2 class="text-center text-warning wow bounceInDown" data-wow-duration="2s">Wally - My Digital Wallet</h2>


                    <?php
                    $this->load->view($content_view);
                    ?>
                </div>
                <footer><h2 class="text-center text-primary wow bounceInUp" data-wow-duration="4s"><img src="<?php echo base_url('/img/footer-logo.png'); ?>" class="img-responsive" width="90" height="80" /></h2></footer>

            </div>
            <?php if ($content_view == 'home/home_v') { ?>
                <div class="section s2">
                    <?php $this->load->view('home/provider_v'); ?>
                </div>
                <div class="section s3">
                    <?php $this->load->view('home/why_us_v'); ?>
                </div>
                <div class="section s4">
                    <?php $this->load->view('home/about_v'); ?>
                </div>
            <?php } ?>
    </body>
    <script type="text/javascript" src="https://rawgit.com/alvarotrigo/fullPage.js/dev/src/fullpage.js"></script>

    <script>
            $(document).ready(function () {
                $('#fullpage').fullpage({
                    anchors: ['page1', 'page2', 'page3', 'page4'],
<?php echo ($content_view == 'user/register_v' || $content_view == 'user/login_v') ? 'autoScrolling: false,' : 'autoScrolling:true'; ?>

                });

                //methods
                //  $.fn.fullpage.setAllowScrolling(true);
            });
    </script>
</html>
