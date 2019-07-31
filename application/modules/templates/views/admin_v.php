<?php $session_data = $this->session->userdata(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex, nofollow"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            header{margin-top:50px;text-align: center; font-size:50px; font-weight: bold;}
            body{background:#f9f9f9;}
            #wrapper{padding:90px 15px;}
            .navbar-expand-lg .navbar-nav.side-nav{flex-direction: column;}
            .card{margin-bottom: 15px; border-radius:0; box-shadow: 0 3px 5px rgba(0,0,0,.1); }
            .header-top{box-shadow: 0 3px 5px rgba(0,0,0,.1)}
            .leftmenutrigger{display: none}
            @media(min-width:992px) {
                .leftmenutrigger{display: block;display: block;margin: 7px 20px 4px 0;cursor: pointer;}
                #wrapper{padding: 90px 15px 15px 15px; }
                .navbar-nav.side-nav.open {left:0;}
                .navbar-nav.side-nav{background: #585f66;box-shadow: 2px 1px 2px rgba(0,0,0,.1);position:fixed;top:56px;flex-direction: column!important;left:-220px;width:200px;overflow-y:auto;bottom:0;overflow-x:hidden;padding-bottom:40px}
            }
            .animate{-webkit-transition:all .3s ease-in-out;-moz-transition:all .3s ease-in-out;-o-transition:all .3s ease-in-out;-ms-transition:all .3s ease-in-out;transition:all .3s ease-in-out} </style>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="../jquery/table-edits.js"></script>
        <link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity = "sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin = "anonymous">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <title>Wally Admin Dashboard</title>
    </head>
    <body>
        <header>Admin Dashboard</header>
        <div id="wrapper" class="animate">
            <aside>
                <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
                    <span class="navbar-toggler-icon leftmenutrigger"></span>
                    <a class="navbar-brand" href="<?php echo base_url('/home/'); ?>"><img src="<?php echo base_url('/img/footer-logo.png'); ?>" class="img-responsive" width="20" height="20" />ally</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav animate side-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('/'); ?>">Home
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('/admin/management'); ?>">System Management</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('/admin/currencies'); ?>">Add Currencies</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('/admin/transactions'); ?>">Review Transactions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('/admin/feedback'); ?>">Review Feedbacks</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('/admin/fees'); ?>">Fees</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('/home/logout'); ?>">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </aside>
            <main>
                <?php
                $this->load->view($content_view);
                ?>
            </main>
        </div>
        <footer><h2 class="text-center text-primary"><img src="<?php echo base_url('/img/footer-logo.png'); ?>" class="img-responsive" width="90" height="80" /></h2></footer>
    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.leftmenutrigger').on('click', function (e) {
                $('.side-nav').toggleClass("open");
                e.preventDefault();
            });
        });</script>
    <script type="text/javascript">
        (function ($) {
            $('#theme_chooser').change(function () {
                whichCSS = $(this).val();
                document.getElementById('snippet-preview').contentWindow.changeCSS(whichCSS);
            });
        })(jQuery);
    </script>

</html>
