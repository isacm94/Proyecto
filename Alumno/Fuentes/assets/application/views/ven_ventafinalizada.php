
<div class="container">
    <div class="row">
        <img src="<?=base_url().'assets/images/checked.png'?>" class="img-responsive imagen-centrada">
        <h1 class="text-center" style="color: #333;">Se ha realizado la venta correctamente</h1><br>
        <div class="col-md-6">
            <a href="<?=  site_url('/Mostrar/Albaran/'.$idAlbaran)?>" class="btn btn-primary btn-lg btn-block">Mostrar Albarán</a>
        </div>
        <div class="col-md-6">
            <a href="<?=  site_url('/Mostrar/Factura/'.$idFactura)?>" class="btn btn-primary btn-lg btn-block">Mostrar Factura</a>
        </div>
    </div>
</div>

