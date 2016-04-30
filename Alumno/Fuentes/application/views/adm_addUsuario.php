<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra el formulario de agregar usuario
 */
?>
<div class="x_panel">

    <form role="form" action="<?= site_url() . '/Administrador/Agregar/Usuario' ?>" method="POST">
        <div class="form-group row">
            <div class="col-md-6 col-sm-12">
                <label>Nombre</label>
                <input type="text" value="<?= set_value('nombre') ?>" class="form-control" name="nombre" placeholder="Nombre">
                <?= form_error('nombre'); ?>
            </div>

            <div class="col-md-6 col-sm-6">
                <label>Nombre de usuario</label>
                <input type="text" value="<?= set_value('username') ?>" class="form-control" name="username" placeholder="Nombre de usuario">
                <?= form_error('username'); ?>
            </div>          
        </div>
        <div class="form-group row">
            <div class="col-md-6 col-sm-6">
                <label>Correo</label>
                <input type="text" value="<?= set_value('correo') ?>" class="form-control" name="correo" placeholder="Correo electrónico">
                <?= form_error('correo'); ?>
            </div>

            <div class="col-md-6 col-sm-6">
                <label>Tipo</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="tipo"  value="empleado" <?=set_radio('tipo', 'empleado', TRUE); ?>>
                        Empleado
                    </label>
                    <label>&nbsp;
                        <input type="radio" name="tipo"  value="administrador" <?=set_radio('tipo', 'administrador'); ?>>
                        Administrador
                    </label>
                </div>           

                <?= form_error('tipo'); ?>
            </div> 
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-warning">
                    <strong>NOTA:</strong> Se le enviará un correo al usuario con su contraseña
                </div>
            </div>
            <div class="col-md-2 col-md-offset-4" style="margin-top:20px;">
                <button type="submit" class="btn btn-default btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> GUARDAR</button>
            </div>
        </div>
    </form>

</div>

