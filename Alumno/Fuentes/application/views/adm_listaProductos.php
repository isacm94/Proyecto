<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra todos los proveedores
 */
?>
<div class="x_panel">
    <div class="row"> 
        <div class="col-md-6">
            <?php if (isset($mensajebuscar) && $mensajebuscar != ''): ?>
                <div class="alert alert-info"><?= $mensajebuscar ?></div>
            <?php endif; ?>

        </div>
        <div class="col-md-6">
            <form action="<?= site_url('/Administrador/Lista/Productos/Buscar') ?>" method="post">
                <div class="input-group">
                    <input type="text" name="campo" value="<?= set_value('campo') ?>" placeholder="Buscar por cualquier campo" class="form-control">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default btn-buscar"><i class="fa fa-search" aria-hidden="true"></i> BUSCAR</button>

                    </span>
                </div>
            </form>
        </div>
    </div><br>
    <?php if (isset($sinrdo) && $sinrdo != '') { ?>
        <div class="alert alert-warning"><?= $sinrdo ?></div>
    <?php } else {
        ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr class="warning">            
                    <th>Referencia</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Precio Venta</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th class="col-opciones-3"><i class="fa fa-cogs" aria-hidden="true"></i>  Opciones</th>
                </tr>

                <?php foreach ($productos as $value): ?>
                    <tr>
                        <td><?= $value['referencia'] ?></td>
                        <td><?= $value['nombre'] ?></td>
                        <td><?= $value['categoria'] ?></td>
                        <td><?= $value['precio'] ?> €</td>
                        <td><?= $value['precio_venta']?> €</td>
                        <td><?= $value['stock'] ?></td>
                        <td><?= $value['estado'] ?></td>
                        <td class="opciones">
                            <a href="<?= site_url('/Administrador/Lista/Productos/Ver/' . $value['idProducto']) ?>" class="btn btn-default btn-ver " title="Ver detalles"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                            <a href="<?= site_url('/Administrador/Lista/Productos/Modificar/' . $value['idProducto']) ?>" class="btn btn-default btn-editar " title="Modificar"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>

                            <!-- ESTADO -->
                            <?php if ($value['estado'] == 'Alta'): //Si el estado es Alta, le podemos dar de baja?>
                                <a href="" class="btn btn-default btn-baja " data-toggle="modal" data-target="#modal_baja_<?= $value['idProducto'] ?>" title="Dar de baja"><i class="fa fa-times fa-lg" aria-hidden="true"></i></a>

                                <!-- VENTANA MODAL DAR DE BAJA-->
                                <div class="modal fade" id="modal_baja_<?= $value['idProducto'] ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Dar de baja</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <i class="fa fa-times fa-5x btn-baja" aria-hidden="true"></i>
                                                </p>
                                                <p>¿Desea dar de baja al proveedor '<?= $value['nombre'] ?>'?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal" style="color: black">Cancelar</button>
                                                <a href="<?= site_url('/Administrador/Lista/Productos/Baja/' . $value['idProducto']) ?>" class="btn btn-primary">Aceptar</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php endif; ?>
                            <?php if ($value['estado'] == 'Baja'): ?>
                                <a href="" class="btn btn-default btn-alta " data-toggle="modal" data-target="#modal_alta_<?= $value['idProducto'] ?>" title="Dar de alta"><i class="fa fa-check fa-lg" aria-hidden="true"></i></a>

                                <!-- VENTANA MODAL DAR DE ALTA-->
                                <div class="modal fade" id="modal_alta_<?= $value['idProducto'] ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Dar de alta</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p><i class="fa fa-check fa-5x btn-alta" aria-hidden="true"></i></p>
                                                <p>¿Desea dar de alta al proveedor '<?= $value['nombre'] ?>'?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal" style="color: black">Cancelar</button>
                                                <a href="<?= site_url('/Administrador/Lista/Productos/Alta/' . $value['idProducto']) ?>" class="btn btn-primary">Aceptar</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>        
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>

            <!-- PAGINACIÓN -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <?= $this->pagination->create_links(); ?>

                </div>
            </div>
        </div>
    <?php } ?>
</div>

