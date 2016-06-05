<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra el formulario para la contraseña del usuario
 */
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="col-md-1 col-sm-4 col-xs-4">
                    <a href="<?= site_url('/Administrador/Perfil')?>" title="Perfil"><img src="<?= base_url() . 'assets/images/admin64.png' ?>" class="img-responsive"></a>
                </div>
                <div class="derecha">
                    <a href="<?= site_url('/Administrador/Perfil/Modificar') ?>" title="Modificar mi perfil" class="boton btn btn-warning"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>

                    <a href="<?= site_url('/Administrador/Perfil/CambiarClave') ?>" title="Cambiar contraseña" class="boton btn boton btn-danger"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php if (isset($mensajeok)): ?>
                    <div class="col-md-12"><?= $mensajeok ?></div>
                <?php endif; ?>

                <form role="form" action="<?= site_url('/Administrador/Perfil/CambiarClave')?>" method="POST">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Contraseña nueva</label>
                            <input type="password" class="form-control" name="clave1" placeholder="Contraseña nueva">
                            <?= form_error('clave1'); ?>
                        </div>
                        <div class="col-md-6">
                            <label>Repita la contraseña nueva</label>
                            <input type="password" class="form-control" name="clave2" placeholder="Contraseña nueva repetida">
                            <?= form_error('clave2'); ?>
                        </div>

                        <?php if (isset($mensajeerror)): ?>
                            <div class="col-md-12"><?= $mensajeerror ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Confirme la contraseña para guardar cambios </label>
                            <input type="password" class="form-control" name="clave" placeholder="Contraseña">
                            <?= form_error('clave'); ?>
                        </div>
                    </div>

                    <div class="col-md-1 col-md-offset-9">
                        <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> GUARDAR CAMBIOS</button>
                    </div>
                </form>

            </div>


        </div>
    </div>
</div>


