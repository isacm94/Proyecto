<?php 

if ($this->myCarrito->articulos_total() > 0):
    ?>
<div class="container panel">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Total</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->myCarrito->get_content() as $items): ?>
                            <tr>
                                <td class="col-sm-8 col-md-6">
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="<?=  site_url('Producto/ver/'.$items['id'])?>"><?= $items['nombre'] ?></a></h4>
                                            <h5 class="media-heading"><a href="<?=  site_url('Categoria/index/'.$items['idCategoria'])?>"><?= $items['categoria'] ?></a></h5>
                                            <span>Stock: </span><span class="text-success"><b><?= $items['stock'] ?></b></span>
                                        </div>
                                    </div>
                                    <?php echo $items['errorstock'];?>
                                </td>
                                <td class="col-sm-1 col-md-1" style="text-align: center">
                                    <input type="number" class="form-control" value="<?= $items['cantidad'] ?>">
                                </td>
                                <td class="col-sm-1 col-md-1 text-center"><b><?= round($items['precio'], 2) ?>&nbsp;€</b></td>
                                <td class="col-sm-1 col-md-1 text-center"><b><?= round($items['precio']*$items['cantidad'], 2) ?>&nbsp;€</b></td>
                                <td class="col-sm-1 col-md-1">
                                    <a href="<?=  site_url('/Carrito/eliminar/'.$items['id'])?>" class="link-borrar"><i class="fa fa-times fa-lg" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td></td><td></td><td></td>
                            <td><h4>Cantidad total</h4></td>
                            <td class="text-right"><h5><b><?= $this->myCarrito->articulos_total() ?>&nbsp;artículos</b></h5></td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td>
                            <td><h4>Importe Total</h4></td>
                            <td class="text-right"><h5><b><?= round($this->myCarrito->precio_total(), 2) ?>&nbsp;€</b></h5></td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td>
                            <td>
                                <a href="<?=  site_url('/Carrito/eliminarcompra')?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Vacíar Carrito</a>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Realizar venta
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 <?php
endif;
if ($this->myCarrito->articulos_total() <= 0):
    $this->load->view('Ven_carritovacio');
endif;
?>