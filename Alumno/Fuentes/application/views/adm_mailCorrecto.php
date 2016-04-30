<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra un mensaje cuando se envía el correo para restablecer la contraseña.
 */
?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <div class="col-md-4">
            <img src="<?= base_url() . "/assets/images/mail.png" ?>">
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
        <h1>Se ha enviado correctamente el correo al usuario</h1>
        <?= $link ?>
        </div>
    </div>

</div>

