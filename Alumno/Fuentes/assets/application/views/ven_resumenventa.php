<style>
    .cuerpo{
        min-height: 400px;
    }
</style>
<div class="row">
    <div class="col-md-8 panel">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->myCarrito->get_content() as $items): ?>
                        <tr>
                            <td class="col-sm-8 col-md-8">
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="<?= site_url('Producto/ver/' . $items['id']) ?>"><?= $items['nombre'] ?></a></h4>
                                        <h5 class="media-heading"><a href="<?= site_url('Categoria/index/' . $items['idCategoria']) ?>"><i><?= $items['categoria'] ?></i></a></h5>
                                    </div>
                                </div>
                                <span class="text-right"><?= $items['errorstock']; ?></span>
                            </td>
                            <td class="col-sm-1 col-md-1" style="text-align: center">
                               <?= $items['cantidad'] ?>
                            </td>
                            <td class="col-sm-1 col-md-1 text-center"><?= round($items['precio'], 2) ?>&nbsp;€</td>
                            <td class="col-sm-1 col-md-1 text-center"><?= round($items['precio'] * $items['cantidad'], 2) ?>&nbsp;€</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td colspan="2"><h4>Cantidad total</h4></td>
                        <td colspan="2"class="text-right"><h5><b><?= $this->myCarrito->articulos_total() ?>&nbsp;artículos</b></h5></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2"><h4>Importe Total</h4></td>
                        <td class="text-right"><h5><b><?= round($this->myCarrito->precio_total(), 2) ?>&nbsp;€</b></h5></td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Datos del Cliente</h3>
            </div>
            <div class="panel-body">
                <dl class="dl-horizontal">

                    <dt>Nombre</dt>
                    <dd><?= $cliente['nombre'] ?></dd>
                    <dt>NIF</dt>
                    <dd><?= $cliente['nif'] ?></dd>
                    <dt>Tipo</dt>
                    <dd><?= $cliente['tipo'] ?></dd>
                    <?php if ($cliente['tipo'] == 'Mayorista'): ?>
                        <dt>Paga en el acto</dt>
                        <dd><?= $pagaenelacto ? 'Sí' : 'No' ?></dd>
                    <?php endif; ?>
                    <dt>Dirección</dt>
                    <dd><?= $cliente['direccion'] ?></dd>
                    <dt>Localidad</dt>
                    <dd><?= $cliente['localidad'] ?></dd>
                    <dt>Provincia</dt>
                    <dd><?= $cliente['provincia'] ?></dd>

                </dl>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-bottom: 30px;">
    <a href="<?=  site_url('/Venta/Finalizar/'.$cliente['idCliente'].'/'.$pagaenelacto)?>" class="btn btn-primary btn-lg btn-block">Finalizar Venta</a>
</div>


