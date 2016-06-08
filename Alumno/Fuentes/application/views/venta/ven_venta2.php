
<div class="container" style="padding-bottom: 100px;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Paso 2</div>
                <div class="panel-body">
                    <form action="<?= site_url('/Venta/ProcesaToggle') ?>" method="POST">
                        <label>Pagar en el acto:</label>
                        <div class="toggle-imagen">                        
                            <input type="checkbox" name="toggle" checked class="toggle-imagen-checkbox" id="toggle-imagen">
                            <label class="toggle-imagen-label" for="toggle-imagen">
                                <span class="toggle-imagen-inner"></span>
                                <span class="toggle-imagen-switch"></span>
                            </label>
                        </div>
                        <div class="text-right" style="margin-top: 15px;">
                            <button type="submit" class="btn btn-default btn-primary">SIGUIENTE 
                                <i class="fa fa-arrow-right" aria-hidden="true"></i> 
                            </button>
                        </div>

                        <input type="hidden" name="idCliente" value="<?= $idCliente ?>">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
