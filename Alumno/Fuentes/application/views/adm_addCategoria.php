<div class="x_panel">

    <form role="form" action="<?= site_url() . '/Administrador/Agregar/Categoria' ?>" method="POST">
        <div class="form-group row">
            <div class="col-md-12">
                <label>Nombre</label>
                <input type="text" value="<?= set_value('nombre') ?>" class="form-control" name="nombre" placeholder="Nombre de la categoría">
                <?= form_error('nombre'); ?>
            </div>          
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <label>Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3"><?= set_value('descripcion')?></textarea>
            </div>
        </div>

        <div class="col-md-1 col-md-offset-10">
            <button type="submit" class="btn btn-default btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> GUARDAR</button>
        </div>
    </form>

</div>

