<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra un mensaje de error si se ha enviado correctamente el correo al usuario con la contraseña
 */
?>

<div class="container">
    <div class="row">
        <img style="margin-top: 100px;"src="<?= IMAGES_PATH . "mailerror.png" ?>" class="img-responsive imagen-centrada">
        <h1 class="otrafuente">Se ha producido un error enviado el correo, inténtelo de nuevo más tarde <?= $link ?></h1>
    </div>
</div>




