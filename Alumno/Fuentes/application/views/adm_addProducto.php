<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra el formulario de agregar producto
 */
?>
<style>  
    /*Se aumenta el cuerpo de la plantilla2 ya que no cabe*/  
    .cuerpotemplate2{
        height: 900px;
    }
</style>
<div class="x_panel">

    <form role="form" action="<?= site_url() . '/Administrador/Agregar/Producto' ?>" method="POST" enctype="multipart/form-data">
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
            <div class="col-md-4 col-sm-6">
                <label>Precio</label>
                <input type="text" value="<?= set_value('precio') ?>" class="form-control" name="precio" placeholder="Precio de compra del producto">
                <?= form_error('precio'); ?>
            </div>        
            <div class="col-md-4 col-sm-6">
                <label>Precio de venta</label>
                <input type="text" value="<?= set_value('precio_venta') ?>" class="form-control" name="precio_venta" placeholder="Precio de venta del producto">
                <?= form_error('precio_venta'); ?>
            </div> 
            <div class="col-md-4 col-sm-6">
                <label>IVA aplicado(%)</label>
                <input type="text" value="<?= set_value('iva') ?>" class="form-control" name="iva" placeholder="IVA aplicado al precio de venta en %">
                <?= form_error('iva'); ?>
            </div> 
        </div>

        <div class="form-group row">            
            <div class="col-md-4 col-sm-6">
                <label>Stock</label>
                <input type="text" value="<?= set_value('stock') ?>" class="form-control" name="stock" placeholder="Stock">
                <?= form_error('stock'); ?>
            </div>
            <div class="col-md-4 col-sm-12">
                <label>Categoría</label>
                <?= $select_categorias ?>
                <?= form_error('idCategoria'); ?>
            </div>        
            <div class="col-md-4 col-sm-12">
                <label>Proveedor</label>
                <?= $select_proveedores ?>
                <?= form_error('idProveedor'); ?>
            </div> 
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <label>Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3"><?= set_value('descripcion') ?></textarea>
            </div>
        </div>

        <div class="col-md-1 col-md-offset-10">
            <button type="submit" class="btn btn-default btn-primary">SIGUIENTE <i class="fa fa-arrow-right" aria-hidden="true"></i> </button>
        </div>
    </form>

</div>

