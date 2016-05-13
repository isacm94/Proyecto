<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Shop's Admin <?= $title ?></title>

        <!-- CSS -->
        <link href="<?= base_url() . 'assets/templates/Venta/template2/' ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/Venta/template2/' ?>css/font-awesome.min.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/Venta/template2/' ?>css/animate.min.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/Venta/template2/' ?>css/prettyPhoto.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/Venta/template2/' ?>css/main.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/Venta/template2/' ?>css/responsive.css" rel="stylesheet">

        <script src="<?= base_url() . 'assets/templates/Venta/template2/' ?>js/html5shiv.js"></script>
        <script src="<?= base_url() . 'assets/templates/Venta/template2/' ?>js/respond.min.js"></script>

        <?= $linksHeadVenta ?>
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url() . 'assets/templates/Venta/template2/' ?>images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url() . 'assets/templates/Venta/template2/' ?>images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url() . 'assets/templates/Venta/template2/' ?>images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?= base_url() . 'assets/templates/Venta/template2/' ?>images/ico/apple-touch-icon-57-precomposed.png">
    </head><!--/head-->

    <body class="homepage">

        <header id="header">
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="pull-right">                            
                            <?=$linksUsuarios?>
                        </div>
                    </div>
                </div><!--/.container-->
            </div><!--/.top-bar-->

            <nav class="navbar navbar-inverse" role="banner" style="border-radius: 0px;">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?= site_url() ?>"><img src="<?= base_url() . 'assets/images/logo_negro.png' ?>" alt="logo"></a>
                    </div>

                    <div class="collapse navbar-collapse navbar-right">
                        <ul class="nav navbar-nav">
                            <li class="<?php if ($active == 'activehome') echo 'active'; ?>"><a href="<?= site_url() ?>">Home</a></li>
                            <li class="dropdown <?php if ($active == 'activecategorias') echo 'active'; ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorías <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
                                    <?= $linksMenuCategorias ?>>
                                </ul>
                            </li>                       
                        </ul>
                    </div>
                </div>
            </nav>

        </header>

        <section id="feature" >
            <div class="container">
                <div class="center wow fadeInDown">
                    <h2><?= $titulo ?> <small><?= $descripcion ?></small></h2>                
                </div>
                <!--CUERPO-->
                <div class="contenedor-home contenedor-categoria">
                    <?= $cuerpo ?>
                </div>

            </div>
        </section>


        <!-- PIE -->
        <footer id="footer" class="midnight-blue">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright © 2016 Todos los derechos reservados.
                    </div>
                    <div class="col-sm-6">
                        <ul class="pull-right">
                            Isabel María Calvo Mateos
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- SCRIPTS-->
        <script src="<?= base_url() . 'assets/templates/Venta/template2/' ?>js/jquery.js"></script>
        <script src="<?= base_url() . 'assets/templates/Venta/template2/' ?>js/bootstrap.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/Venta/template2/' ?>js/jquery.prettyPhoto.js"></script>
        <script src="<?= base_url() . 'assets/templates/Venta/template2/' ?>js/jquery.isotope.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/Venta/template2/' ?>js/main.js"></script>
        <script src="<?= base_url() . 'assets/templates/Venta/template2/' ?>js/wow.min.js"></script>
        <script src="https://use.fontawesome.com/8ed0c17aec.js"></script>
        <?= $linksJS ?>
    </body>
</html>