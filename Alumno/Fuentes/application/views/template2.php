<!DOCTYPE html>
<html lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shop's Admin</title>

        <link href="<?= base_url() . 'assets/templates/template2/' ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/template2/' ?>fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/template2/' ?>css/animate.min.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/template2/' ?>css/custom.css" rel="stylesheet">
        <link href="<?= base_url() . 'assets/templates/template2/' ?>css/icheck/flat/green.css" rel="stylesheet">
        <script src="<?= base_url() . 'assets/templates/template2/' ?>js/jquery.min.js"></script>
        <link rel="stylesheet" href="<?= base_url() . 'assets/css/estilos.css' ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() . 'assets/favicon.png' ?>">
    </head>

    <body class="nav-md">

        <div class="container body">

            <div class="main_container">

                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">

                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?= site_url() ?>" class="site_title"><i class="fa fa-home"></i> <span>Shop's Admin</span></a>
                        </div>
                        <div class="clearfix"></div>

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                            <div class="menu_section">
                                <h3>General</h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-home"></i> Link <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="#">Dashboard</a>
                                            </li>
                                            <li><a href="index2.html">Dashboard2</a>
                                            </li>
                                            <li><a href="index3.html">Dashboard3</a>
                                            </li>
                                        </ul>
                                    </li>
                            </div>

                        </div>
                        <!-- /sidebar menu -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">

                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <!-- CAMBIO PLANTILLA -->
                            <ul class="nav navbar-nav navbar-right">

                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                                        <span class="fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <li><!-- start notification -->
                                            <a href="<?= site_url() . '/CambioPlantilla/index/template1' ?>">
                                                <i class="glyphicon glyphicon-tint"></i> Template 1 - AdminLTE 2
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= site_url() . '/CambioPlantilla/index/template2' ?>">
                                                <i class="glyphicon glyphicon-tint"></i> Template 2 - Gentellela Alela
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?= base_url() . 'assets/admin.png' ?>" alt="">John Doe
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <li><a href="javascript:;">  Profile</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="badge bg-red pull-right">50%</span>
                                                <span>Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">Help</a>
                                        </li>
                                        <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                        </li>
                                    </ul>
                                </li>

                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-bell-o"></i>
                                        <span class="badge bg-green">6</span>
                                    </a>
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="<?= base_url() . 'assets/templates/template2/' ?>images/img.jpg" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3><?php
                                    if (isset($titulo))
                                        echo $titulo;
                                    ?>
                                    <small> <?php
                                        if (isset($descripcion))
                                            echo $descripcion;
                                        ?></small></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="row">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="" style="height: 500px">
                                    <?php
                                    if (isset($cuerpo))
                                        echo $cuerpo;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- footer content -->
                    <footer>
                        <div class="copyright-info">
                            <strong>Copyright &copy; 2016 Todos los derechos reservados.</strong>
                            <div class="pull-right hidden-xs">
                                Isabel María Calvo Mateos
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </footer>

                    <!-- /footer content -->

                </div>
                <!-- /page content -->
            </div>

        </div>



        <script src="<?= base_url() . 'assets/templates/template2/' ?>js/bootstrap.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/template2/' ?>js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/template2/' ?>js/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/template2/' ?>js/icheck/icheck.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/template2/' ?>js/custom.js"></script>
        <script src="<?= base_url() . 'assets/templates/template2/' ?>js/pace/pace.min.js"></script>

    </body>

</html>
