<?php
/*
 * PLANTILLA 1 DEL MÓDULO DE ADMINISTRACIÓN
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Shop's Admin <?= $title ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="stylesheet" href="<?= base_url() . 'assets/templates/template1/' ?>bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?= base_url() . 'assets/templates/template1/' ?>dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?= base_url() . 'assets/templates/template1/' ?>dist/css/skins/skin-red.min.css">
        <?= $linksHead ?>

    </head>
    <body class="hold-transition skin-red sidebar-mini">
        <div class="wrapper">

            <!-- BARRA DE NAVEGACIÓN-->
            <header class="main-header">

                <a href="<?= site_url() . '/Administrador' ?>" class="logo">
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
                                 <?=$linkAvisos?>
                            </li>
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="<?= base_url() . 'assets/images/admin.png' ?>" class="user-image img-responsive">
                                    <span class="hidden-xs"><?= $linksUsuario['nombre'] ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?= base_url() . 'assets/images/admin.png' ?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?= $linksUsuario['nombre'] ?> - <?= $linksUsuario['username'] ?>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?= $linksUsuario['Perfil'] ?>" class="btn btn-default btn-flat"><i class="fa fa-user" aria-hidden="true"></i> Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= $linksUsuario['CerrarSesion'] ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesión</a>
                                        </div>
                                    </li>
                                </ul>

                            </li>
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

                        <li class="treeview">
                            <a href="#"><i class="fa fa-plus"></i> <span>Agregar</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">

                                <?php foreach ($linksMenuAgregar as $link): ?>
                                    <li><?= $link ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#"><i class="fa fa-list"></i> <span>Listas</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">

                                <?php foreach ($linksMenuLista as $link): ?>
                                    <li><?= $link ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li><?= $linksConfigPlantillas ?></li>
                    </ul>
                </section>
            </aside>

            <!-- CUERPO-->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        <?php
                        if (isset($titulo))
                            echo $titulo;
                        ?>
                        <small> <?php
                            if (isset($descripcion))
                                echo $descripcion;
                            ?></small>                    </h1>
                </section>

                <section class="content">                    
                    <?php
                    if (isset($cuerpo))
                        echo $cuerpo;
                    ?>
                </section>
            </div>

            <!-- Main Footer - PIE-->
            <footer class="main-footer">
                <strong>Copyright &copy; 2016 Todos los derechos reservados.</strong>
                <div class="pull-right hidden-xs">
                    Isabel María Calvo Mateos
                </div>
            </footer>


        </div>

        <!-- REQUIRED JS SCRIPTS -->        
        <script src="<?= base_url() . 'assets/templates/template1/' ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/template1/' ?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= base_url() . 'assets/templates/template1/' ?>dist/js/app.min.js"></script>
        <?=$linksJS?>

    </body>
</html>
