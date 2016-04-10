<?php
/*
 * VISTA que pide al usuario si elimina o no su cuenta.
 */
?>
<!-- CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default" style="background-color: #f5f5f5;">

                <div class="panel-body">
                    <div class="container">
                        <h3>¿Desea darse de baja en la página?</h3>

                        <div style="margin: 0 auto; width: 78%;">
                            <a href="<?=base_url().'index.php/EliminarUsuario/eliminar'?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Sí</a>
                            <a href="<?=base_url()?>" class="btn btn-success" style="width: 53px;">No</a>
                        </div>
                    </div>
                </div>             
            </div>
        </div>
        
    </div>
</div>