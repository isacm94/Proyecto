<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra el perfil de usuario
 */
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="col-md-1 col-sm-4 col-xs-4">
                    <a href="<?= site_url('/Perfil') ?>" title="Perfil"><img src="<?= base_url() . 'assets/images/emple64.png' ?>" class="img-responsive"></a>
                </div>
                <div class="derecha">
                    <a href="<?= site_url('/Perfil/Modificar') ?>" title="Modificar mi perfil" class="btn btn-warning"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>

                    <a href="<?= site_url('/Perfil/CambiarClave') ?>" title="Cambiar contraseña" class="btn btn-danger"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                if (isset($mensajeok)) {
                    echo $mensajeok;
                }
                ?>
                <table class="table tabla-detalle">
                    <tbody>
                        <tr>
                            <td><b>Nombre de usuario:</b></td>
                            <td><?= $datos['username'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Nombre:</b></td>
                            <td><?= $datos['nombre'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Correo:</b></td>
                            <td><a href="mailto:<?= $datos['correo'] ?>"><?= $datos['correo'] ?></a></td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>

