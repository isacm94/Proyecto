<?php
/*
 * VISTA DEL MÓDULO DE ADMINISTRACIÓN que muestra un mensaje cuando se ha cambiando la contraseña correctamente a tráves del correo
 */
?>
<div class="row">

    <div class="col-md-2"></div>
    <div class="col-md-9">
        <div class="col-md-4">
            <img src="<?= IMAGES_PATH."clave.png" ?>">
        </div><br><br>
        <h1>Se ha cambiado correctamente su contraseña</h1>
        <p><a href="<?= site_url("/Administrador/Login")?>">Pulse aquí para iniciar sesión</a></p>

    </div>

</div>