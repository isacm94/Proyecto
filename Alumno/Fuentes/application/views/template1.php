<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Shop's Admin</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="stylesheet" href="<?= base_url() . 'assets/templates/template1/' ?>bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?= base_url() . 'assets/templates/template1/' ?>dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?= base_url() . 'assets/templates/template1/' ?>dist/css/skins/skin-red.min.css">
        <link rel="stylesheet" href="<?= base_url() . 'assets/css/estilos.css' ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() . 'assets/favicon.png' ?>">

    </head>
    <body class="hold-transition skin-red sidebar-mini">
        <div class="wrapper">

            <!-- BARRA DE NAVEGACIÓN-->
            <header class="main-header">

                <a href="" class="logo">
                    <span class="logo-mini"><b>S's</b>A</span>
                    <span class="logo-lg"><b>Shop's</b> Admin</span>
                </a>
                
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Notifications Menu -->
                            <li class="dropdown notifications-menu">
                                <!-- Menu toggle button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">10</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 10 notifications</li>
                                    <li>
                                        <!-- Inner Menu: contains the notifications -->
                                        <ul class="menu">
                                            <li><!-- start notification -->
                                                <a href="#">
                                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                </a>
                                            </li><!-- end notification -->
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">View all</a></li>
                                </ul>
                            </li>
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="<?= base_url() . 'assets/admin.png' ?>" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">Alexander Pierce</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?= base_url() . 'assets/admin.png' ?>" class="img-circle" alt="User Image">
                                        <p>
                                            Alexander Pierce - Web Developer
                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-default btn-flat">Cerrar sesión</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <!-- CAMBIO DE PLANTILLA -->
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-paint-brush" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Elija un template</li>
                                    <li>
                                        <ul class="menu">
                                            <li>
                                                <a href="<?= site_url() . '/CambioPlantilla/index/template1' ?>">
                                                    <i class="glyphicon glyphicon-tint"></i> Template 1 - AdminLTE 2
                                                </a>
                                                <a href="<?= site_url() . '/CambioPlantilla/index/template2' ?>">
                                                    <i class="glyphicon glyphicon-tint"></i> Template 2 - Gentellela Alela
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li><!-- fin Cambio Plantilla -->
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- MENÚ LATERAL-->
            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li class="header">Menú</li>
                        <!-- Optionally, you can add icons to the links -->
                        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
                        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="#">Link in level 2</a></li>
                                <li><a href="#">Link in level 2</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="#">Link in level 2</a></li>
                                <li><a href="#">Link in level 2</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
            </aside>

            <!-- CUERPO-->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php
                        if (isset($titulo))
                            echo $titulo;
                        ?>
                        <small> <?php
                            if (isset($descripcion))
                                echo $descripcion;
                            ?></small>



                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">                    
                    <?php
                    if (isset($cuerpo))
                        echo $cuerpo;
                    ?>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Main Footer - PIE-->
            <footer class="main-footer">
                <strong>Copyright &copy; 2016 Todos los derechos reservados.</strong>
                <div class="pull-right hidden-xs">
                    Isabel María Calvo Mateos
                </div>
            </footer>


        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->
        <script src="<?= base_url() . 'assets/templates/template1/' ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/template1/' ?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/template1/' ?>dist/js/app.min.js"></script>
    </body>
</html>
