<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra el login
 */
?>
<html>
    <head>
        <title>Shop's Admin | Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=CSS_PATH.'login.css' ?>">
        <link rel="stylesheet" href="<?=CSS_PATH.'estilos.css' ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?= IMAGES_PATH.'favicon.png' ?>">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        
    </head>
    <body>
        <div class="container">
            <div class="login-container">
                <div id="output"></div>                
                <img src="<?= IMAGES_PATH.'admin.png' ?>" class="user-image img-responsive img-rounded imagen-centrada">
                </br>  
                <div class="form-box">
                    <form action="<?=  site_url().'/Administrador/Login/Login'?>" method="POST">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" value="<?= set_value('username') ?>" class="form-control" name="username" placeholder="nombre de usuario" >                                        
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" name="clave" placeholder="contraseña">                                        
                        </div>
                        <?php
                        if(isset($error))
                            echo $error;                        
                        ?>
                        <button class="btn btn-info btn-block login" type="submit" name="entrar"><span class="glyphicon glyphicon-log-in"></span> Entrar</button>
                    </form>
                    <a href="<?=site_url('/Administrador/RestablecerClave')?>">Reestablecer contraseña</a>
                </div>
            </div>

        </div>
        <script src="<?=JS_PATH.'jquery-2.2.3.min.js'?>"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </body>
</html>
