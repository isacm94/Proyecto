<?php
/*
 * VISTA que pide el usuario para enviarle un correo para restablecer la contraseña
 */
?>
<html>
    <head>
        <title>Shop's Admin - Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= CSS_PATH . 'login.css' ?>">
        <link rel="stylesheet" href="<?= CSS_PATH . 'estilos.css' ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?= IMAGES_PATH . 'favicon.png' ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="login-container">
                <div id="output"></div>                
                <h4><b>Restablecer Contraseña</b></h4>
                </br>  
                <div class="form-box">
                    <form action="<?= site_url() . '/RestablecerClave' ?>" method="POST">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" value="<?= set_value('username') ?>" class="form-control" name="username" placeholder="Nombre de usuario" >                                        
                        </div>
                        <?= form_error('username') ?>
                        <button class="btn btn-info btn-block login" type="submit" name="entrar"><span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;Enviar Correo</button>
                    </form>
                </div>
            </div>

        </div>
    </body>
</html>
