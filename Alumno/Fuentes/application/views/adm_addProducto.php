<div class="x_panel">

    <form role="form" action="<?= base_url() . 'Administrador/Agregar/Categoria' ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-md-6 col-sm-12">
                <label>Nombre</label>
                <input type="text" value="<?= set_value('nombre') ?>" class="form-control" name="nombre" placeholder="Nombre del producto">
                <?= form_error('nombre'); ?>
            </div>        
            <div class="col-md-6 col-sm-12">
                <label>Marca</label>
                <input type="text" value="<?= set_value('marca') ?>" class="form-control" name="marca" placeholder="Marca del producto">
                <?= form_error('marca'); ?>
            </div> 
        </div>

        <div class="form-group row">
            <div class="col-md-4 col-sm-12">
                <label>Precio</label>
                <input type="text" value="<?= set_value('precio') ?>" class="form-control" name="precio" placeholder="Precio">
                <?= form_error('precio'); ?>
            </div>        
            <div class="col-md-4 col-sm-12">
                <label>Marca</label>
                <input type="text" value="<?= set_value('precio_venta') ?>" class="form-control" name="precio_venta" placeholder="Precio de venta del producto">
                <?= form_error('precio_venta'); ?>
            </div> 

            <div class="col-md-4 col-sm-12">
                <label>Stock</label>
                <input type="text" value="<?= set_value('stock') ?>" class="form-control" name="stock" placeholder="stock">
                <?= form_error('stock'); ?>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-md-4 col-sm-12">
                <label>Categoria</label>
                <input type="text" value="<?= set_value('precio') ?>" class="form-control" name="precio" placeholder="Precio">
                <?= form_error('categoria'); ?>
            </div>        
            <div class="col-md-4 col-sm-12">
                <label>Proveedor</label>
                <input type="text" value="<?= set_value('precio_venta') ?>" class="form-control" name="precio_venta" placeholder="Precio de venta del producto">
                <?= form_error('precio_venta'); ?>
            </div> 

            <div class="col-md-4 col-sm-12">
                <label>Imagen</label>
                <input type="file" value="<?= set_value('imagen') ?>" class="form-control" name="imagen" placeholder="imagen">
                <?= form_error('imagen'); ?>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <label>Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3"><?= set_value('descripcion') ?></textarea>
            </div>
        </div>

        <div class="col-md-1 col-md-offset-10">
            <button type="submit" class="btn btn-default btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> GUARDAR</button>
        </div>
    </form>

</div>

