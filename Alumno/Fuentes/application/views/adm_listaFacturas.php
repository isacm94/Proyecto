<style>
    .cuerpo{
        min-height: 1000px;
    }
</style>
<div>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#pendientes" aria-controls="home" role="tab" data-toggle="tab">Facturas Pendientes</a></li>
        <li role="presentation"><a href="#pagadas" aria-controls="profile" role="tab" data-toggle="tab">Facturas Pagadas</a></li>
    </ul>

    <div class="tab-content tab">
        <?php 
            if(! EMPTY($mensajePagada))
                echo $mensajePagada;
        ?>
        <!-- FACTURAS PENDIENTES -->
        <div role="tabpanel" class="tab-pane fade in active" id="pendientes">
            <div class="table-responsive">
                <table id="tabla_pendientes" class="table table-bordered table-hover">
                    <thead>
                        <tr class="warning">            
                            <th>Nº</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Importe Total</th>
                            <th>Nº artículos</th>
                            <th>Descuento</th>
                            <th class="col-opciones-3 no-ordenar"><i class="fa fa-cogs" aria-hidden="true"></i>  Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($facturas_pendientes as $value): ?>
                            <tr>
                                <td><?= $value['numfactura'] ?></td>
                                <td><?= $value['fecha_factura'] ?></td>
                                <td>
                                    <a href="<?= site_url('Administrador/Lista/Clientes/Ver/' . $value['idCliente']) ?>" title="Ver detalles del cliente">
                                        <?= $value['nombre_cliente'] ?>
                                    </a>
                                </td>
                                <td><?= $value['importe_total'] ?></td>
                                <td><?= $value['cantidad_total'] ?></td>
                                <td><?= round($value['descuento'], 2) ?></td>
                                <td class="opciones">
                                    <a href="<?= site_url('/Mostrar/Factura/' . $value['idFactura']) ?>" class="btn btn-default" style="color: red;" title="Ver detalles en PDF"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></a>
                                    <a href="" class="btn btn-default" data-toggle="modal" data-target="#modal_pagada_<?= $value['idFactura'] ?>" style="color: green;" title="Marcar como pagada"><i class="fa fa-money fa-lg" aria-hidden="true"></i></a>
                                    

                                            <!-- VENTANA MODAL DAR DE BAJA-->
                                            <div class="modal fade" id="modal_pagada_<?= $value['idFactura'] ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Marcar como pagada</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                <i class="fa fa-money fa-5x" aria-hidden="true" style="color: green;"></i>
                                                            </p>
                                                            <p>¿Desea marcar como pagada a la factura <i>Nº <?=$value['numfactura']?></i> de <i><?=$value['nombre_cliente']?></i> con fecha <i><?=$value['fecha_factura']?></i>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal" style="color: black">Cancelar</button>
                                                            <a href="<?= site_url('/Administrador/Lista/Facturas/Pagar/' . $value['idFactura']) ?>" class="btn btn-primary">Aceptar</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                    
                                    <a href="<?= site_url('/Administrador/Lista/Clientes/Ver/' . $value['idCliente']) ?>" class="btn btn-default" style="color: black;" title="Cambiar el descuento"><i class="fa fa-percent fa-lg" aria-hidden="true"></i></a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- FACTURAS PAGADAS -->
        <div role="tabpanel" class="tab-pane fade" id="pagadas">
            <div class="table-responsive">
                <table id="tabla_pagadas" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                        <tr class="warning">            
                            <th>Nº</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Importe Total</th>
                            <th>Nº artículos</th>
                            <th>Descuento</th>
                            <th class="col-opciones-3 no-ordenar"><i class="fa fa-cogs" aria-hidden="true"></i>  Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($facturas_pagadas as $value): ?>
                            <tr>
                                <td><?= $value['numfactura'] ?></td>
                                <td><?= $value['fecha_factura'] ?></td>
                                <td>
                                    <a href="<?= site_url('Administrador/Lista/Clientes/Ver/' . $value['idCliente']) ?>" title="Ver detalles del cliente">
                                        <?= $value['nombre_cliente'] ?>
                                    </a>
                                </td>
                                <td><?= $value['importe_total'] ?></td>
                                <td><?= $value['cantidad_total'] ?></td>
                                <td><?= round($value['descuento'], 2) ?></td>
                                <td class="opciones">
                                    <a href="<?= site_url('/Mostrar/Factura/' . $value['idFactura']) ?>" class="btn btn-default" style="color: red;" title="Ver detalles en PDF"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></a>
                                    <a href="<?= site_url('/Mostrar/Factura/' . $value['idFactura']).'/D' ?>" class="btn btn-default" style="color: black;" title="Descargar en PDF"><i class="fa fa-download fa-lg" aria-hidden="true"></i></a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>            
        </div>
    </div>

</div>