<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra en detalle el proveedor
 */
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="col-md-1 col-sm-4 col-xs-4">

                </div>
                <div class="derecha">
                    <a href="<?= site_url('/Administrador/Lista/Proveedores') ?>" class="btn btn-default btn-lista " title="Lista de proveedores"><i class="fa fa-list fa-lg" aria-hidden="true"></i></a>
                    <a href="<?= site_url('/Administrador/Lista/Proveedores/Modificar/' . $proveedor['idProveedor']) ?>" class="btn btn-default btn-editar " title="Modificar proveedor"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-3 col-sm-6"><b>Nombre: </b><?= $proveedor['nombre'] ?></div>     
                    <div class="col-md-3 col-sm-6"><b>NIF: </b><?= $proveedor['nif'] ?></div>  
                    <div class="col-md-3 col-sm-6"><b>Correo: </b><a href="mailto:<?= $proveedor['correo'] ?>"><?= $proveedor['correo'] ?></a></div>  
                    <div class="col-md-3 col-sm-6"><b>Estado: </b><?= $proveedor['estado'] ?></div>  
                </div> 
                <hr>
                <div class="row">
                    <div class="col-md-3 col-sm-6"><b>Dirección: </b><?= $proveedor['direccion'] ?></div>     
                    <div class="col-md-3 col-sm-6"><b>Localidad: </b><?= $proveedor['localidad'] ?></div>  
                    <div class="col-md-3 col-sm-6"><b>CP: </b><?= $proveedor['cp'] ?></a></div>  
                    <div class="col-md-3 col-sm-6"><b>Provincia: </b><?= $proveedor['provincia'] ?></div>  
                </div>       
                <hr>
                <div class="row">
                    <div class="col-md-12"><b>Anotaciones: </b><?= $proveedor['anotaciones'] ?></div>   
                </div>  


            </div>
        </div>
    </div>
</div>

