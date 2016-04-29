<?php
/*
 * VISTA que muestra un mensaje de error cuando no se ha podido envíar el correo para restablecer la contraseña.
 */
?>
<!-- CUERPO -->
<div class="row">

    <div class="col-md-2"></div>
    <div class="col-md-8">  
        <div class="col-md-4">
            <img src="<?= base_url() . "/assets/images/mailerror.png" ?>">
        </div>
        <div class="col-md-4">
            <h1>Se ha producido un error enviado el correo, inténtelo de nuevo más tarde</h1>
            <?= $link ?>
        </div>
    </div>

</div>