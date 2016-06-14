<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra el formulario para cambiarle el descuento a una factura
 */
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Cambiar descuento</div>
                <div class="panel-body">
                    <form action="<?= site_url('/Administrador/Lista/Facturas/Descuento/' . $info_factura['idFactura']) ?>" method="POST">
                        <label>Introduce un descuento en %</label>
                        <input type="text" name="descuento" value="<?= round($info_factura['descuento'], 2) ?>" placeholder="Descuento" class="form-control">
                        <?= form_error('descuento'); ?>
                        <?= $mensajeok ?>
                        <div class="text-right" style="margin-top: 15px;">
                            <button type="submit" class="btn btn-default btn-success">Guardar  
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> 
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


