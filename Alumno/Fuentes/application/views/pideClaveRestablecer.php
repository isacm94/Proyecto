<?php
/*
 * VISTA que pide la contraseña para restablecerla
 */
?>
<html>
    <head>
        <title>Shop's Admin | Restablecer contraseña</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= CSS_PATH . 'login.css' ?>">
        <link rel="stylesheet" href="<?= CSS_PATH . 'estilos.css' ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?= IMAGES_PATH . 'favicon.png' ?>">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    </head>
    <body>
        <div class="container" style="padding-top: 50px">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b>Restablecer Contraseña</b></h3>
                        </div>
                        <div class="panel-body">
                            <img src="<?= IMAGES_PATH . '' . $imagen . '.png' ?>" class="user-image img-responsive img-rounded imagen-centrada">
                            <form role="form" action="" method="POST">
                                <h4 class="text-center"><i><?= $username ?></i></h4>    
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" name="clave" placeholder="Contraseña">                                        
                                </div>
                                <?= form_error('clave'); ?>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" name="clave_rep" placeholder="Repite la contraseña">                                        
                                </div>
                                <?= form_error('clave_rep'); ?>
                                <div class="form-group">
                                    <button type="submit" name="enviar" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script src="<?= JS_PATH . 'jquery-2.2.3.min.js' ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
