
<div class="row">
    <?php
    $cont = 0;
    foreach ($productos as $value):
        ?>
        <div class="col-md-3 col-sm-6">
            <div class="thumbnail">
                <div class="div-imagen-exterior">
                    <div class="div-imagen-interior">
                        <a href="<?=  site_url('/Producto/ver/'.$value['id'])?>">
                            <img style="vertical-align: middle;"src="<?= base_url() . 'images/' . $value['imagen'] ?>" alt="<?= $value['nombre'] ?>" class="img-responsive imagen-centrada col-xs-12">
                        </a>
                        </div>
                </div>
                <div class="caption bottom-align-text">
                    <a href="<?=  site_url('/Producto/ver/'.$value['id'])?>">
                        <h3 style="padding-right: 10px;"><?= $value['nombre'] ?> <br><small><b><?= round($value['precio'], 2). '€' ?></b> - <?= $value['categoria'] ?></small></h3>
                    </a>
                    <p style="padding-bottom: 10px;">
                        <a href="<?=  site_url('Carrito/add/'.$value['id'])?>" class="btn btn-primary" role="button"><i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Añadir al carrito</a> 
                    </p>
                </div>
            </div>
        </div>

        <?php $cont++; ?>
        <?php if ($cont % 4 == 0): ?>
            <div class="clearfix"></div>
        <?php endif; ?>

    <?php endforeach; ?>
    <div class="col-md-12 text-center">
        <ul id="paginacion-home">
            <?php echo $this->pagination->create_links() ?>
        </ul>
    </div>
</div>
