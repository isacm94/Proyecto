<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra en detalle el producto
 */

//echo '<pre>';
//print_r($producto);
//echo '</pre>';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="col-md-1 col-sm-4 col-xs-4">

                </div>
                <div class="derecha">
                    <a href="<?= site_url('/Administrador/Lista/Productos') ?>" class="btn btn-default btn-lista " title="Lista de productos"><i class="fa fa-list fa-lg" aria-hidden="true"></i></a>
                    <a href="<?= site_url('/Administrador/Lista/Productos/Modificar/' . $producto['idProveedor']) ?>" class="btn btn-default btn-editar " title="Modificar producto"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-3 col-sm-6"><b>Referencia: </b><?= $producto['referencia'] ?></div>     
                            <div class="col-md-3 col-sm-6"><b>Nombre: </b><?= $producto['nombre'] ?></div>                    
                        </div> 

                        <hr>
                        <div class="row">
                            <div class="col-md-3 col-sm-6"><b>Categoría: </b><?= $producto['categoria'] ?></div>    
                            <div class="col-md-3 col-sm-6"><b>Marca: </b><?= $producto['marca'] ?></div>  
                        </div>       
                        <hr>
                        <div class="row">
                            <div class="col-md-3 col-sm-6"><b>Proveedor: </b><?= $producto['proveedor'] ?></div>    
                            <div class="col-md-3 col-sm-6"><b>Stock: </b><?= $producto['stock'] ?></div>
                        </div>       
                        <hr>  

                        <div class="row">
                            <div class="col-md-3 col-sm-6"><b>Precio: </b><?= $producto['precio'] ?> €</div>    
                            <div class="col-md-3 col-sm-6"><b>Precio de venta: </b><?= $producto['precio_venta'] ?> €</div>  
                            <div class="col-md-2 col-sm-6"><b>IVA: </b><?= $producto['iva'] ?> %</div>  
                        </div>  
                        <hr>
                        <div class="row">
                            <div class="col-md-6 col-sm-6"><b>Descripción: </b><?= $producto['descripcion'] ?></div>
                        </div>  
                    </div>  
                    <div class="col-md-6 col-sm-6">
                        <img src="<?=base_url().'images/'.$producto['imagen']?>" class="img-responsive imagen-centrada">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

