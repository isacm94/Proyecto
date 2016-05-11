<?php
//echo '<pre>';
//print_r($expression);
//echo '</pre>';
?>
<div class="row">
    <?php
    $cont = 0;
    foreach ($productos as $value):
        ?>
        <div class="col-md-3 col-sm-6">
            <div class="thumbnail">
                <div class="div-imagen-exterior">
                    <div class="div-imagen-interior">
                        <img src="<?= base_url() . 'images/' . $value['imagen'] ?>" alt="<?= $value['nombre'] ?>" class="img-responsive imagen-centrada">
                    </div>
                </div>
                <div class="caption bottom-align-text">
                    <h3><?= $value['nombre'] ?> - <?= $value['categoria'] ?></h3>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default">Button</a></p>
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
