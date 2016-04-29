<div class="x_panel">

    <form role="form" action="<?= site_url() . '/Administrador/Agregar/Proveedor' ?>" method="POST">
        <div class="form-group row">
            <div class="col-md-4 col-sm-12">
                <label>Nombre</label>
                <input type="text" value="<?= set_value('nombre') ?>" class="form-control" name="nombre" placeholder="Nombre de la empresa">
                <?= form_error('nombre'); ?>
            </div>

            <div class="col-md-4 col-sm-6">
                <label>NIF</label>
                <input type="text" value="<?= set_value('nif') ?>" class="form-control" name="nif" placeholder="NIF">
                <?= form_error('nif'); ?>

            </div>
            <div class="col-md-4 col-sm-6">
                <label>Correo</label>
                <input type="text" value="<?= set_value('correo') ?>" class="form-control" name="correo" placeholder="Correo electrónico">
                <?= form_error('correo'); ?>
            </div>            
        </div>
        <div class="form-group row">
            <div class="col-md-3 col-sm-6">
                <label>Dirección</label>
                <input type="text" value="<?= set_value('direccion') ?>" class="form-control" name="direccion" placeholder="Dirección">
                <?= form_error('direccion'); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <label>Localidad</label>
                <input type="text" value="<?= set_value('localidad') ?>" class="form-control" name="localidad" placeholder="Localidad">
                <?= form_error('localidad'); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <label>CP</label>
                <input type="text" value="<?= set_value('cp') ?>" class="form-control" name="cp" placeholder="Código Postal" maxlength="5">
                <?= form_error('cp'); ?>
            </div>  
            <div class="col-md-3 col-sm-6">
                <label>Provincia</label>
                <?= $selectProvincias ?>
                <?= form_error('provincia'); ?>
            </div>  
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <label>Anotaciones</label>
                <textarea class="form-control" name="anotaciones" rows="3"><?= set_value('anotaciones')?></textarea>
            </div>
        </div>

        <div class="col-md-1 col-md-offset-10">
            <button type="submit" class="btn btn-default btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> GUARDAR</button>
        </div>
    </form>

</div>

