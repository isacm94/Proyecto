<?php
/*
 * VISTA que muestra el error 404
 */
?>
<html>
    <head>
        <title>Shop's Admin - Error 404</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= base_url() . 'assets/css/error404.css' ?>">
        <link rel="stylesheet" href="<?= base_url() . 'assets/css/estilos.css' ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() . 'assets/favicon.png' ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link href='https://fonts.googleapis.com/css?family=Sigmar+One' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <h1 class="otrafuente" style="padding-top: 40px;">Opps! Página no encontrada</h1>
        <img src="<?= base_url() . 'assets/images/error404.png' ?>" class="img-responsive imagen-centrada">
        <h3 class="otrafuente">Vuelva al <a href="<?=  site_url()?>">módulo de venta</a> o al <a href="<?=  site_url('/Administrador')?>">módulo de administración</a></h3>
    </body>
</html>

