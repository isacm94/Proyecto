<?php
/*
 * VISTA DEL MÓDULO DE VENTA que muestra en detalle un producto
 */
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <img src="<?= base_url() . 'images/' . $producto['imagen'] ?>" class="test-plugin img-responsive imagen-centrada" data-zoom-image="<?= base_url() . 'images/' . $producto['imagen'] ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2><?= $producto['nombre'] . ' | ' . $producto['categoria'] ?></h2>
                    <h3><?= $producto['stock'] ?> disponibles</h3>
                    <p>
                        <a href="<?= site_url('Carrito/add/' . $producto['idProducto']) ?>" class="btn btn-primary" role="button"><i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Añadir al carrito - <b><?= round($producto['precio_venta'], 2) . '€' ?></b></a> 
                    </p>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Características</h3>
                        </div>
                        <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Referencia</dt>
                                <dd><?= $producto['referencia'] ?></dd>
                                <dt>Marca</dt>
                                <dd><?= $producto['marca'] ?></dd>
                                <dt>IVA aplicado</dt>
                                <dd><?= round($producto['iva'], 2) . ' %' ?></dd>                                
                                <dt>Descripción</dt>
                                <dd><?= $producto['descripcion'] ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
