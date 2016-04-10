<?php
/*
 * VISTA que muestra un mensaje de error cuando no se ha podido envíar el correo para restablecer la contraseña.
 */
?>
<!-- CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="single-product-area">  
                <div class="col-md-4">
                    <img src="<?= base_url() . "/assets/img/mailerror.png" ?>">
                </div><br><br>
                <h1>Se ha producido un error enviado el correo, inténtelo de nuevo más tarde</h1>
                <p><a href="<?= base_url() ?>">Pulse aquí para volver a la página principal</a></p>
            </div>
        </div>

    </div>

</div>