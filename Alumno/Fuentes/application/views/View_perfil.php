<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="col-md-1 col-sm-4 col-xs-4">
                <img src="<?=base_url().'assets/admin32.png'?>" class="img-responsive">
                </div>
                <div class="derecha">
                    <a title="Modificar mi cuenta"class="boton btn btn-warning"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>

                    <a title="Cambiar contraseña"class="boton btn boton btn-danger"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table tabla-detalle">
                    <tbody>
                        <tr>
                            <td><b>Nombre de usuario:</b></td>
                            <td><?=$datos['username']?></td>
                        </tr>
                        <tr>
                            <td><b>Nombre:</b></td>
                            <td><?=$datos['nombre']?></td>
                        </tr>
                        <tr>
                            <td><b>Correo:</b></td>
                            <td><a href="mailto:<?=$datos['correo']?>"><?=$datos['correo']?></a></td>
                        </tr>

                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>

