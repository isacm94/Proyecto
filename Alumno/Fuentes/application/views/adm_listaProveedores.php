<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra todos los proveedores
 */
?>
<div class="x_panel">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <tr class="warning">            
                <th>Nombre</th>
                <th>NIF</th>
                <th>Correo</th>
                <th>Estado</th>
                <th class="col-opciones-3"><i class="fa fa-cogs" aria-hidden="true"></i>  Opciones</th>
            </tr>

            <?php foreach ($proveedores as $value): ?>
                <tr>
                    <td><?= $value['nombre'] ?></td>
                    <td><?= $value['nif'] ?></td>
                    <td><?= $value['correo'] ?></td>
                    <td><?= $value['estado'] ?></td>
                    <td class="opciones">
                        <a href="<?= site_url('/Administrador/Lista/Proveedores/ver/' . $value['id'])?>" class="btn btn-default btn-ver " title="Ver detalles"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                        <a href="<?= site_url('/Administrador/Lista/Proveedores/modificar/' . $value['id'])?>" class="btn btn-default btn-editar " title="Modificar"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>

                        <!-- ESTADO -->
                        <?php if ($value['estado'] == 'Alta'): //Si el estado es Alta, le podemos dar de baja?>
                            <a href="" class="btn btn-default btn-baja " data-toggle="modal" data-target="#modal_baja_<?= $value['id'] ?>" title="Dar de baja"><i class="fa fa-times fa-lg" aria-hidden="true"></i></a>

                            <!-- VENTANA MODAL DAR DE BAJA-->
                            <div class="modal fade" id="modal_baja_<?= $value['id'] ?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Dar de baja</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><i class="fa fa-times fa-5x btn-baja" aria-hidden="true"></i></p>
                                            <p>¿Desea dar de baja al proveedor '<?= $value['nombre'] ?>'?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" style="color: black">Cancelar</button>
                                            <a href="<?= site_url('/Administrador/Lista/Proveedores/Baja/' . $value['id'])?>" class="btn btn-primary">Aceptar</a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php endif; ?>
                        <?php if ($value['estado'] == 'Baja'): ?>
                            <a href="" class="btn btn-default btn-alta " data-toggle="modal" data-target="#modal_alta_<?= $value['id'] ?>" title="Dar de alta"><i class="fa fa-check fa-lg" aria-hidden="true"></i></a>

                            <!-- VENTANA MODAL DAR DE ALTA-->
                            <div class="modal fade" id="modal_alta_<?= $value['id'] ?>" role="dialog">
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
                                            <a href="<?= site_url('/Administrador/Lista/Proveedores/Alta/' . $value['id'])?>" class="btn btn-primary">Aceptar</a>
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
</div>

