<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra en detalle el cliente
 */
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="col-md-1 col-sm-4 col-xs-4">

                </div>
                <div class="derecha">
                    <a href="<?= site_url('/Administrador/Lista/Clientes') ?>" class="btn btn-default btn-lista " title="Lista de proveedores"><i class="fa fa-list fa-lg" aria-hidden="true"></i></a>
                    <a href="<?= site_url('/Administrador/Lista/Clientes/Modificar/' . $cliente['idCliente']) ?>" class="btn btn-default btn-editar " title="Modificar proveedor"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-3 col-sm-6"><b>Nombre: </b><?= $cliente['nombre'] ?></div>     
                    <div class="col-md-3 col-sm-6"><b>NIF: </b><?= $cliente['nif'] ?></div>  
                    <div class="col-md-3 col-sm-6"><b>Correo: </b><a href="mailto:<?= $cliente['correo'] ?>"><?= $cliente['correo'] ?></a></div>  
                    <div class="col-md-3 col-sm-6"><b>Estado: </b><?= $cliente['estado'] ?></div>  
                </div> 
                <hr>
                <div class="row">
                    <div class="col-md-3 col-sm-6"><b>Dirección: </b><?= $cliente['direccion'] ?></div>     
                    <div class="col-md-3 col-sm-6"><b>Localidad: </b><?= $cliente['localidad'] ?></div>  
                    <div class="col-md-1 col-sm-6"><b>CP: </b><?= $cliente['cp'] ?></a></div>  
                    <div class="col-md-2 col-sm-6"><b>Tipo: </b><?= $cliente['tipo'] ?></a></div>  
                    <div class="col-md-3 col-sm-6"><b>Provincia: </b><?= $cliente['provincia'] ?></div>  
                </div>       
                <hr>
                <div class="row">
                    <div class="col-md-12"><b>Anotaciones: </b><?= $cliente['anotaciones'] ?></div>   
                </div>  


            </div>
        </div>
    </div>
</div>

