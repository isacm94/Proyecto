<?php
/*
 * PLANTILLA 1 DEL MÓDULO DE VENTA
 */
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="robots" content="all,follow">
        <meta name="googlebot" content="index,follow,snippet,archive">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Obaju e-commerce template">
        <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
        <meta name="keywords" content="">
        <title>Shop's Admin <?= $title ?></title>
        <meta name="keywords" content="">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

        <!-- styles -->
        <link href="<?= base_url() . 'assets/templates/Venta/template1/' ?>css/font-awesome.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/Venta/template1/' ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/Venta/template1/' ?>css/animate.min.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/Venta/template1/' ?>css/owl.carousel.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/Venta/template1/' ?>css/owl.theme.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/Venta/template1/' ?>css/style.violet.css" rel="stylesheet" id="theme-stylesheet">
        <link href="<?= base_url() . 'assets/templates/Venta/template1/' ?>css/custom.css" rel="stylesheet">
        <script src="<?= base_url() . 'assets/templates/Venta/template1/' ?>js/respond.min.js"></script>
        <script src="https://use.fontawesome.com/8ed0c17aec.js"></script>

        <!-- links-->
        <?= $linksHeadVenta ?>
    </head>

    <body>

        <div class="cabecera">
        <!-- *** TOPBAR ***-->
        <div id="top">
            <div class="container">
                <div class="pull-right">                            
                    <?=$linksUsuarios?>
                </div>
            </div>
        </div>

        <!-- *** TOP BAR END *** -->

        <!-- *** NAVBAR ***-->

        <div class="navbar navbar-default yamm" role="navigation" id="navbar">
            <div class="container">
                <div class="navbar-header">

                    <a class="navbar-brand home" href="<?= site_url() ?>" data-animate-hover="bounce">
                        <img src="<?= base_url() ?>assets/images/logo.png" class="hidden-xs">
                        <img src="<?= base_url() ?>assets/images/logo.png" class="visible-xs"><span class="sr-only"></span>
                    </a>
                    <div class="navbar-buttons">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="fa fa-align-justify"></i>
                        </button>
                        <a class="btn btn-default navbar-toggle" href="<?=  site_url("/Carrito")?>">
                            <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">3 items in cart</span>
                        </a>
                    </div>
                </div>

                <div class="navbar-collapse collapse" id="navigation">

                    <ul class="nav navbar-nav navbar-left">
                        <li class="<?php if ($active == 'activehome') echo 'active'; ?>">
                            <a href="<?= site_url() ?>">Home</a>
                        </li>
                        <li class="dropdown <?php if ($active == 'activecategorias') echo 'active'; ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Categorías <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?= $linksMenuCategorias ?>
                            </ul>
                        </li>
                    </ul>

                </div>

                <!-- Carrito-->
                <div class="navbar-buttons">
                    <div class="navbar-collapse collapse right">
                        <?=$linkCarrito?>
                    </div>
                </div>

            </div>

        </div>
        </div>


        <div id="all">

            <div id="content">

                <div class="container cuerpo">
                    <div class="col-md-12">
                        <div id="hot">
                            <h2><?= $titulo ?> <small><?= $descripcion ?></small></h2>
                        </div>

                        <div class="cuerpo-paginacion">
                            <?= $cuerpo ?>
                        </div>
                    </div>
                </div>

                <!-- *** FOOTER*** -->
                <div id="copyright" class="pie">
                    <div class="container">
                        <div class="col-md-6">
                            <p class="pull-left">Copyright © 2016 Todos los derechos reservados.</p>

                        </div>
                        <div class="col-md-6">
                            <p class="pull-right">Isabel María Calvo Mateos
                                <!--<a href="http://bootstrapious.com/e-commerce-templates">Bootstrap Ecommerce Templates</a> with support from <a href="http://kakusei.cz">Designové předměty</a> 
                                <!-- Not removing these links is part of the licence conditions of the template. Thanks for understanding :) -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="flecha-top" href=""><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
        <!-- /#all -->




        <!-- SCRIPTS-->
        <script src="<?= base_url() . 'assets/templates/Venta/template1/' ?>js/jquery-1.11.0.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/Venta/template1/' ?>js/bootstrap.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/Venta/template1/' ?>js/jquery.cookie.js"></script>
        <script src="<?= base_url() . 'assets/templates/Venta/template1/' ?>js/waypoints.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/Venta/template1/' ?>js/modernizr.js"></script>
        <script src="<?= base_url() . 'assets/templates/Venta/template1/' ?>js/bootstrap-hover-dropdown.js"></script>
        <script src="<?= base_url() . 'assets/templates/Venta/template1/' ?>js/owl.carousel.min.js"></script>
        <!--<script src="<?= base_url() . 'assets/templates/Venta/template1/' ?>js/front.js"></script>-->
         <!-- SCRIPTS NO-->
        <?= $linksJS ?>

    </body>

</html>