<?php
/*
 * PLANTILLA 1 DEL MÓDULO DE ADMINISTRACIÓN
 */
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="robots" content="all,follow">
        <meta name="googlebot" content="index,follow,snippet,archive">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shop's Admin <?= $title ?></title>

        <meta name="keywords" content="">

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800' rel='stylesheet' type='text/css'>

        <!-- Bootstrap and Font Awesome css -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>css/animate.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>css/style.default.css" rel="stylesheet" id="theme-stylesheet">
        <link href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>css/custom.css" rel="stylesheet">

        <link rel="apple-touch-icon" href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>img/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>img/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>img/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>img/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>img/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>img/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>img/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>img/apple-touch-icon-152x152.png" />
        <link href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>css/owl.carousel.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/Administracion/template2/' ?>css/owl.theme.css" rel="stylesheet">
        <?= $linksHead ?>
    </head>

    <body>
        <div id="all">
            <header>
                <!-- TOP -->
                <div id="top">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-5 contact">
                                
                            </div>
                            <div class="col-xs-7">

                                <div class="login">
                                    <a href="<?= $linksUsuario['CerrarSesion'] ?>"><i class="fa fa-sign-out"></i> <span class="hidden-xs text-uppercase">Cerrar sesión</span></a>
                                    <a href="<?= $linksUsuario['Perfil'] ?>"><i class="fa fa-user"></i> <span class="hidden-xs text-uppercase">Perfil</span></a>
                                    <?= $linkVenta ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- MENÚ - BARRA DE NAVEGACIÓN -->

                <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

                    <div class="navbar navbar-default yamm" role="navigation" id="navbar">

                        <div class="container">
                            <div class="navbar-header">

                                <a class="navbar-brand home" href="<?= site_url('/Administrador') ?>">
                                    <img src="<?= base_url() ?>assets/images/logo.png" alt="Universal logo" class="hidden-xs hidden-sm">
                                    <img src="<?= base_url() ?>assets/images/logo-small.png" alt="Universal logo" class="visible-xs visible-sm"><span class="sr-only">Universal - go to homepage</span>
                                </a>
                                <div class="navbar-buttons">
                                    <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                                        <span class="sr-only">Toggle navigation</span>
                                        <i class="fa fa-align-justify"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="navbar-collapse collapse" id="navigation">

                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                        <a href="javascript: void(0)" class="dropdown-toggle" style="text-decoration: none;" data-toggle="dropdown"><i class="fa fa-plus"></i> Agregar <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($linksMenuAgregar as $link): ?>
                                                <li><?= $link ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="javascript: void(0)" class="dropdown-toggle" style="text-decoration: none;" data-toggle="dropdown"><i class="fa fa-list"></i> Listas <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($linksMenuLista as $link): ?>
                                                <li><?= $link ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    
                                    <li><?=$linksConfigPlantillas?></li>
                                    
                                    <li>
                                        <?=$linkAvisos?>
                                    </li>
                                </ul>

                            </div>

                        </div>
                    </div>

                </div>

            </header>


            <!-- CUERPO -->
            <section class="bar background-gray cuerpotemplate2">
                <div class="container">
                    <div class="col-md-12">
                        <?php if (isset($titulo) && $titulo != ''): ?>
                            <div class="heading text-rigth">
                                <h3>
                                    <?php
                                    if (isset($titulo))
                                        echo $titulo;
                                    ?>
                                    <small> <?php
                                        if (isset($descripcion))
                                            echo $descripcion;
                                        ?></small>                    </h3>                
                            </div>
                        <?php endif; ?>
                        <?php
                        if (isset($cuerpo))
                            echo $cuerpo;
                        ?>
                    </div>
                </div>
            </section>
            <!-- PIE -->
            <div id="copyright">
                <div class="container">
                    <div class="col-md-12">
                        <p class="pull-left">Copyright &copy; 2016 Todos los derechos reservados.</p>
                        <p class="pull-right">
                            Isabel María Calvo Mateos
                            <!--Template by <a href="http://bootstrapious.com">Bootstrap 4 Themes</a> with support from <a href="http://kakusei.cz">Designové předměty</a> 
                             Not removing these links is part of the licence conditions of the template. Thanks for understanding :) -->
                        </p>

                    </div>
                </div>
            </div>
        </div>

        <!-- #### JAVASCRIPT FILES ### -->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>
            window.jQuery || document.write('<script src="<?= base_url() . 'assets/templates/Administracion/template2/' ?>js/jquery-1.11.0.min.js"><\/script>')
        </script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <script src="<?= base_url() . 'assets/templates/Administracion/template2/' ?>js/jquery.cookie.js"></script>
        <script src="<?= base_url() . 'assets/templates/Administracion/template2/' ?>js/waypoints.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/Administracion/template2/' ?>js/jquery.counterup.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/Administracion/template2/' ?>js/jquery.parallax-1.1.3.js"></script>
        <script src="<?= base_url() . 'assets/templates/Administracion/template2/' ?>js/front.js"></script>
        <script src="<?= base_url() . 'assets/templates/Administracion/template2/' ?>js/owl.carousel.min.js"></script>
        <?=$linksJS?>
    </body>

</html>