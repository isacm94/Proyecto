<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra un mensaje cuando se ha cambiando la contraseña correctamente a tráves del correo
 */
?>
<html>
    <head>
        <title>Shop's Admin | Mail Enviado Incorrectamente</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=CSS_PATH.'estilos.css' ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?= IMAGES_PATH.'favicon.png' ?>">
        <link href='https://fonts.googleapis.com/css?family=Sigmar+One' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <img style="margin-top: 100px;" src="<?= IMAGES_PATH."clave.png" ?>" class="img-responsive imagen-centrada">
            </div><br><br>
            <h1 class="otrafuente">Se ha cambiado correctamente su contraseña
                <br><a href="<?= $link ?>">Pulse aquí para iniciar sesión</a></h1>
        </div>
    </body>
</html>