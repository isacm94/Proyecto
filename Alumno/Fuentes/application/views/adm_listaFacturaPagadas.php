<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra las facturas pagadas
 */
?>

<div id="content" >
    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="<?=  site_url('/Administrador/Lista/Facturas')?>" data-toggle="tab">Facturas Pendientes</a></li>
        <li><a href="#pagadas" data-toggle="tab">Facturas Pagadas</a></li>
    </ul>
    <div id="my-tab-content" class="tab-content tab">
        <div class="tab-pane active" id="pagadas">
            <div class="x_panel" style="border: none;">
                <div class="row"> 
                    <div class="table-responsive">
                        <table id="tabla" class="table table-bordered table-hover">
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
                                            <a href="<?= site_url('/Administrador/Lista/Clientes/Ver/' . $value['idCliente']) ?>" class="btn btn-default" style="color: green;" title="Marcar como pagada"><i class="fa fa-money fa-lg" aria-hidden="true"></i></a>
                                            <a href="<?= site_url('/Administrador/Lista/Clientes/Ver/' . $value['idCliente']) ?>" class="btn btn-default" style="color: black;" title="Cambiar el descuento"><i class="fa fa-percent fa-lg" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
    
