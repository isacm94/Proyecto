<?php
/*
 * VISTA que muestra una imagen y un mensaje cuando se accede al carrito y está vacío.
 */
?>
<!-- CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <img src="<?= base_url() . 'assets/img/carrito.jpg' ?>">
            <div class="alert msgcarritovacio">
                <div class="row"> 
                    <div class="col-md-1"></div>
                    <div class="col-md-10">¡El carrito está vacío!</div>

                </div>

            </div>                
        </div>
    </div>
</div>
