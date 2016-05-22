<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN del cambio de plantilla
 */
?>

<div class="x_panel">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-responsive">
            <tr class="warning">            
                <th>Template</th>
                <th>Seleccionada</th>
                <th>Localización</th>
                <th>Demo</th>
            </tr>

            <?php foreach ($plantillas_admin as $key => $value): ?>
                <tr>
                    <td><?= $key ?></td>
                    <td>
                        <?php if ($plant_adm_activa == $value['fichero']): //Si la template está activa?>
                            <a href="#" class="btn btn-default btn-select-template"><i class="fa fa-star fa-lg" aria-hidden="true"></i></a>
                        <?php endif; ?>

                        <?php if ($plant_adm_activa != $value['fichero']): //Si la template NO está activa?>
                            <a href="<?= site_url('/Administrador/ConfigPlantillas/CambiaPlantillaAdmin/' . $value['fichero']) ?>" class="btn btn-default btn-no-select-template"><i class="fa fa-star-o fa-lg" aria-hidden="true"></i></a>
                        <?php endif; ?>
                    </td>
                    <td><img src="<?= base_url() . 'assets/images/admin64.png' ?>" style="width: 25px; height: 25px;"> Administración</td>
                    <td><a target="_blank" href="<?= $value['linkDemo'] ?>">Ver demo</a></td>
                </tr>
            <?php endforeach; ?>

            <?php foreach ($plantillas_ven as $key => $value): ?>
                <tr>
                    <td><?= $key ?></td>
                    <td>
                        <?php if ($plant_venta_activa == $value['fichero']): //Si la template está activa?>
                            <a href="#" class="btn btn-default btn-select-template"><i class="fa fa-star fa-lg" aria-hidden="true"></i></a>
                        <?php endif; ?>

                        <?php if ($plant_venta_activa != $value['fichero']): //Si la template NO está activa?>
                            <a href="<?= site_url('/Administrador/ConfigPlantillas/CambiaPlantillaVenta/' . $value['fichero']) ?>" class="btn btn-default btn-no-select-template"><i class="fa fa-star-o fa-lg" aria-hidden="true"></i></a>
                        <?php endif; ?>
                    </td>
                    <td><img src="<?= base_url() . 'assets/images/emple64.png' ?>" style="width: 25px; height: 25px;"> Venta</td>
                    <td><a target="_blank" href="<?= $value['linkDemo'] ?>">Ver demo</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

