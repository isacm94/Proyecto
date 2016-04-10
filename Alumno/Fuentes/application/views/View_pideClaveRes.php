<?php
/*
 * VISTA que pide la contraseña para restablecerla.
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
                        <strong> Restablecer Contraseña</strong>
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
                                                <input class="input-text btn-block" placeholder="Nombre de usuario" name="username" type="text" readonly="readonly" value="<?=$username?>">
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
                                        <?= form_error('clave'); ?>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-lock"></i>
                                                </span>
                                                <input class="input-text btn-block" placeholder="Repite Contraseña" name="clave_rep" type="password" value="">
                                            </div>
                                        </div>
                                        <?= form_error('clave_rep'); ?>
                                        <div class="form-group">
                                            <button type="submit" name="enviar" class="add_to_cart_button btn-block"><span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;Enviar mail</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>