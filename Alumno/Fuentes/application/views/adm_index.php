<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript" src="<?= base_url() . '/assets/js/' ?>highcharts.js"></script>

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><img src="<?= base_url() . 'assets/images/este_mes.png' ?>" style="padding: 10px;"></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= $este_mes['mes'] ?></span>
                <span class="info-box-number"><?= $este_mes['ventas'] . ' ventas' ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><img src="<?= base_url() . 'assets/images/anterior_mes.png' ?>" style="padding: 10px;"></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= $anterior_mes['mes'] ?></span>
                <span class="info-box-number"><?= $anterior_mes['ventas'] . ' ventas' ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><img src="<?= base_url() . 'assets/images/anterior_semana.png' ?>" style="padding: 10px;"></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= $anterior_semana['lunes'] . ' - ' . $anterior_semana['domingo'] ?></span>
                <span class="info-box-number"><?= $anterior_semana['ventas'] . ' ventas' ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><img src="<?= base_url() . 'assets/images/esta_semana.png' ?>" style="padding: 10px;"></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= $esta_semana['lunes'] . ' - ' . $esta_semana['domingo'] ?></span>
                <span class="info-box-number"><?= $esta_semana['ventas'] . ' ventas' ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <script>
            Highcharts.setOptions({
                colors: ['#1E90FF', '#000030']
            });
        </script>
        <?= $grafico1 ?>

    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?= $grafico2 ?>
    </div>
    <?php //echo '<pre>'; print_r($productos_masVendidos); echo '</pre>';?>


    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel" style="margin-top: 10px; border: 1px solid #D8D8D8; -webkit-box-shadow: 2px 2px 5px #999;
             -moz-box-shadow: 2px 2px 5px #999">
            <div class="panel-heading">
                <h3 class="panel-title">Los <?= count($productos_masVendidos) ?> productos más vendidos</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <th class="success">Producto</th>
                    <th class="success">Categoría</th>
                    <th class="success">Nº artículos vendidos</th>
                        <?php foreach ($productos_masVendidos as $key => $value): ?>
                        <tr>
                            <td><a href="<?=site_url('/Administrador/Lista/Productos/Ver/'.$value['idProducto'])?>"><?= $value['producto'] ?></a></td>
                            <td><?= $value['categoria'] ?></td>
                            <td><?= $value['num_articulos_vendidos'] ?></td>

                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel" style="margin-top: 10px; border: 1px solid #D8D8D8; -webkit-box-shadow: 2px 2px 5px #999;
             -moz-box-shadow: 2px 2px 5px #999">
            <div class="panel-heading">
                <h3 class="panel-title">Los <?= count($productos_menosVendidos) ?> productos menos vendidos</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <th class="danger">Producto</th>
                    <th class="danger">Categoría</th>
                    <th class="danger">Nº artículos vendidos</th>
                        <?php foreach ($productos_menosVendidos as $key => $value): ?>
                        <tr>
                            <td><a href="<?=site_url('/Administrador/Lista/Productos/Ver/'.$value['idProducto'])?>"><?= $value['producto'] ?></a></td>
                            <td><?= $value['categoria'] ?></td>
                            <td><?= $value['num_articulos_vendidos'] ?></td>

                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    
    
</div>