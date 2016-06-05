<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra el formulario para modificar el usuario
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
                    <a href="<?= site_url('/Administrador/Perfil/Modificar')?>" title="Modificar mi perfil" class="boton btn btn-warning"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>

                    <a href="<?= site_url('/Administrador/Perfil/CambiarClave')?>" title="Cambiar contraseña" class="boton btn boton btn-danger"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <form role="form" action="<?= site_url('/Administrador/Perfil/Modificar')?>" method="POST">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Nombre de Usuario</label>
                            <input type="text" value="<?=$datos['username']?>" class="form-control" name="username" placeholder="Nombre de usuario">
                            <?= form_error('username'); ?>
                        </div>
                        <div class="col-md-4">
                            <label>Nombre</label>
                            <input type="text" value="<?=$datos['nombre']?>" class="form-control" name="nombre" placeholder="Nombre">
                            <?= form_error('nombre'); ?>
                        </div>
                        <div class="col-md-4">
                            <label>Correo</label>
                            <input type="text" value="<?=$datos['correo']?>" class="form-control" name="correo" placeholder="Correo electrónico">
                            <?= form_error('correo'); ?>
                        </div>
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


