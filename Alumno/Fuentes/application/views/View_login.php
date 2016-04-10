<?php
/*
 * VISTA que pide usuario y contraseña para iniciar sesión en la aplicación con la opción de registrarse en la página o restablecer la contraseña.
 */
?>
<!-- CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Login</strong>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="POST">
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </span> 
                                                <input class="input-text btn-block" placeholder="Nombre de usuario" name="username" type="text" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-lock"></i>
                                                </span>
                                                <input class="input-text btn-block" placeholder="Contraseña" name="clave" type="password" value="">
                                            </div>
                                        </div>
                                        <?php if (isset($error))
                                            echo $error;
                                        ?>
                                        <div class="form-group">
                                            <button type="submit" value="entrar" name="entrar" class="add_to_cart_button btn-block"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Entrar</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="panel-footer ">
                        ¡No estoy registrado! <a href="<?= base_url() . 'index.php/Registro' ?>">Registrate aquí</a>
                    </div>
                    <div class="panel-footer ">
                        ¡He olvidado mi contraseña! <a href="<?= base_url() . 'index.php/RestablecerContrasenha' ?>">Restablecer contraseña</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>