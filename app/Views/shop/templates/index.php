<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoppe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css" />

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/owl.theme.default.min.css">


    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/aos.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css">

</head>

<body>

    <div class="site-wrap">
        <header class="site-navbar" role="banner">
            <div class="site-navbar-top">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">

                        </div>

                        <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                            <div class="site-logo">
                                <a href="<?= base_url('/'); ?>" class="js-logo-clone">TOKO ABI</a>
                            </div>
                        </div>

                        <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                            <div class="site-top-icons">
                                <ul>
                                    <?php if (!logged_in()) : ?>
                                        <li><a href="<?= base_url('/login'); ?>"><span class="icon icon-person"></span></a></li>
                                    <?php elseif (user_id() == 1) : ?>
                                        <li><a href="<?= base_url('/admin'); ?>"><span class="icon icon-person"></span></a></li>
                                    <?php else : ?>
                                        <li><a href="<?= base_url('/user'); ?>"><span class="icon icon-person"></span></a></li>
                                        <li>
                                            <a href="<?= base_url('/chart'); ?>" class="site-cart">
                                                <span class="icon icon-shopping_cart"></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="site-navigation text-right text-md-center" role="navigation">
                <div class="container">
                    <ul class="site-menu js-clone-nav d-none d-md-block">
                        <li class="has-children active">
                        <li><a href="<?= base_url('/'); ?>">Home</a></li>
                        <li><a href="<?= base_url('about'); ?>">About</a></li>
                        <li><a href="<?= base_url('shop'); ?>">Shop</a></li>
                        <li><a href="<?= base_url('contact'); ?>">Contact</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <?= $this->renderSection('shopcon'); ?>

        <footer class="site-footer border-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-8 col-lg-6 mb-lg-0">
                        <div class="block-5 mb-5">
                            <h3 class="footer-heading mb-4">Contact Info</h3>
                            <ul class="list-unstyled">
                                <li class="address"><a href="https://www.google.com/maps/place/Toko+Abi/@-6.8741996,107.5545002,17z/data=!3m1!4b1!4m6!3m5!1s0x2e68e43bfad9ce8f:0x1f0531905807305b!8m2!3d-6.8742049!4d107.5570751!16s%2Fg%2F11g6xq7bh6?entry=ttu">Jl. Kec. No.35, RT.03/RW.09, Cibabat, Kec. Cimahi Utara, Kota Cimahi, Jawa Barat 40513</a></li>
                                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="<?= base_url(); ?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/jquery-ui.js"></script>
    <script src="<?= base_url(); ?>/assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/aos.js"></script>

    <script src="<?= base_url(); ?>/assets/js/main.js"></script>

</body>

</html>