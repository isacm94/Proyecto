<?php
/*
 * VISTA formada por la cabecera, el cuerpo(pasado a tráves de la vista) y el pie de la aplicación. 
 */
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Camisetas de Fútbol</title>

        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <link rel="stylesheet" href="<?= base_url() ?>assets/template/css/owl.carousel.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/template/style.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/template/css/responsive.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/estilos.css">
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/img/favicon.png">

    </head>
    <body>
        <?php $this->session->set_userdata(array('URL' =>  current_url()));?>
        <div class="header-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="user-menu">
                            <ul>
                                <li><a href="<?= base_url() . 'index.php/Registro' ?>"><i class="fa fa-user"></i> Registro Usuario</a></li>

                                <?php if (!SesionIniciadaCheck()): //Sólo mostrar si la sesión iniciada ?>
                                    <li><a href="<?= base_url() . 'index.php/Login' ?>"><i class="fa fa-user"></i> Login</a></li>
                                <?php endif; ?>
                                
                                     <?= MuestraMonedas() ?> 
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="user-menu">
                            <ul>
                                <?php if (SesionIniciadaCheck()): //Sesión iniciada ?>
                                    <li>
                                        <a href="<?= base_url() . 'index.php/Login/Logout' ?>">
                                            <i class="fa fa-user"></i><?= $this->session->userdata('username'); ?>, Cerrar sesión</a>
                                    </li>
                                    <li>
                                        <a href="<?= site_url() . "/MisPedidos/ver" ?>">
                                            <i class="glyphicon glyphicon-list-alt"></i> Mis pedidos</a>
                                    </li>
                                    <li class="dropdown">
                                        <div class="footer-about-us">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Ajustes de usuario"><span class="glyphicon glyphicon-cog"></span> <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?= base_url() . 'index.php/ModificarUsuario' ?>"><span class="glyphicon glyphicon-pencil"></span> Modificar Usuario</a></li>
                                                <li><a href="<?= base_url() . 'index.php/EliminarUsuario' ?>"><span class="glyphicon glyphicon-trash"></span> Eliminar Usuario</a></li>
                                            </ul>
                                        </div>
                                    </li>                                    
                                <?php endif; ?>
                            </ul>

                        </div>


                    </div>
                </div>
            </div>
        </div> 

        <div class="site-branding-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="logo">
                            <h1><a href="">Camisetas <span>de Fútbol</span> <img src="<?= base_url() ?>assets/img/ball.png" style="height: 65px; width: 65px;"></a></h1>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="shopping-item">
                            <a href="<?= base_url() . 'index.php/Carrito' ?>">Carrito - 
                                <span class="cart-amunt"><?= round($this->myCarrito->precio_total()*$this->session->userdata('rate'), 2).' '.$this->session->userdata('currency') ?></span> <i class="fa fa-shopping-cart"></i>
                                <span class="product-count"><?= $this->myCarrito->articulos_total() ?></span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <!--BARRA-->
        <div class="mainmenu-area" role="navigation">
            <div class="container">
                <div class="row">  
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div> 
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="<?php
                            if (isset($homeactive)) {
                                echo $homeactive;
                            }
                            ?>"><?= anchor('', 'Home') ?></li>
                            <li class="<?php
                            if (isset($categoriaactive)) {
                                echo $categoriaactive;
                            }
                            ?>"><?= anchor('Categorias/ver', 'Categoría') ?></li>                        
                            <li class="<?php
                            if (isset($carritoactive)) {
                                echo $carritoactive;
                            }
                            ?>"><?= anchor('Carrito', 'Carrito') ?></li>
                        </ul>
                    </div>  
                </div>
            </div>
        </div> 

        <div class="product-big-title-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-bit-title text-center">
                            <h2><?php
                                if (isset($titulo))
                                    echo $titulo;
                                ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($cuerpo))
            echo $cuerpo;
        ?>

        <!-- PRE PIE -->
        <div class="footer-top-area">
            <div class="zigzag-bottom"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-about-us">
                            <h2>Camisetas <span>de Fútbol</span></h2>
                            <p>Camisetas de Fútbol SL</p>
                            <p>isacm94@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6"></div>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-about-us">
                            <h2>Otras opciones</h2>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="XML"><span>XML</span> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= base_url() . 'index.php/XML/exportar' ?>"><span class="glyphicon glyphicon-save-file"></span> Exportar</a></li>
                                    <li><a href="<?= base_url() . 'index.php/XML/importar' ?>"><span class="glyphicon glyphicon-open-file"></span> Importar</a></li>
                                </ul>
                            </li>                       

                            <li><a href="<?= base_url() . 'index.php/Excel' ?>">
                                    <span style="color: white;" class="glyphicon glyphicon-open-file"></span> Importar en Excel</a></li>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- PIE -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="copyright">
                            <p>&copy; 2016 Isabel María Calvo Mateos - Todos los derechos reservados</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery.min.js"></script>    
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
        <script src="<?= base_url() ?>assets/template/js/owl.carousel.min.js"></script>
        <script src="<?= base_url() ?>assets/template/js/jquery.sticky.js"></script>
        <script src="<?= base_url() ?>assets/template/js/jquery.easing.1.3.min.js"></script>
        <script src="<?= base_url() ?>assets/template/js/main.js"></script>
        <script src="<?= base_url() ?>assets/js/script.js"></script>
        <script src="<?= base_url() ?>assets/js/menudesplegable.js"></script>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </body>
</html>
