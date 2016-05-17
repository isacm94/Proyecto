<?php
//Vista cuando un cliente es mayorista y no paga en el acto
?>
<style>
    .cuerpo{
        height: 500px;
    }
</style>
<div class="container">
    <div class="row">
        <img src="<?=base_url().'assets/images/checked.png'?>" class="img-responsive imagen-centrada">
        <h1 class="text-center">Se ha realizado la venta correctamente</h1>
        <h2 class="text-center">El albarán se ha añadido a la última factura no pagada(si existiera) del cliente</h2>
        <div class="col-md-12">
            <a href="<?=  site_url('/Mostrar/Albaran/'.$idAlbaran)?>" class="btn btn-primary btn-lg btn-block">Mostrar Albarán</a>
        </div>
    </div>
</div>

