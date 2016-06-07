<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra el formulario para seleccionar una imagen del producto, también muestra los datos introducidos anteriormente del producto
 */
?>
<?php $post = $this->session->userdata('post') ?>
<?php if(isset($mensajeok))
    echo $mensajeok;?>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h4><i class="fa fa-dropbox fa-lg" aria-hidden="true"></i> Datos del Producto</h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table tabla-detalle">
                    <tbody>
                        <tr>
                            <td><b>Nombre del producto:</b></td>
                            <td><?= $post['nombre'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Marca:</b></td>
                            <td><?= $post['marca'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Precio:</b></td>
                            <td><?= $post['precio'] ?>€</td>
                        </tr>
                        <tr>
                            <td><b>Precio de venta:</b></td>
                            <td><?= $post['precio_venta'] ?>€</td>
                        </tr>
                        <tr>
                            <td><b>IVA aplicado:</b></td>
                            <td><?= $post['iva'] ?> %</td>
                        </tr>
                        <tr>
                            <td><b>Stock:</b></td>
                            <td><?= $post['stock'] ?> disponibles</td>
                        </tr>
                        <tr>
                            <td><b>Categoría:</b></td>
                            <td><?= $post['categoria'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Proveedor:</b></td>
                            <td><?= $post['proveedor'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Descripción:</b></td>
                            <td><?= $post['descripcion'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">

        <div class="x_panel">
            <div class="x_title">
                <h4><i class="fa fa-picture-o fa-lg" aria-hidden="true"></i> Seleccione una imagen para el producto:</h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form action="<?= site_url('/Administrador/Agregar/Producto/ProcesaImagen') ?>" method="POST" enctype="multipart/form-data">

                    <label>Imagen</label>
                    <input type="file" class="form-control" name="imagen" value="imagen.png">
                    <?php
                    if ($error_img != '')
                        echo $error_img
                        ?>

                    <br>
                    <div class="col-md-1 col-md-offset-7">
                        <button type="submit" class="btn btn-default btn-success"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> GUARDAR PRODUCTO</button>
                    </div>
                </form>
            </div>
        </div>    
    </div>
</div>
</div>