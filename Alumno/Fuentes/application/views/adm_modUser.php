<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="col-md-1 col-sm-4 col-xs-4">
                    <img src="<?= base_url() . 'assets/admin32.png' ?>" class="img-responsive">
                </div>
                <div class="derecha">
                    <a href="<?= base_url() . 'Administrador/Perfil/Modificar' ?>" title="Modificar mi cuenta" class="boton btn btn-warning"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>

                    <a title="Cambiar contraseña" class="boton btn boton btn-danger"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form role="form">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nombre de Usuario</label>
                            <input type="text" class="form-control" placeholder="Nombre de usuario">
                        </div>
                        <div class="col-md-4">
                            <label>Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="col-md-4">
                            <label>Correo</label>
                            <input type="text" class="form-control" placeholder="Correo electrónico">
                        </div>

                      
                            <div class="col-md-1 col-md-offset-10" style="padding-top: 10px">
                                <button type="submit" class="btn btn-default btn-primary">GUARDAR CAMBIOS</button>
                            </div>
                       
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

