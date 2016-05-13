<?php
//echo '<pre>';
//print_r($producto);
//echo '</pre>';
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
                    <h3><?=$producto['stock']?> disponibles - <b><?=getPrecio($producto['precio'])?></b></h3>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Características</h3>
                        </div>
                        <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Referencia</dt>
                                <dd><?=$producto['referencia']?></dd>
                                <dt>Marca</dt>
                                <dd><?=$producto['marca']?></dd>
                                <dt>IVA aplicado</dt>
                                <dd><?=getIva($producto['iva'])?></dd>                                
                                <dt>Descripción</dt>
                                <dd><?=$producto['descripcion']?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
