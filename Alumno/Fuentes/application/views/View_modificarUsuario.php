<?php
/*
 * VISTA que muestra el formulario para modificar el usuario que ha iniciado sesión.
 */
?>
<!-- CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>

    <div class="row">
        <div class="col-md-1"></div>

        <div class="col-md-10">

            <form action="<?= base_url() . "index.php/ModificarUsuario/Modificar" ?>" class="checkout" method="post">
                <div id="customer_details" class="col2-set">

                    <div class="woocommerce-billing-fields">

                        <div id="" class="form-row form-row-first validate-required">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="">Nombre de usuario: <abbr title="required" class="required">*</abbr></label>
                                    <input type="text" value="<?= $datos['nombre_usu'] ?>" placeholder="Nombre de Usuario" id="billing_first_name" name="nombre_usu" class="input-text" maxlength="30">

                                </div>                           

                                <div class="col-md-3">
                                    <label class="">Contraseña: <abbr title="required" class="required">*</abbr></label>
                                    <input type="password" value="" style="width: 100%" placeholder="Contraseña" id="billing_first_name" name="clave" class="input-text">                                
                                </div>

                                <div class="col-md-2">
                                    <label class="">Contraseña Nueva:</label>
                                    <input type="password" value="" style="width: 100%" placeholder="Contraseña Nueva" id="billing_first_name" name="clave_nueva" class="input-text">                                
                                </div>

                                <div class="col-md-3">
                                    <label class="">Repita Contraseña Nueva:</label>
                                    <input type="password" value="" style="width: 100%" placeholder="Repita Contraseña Nueva" id="billing_first_name" name="rep_clave_nueva" class="input-text">                                
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4"><?= form_error('nombre_usu'); ?></div>
                                <div class="col-md-3"><?= form_error('clave'); ?></div>
                                <?php
                                if (!EMPTY($errorclave)) {
                                    echo '<div class="col-md-5">';
                                    echo $errorclave;
                                    echo '</div>';
                                }
                                ?>                  

                            </div>
                            <!--///-->
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="">Dirección: <abbr title="required" class="required">*</abbr> </label>
                                    <input type="text" value="<?= $datos['direccion'] ?>" placeholder="Dirección" id="billing_first_name" name="direccion" class="input-text" maxlength="100"> 
                                </div>

                                <div class="col-md-2">
                                    <label class="">Código Postal: <abbr title="required" class="required">*</abbr> </label>
                                    <input type="text" value="<?= $datos['cp'] ?>" placeholder="CP" id="billing_first_name" name="cp" class="input-text" maxlength="5"> 
                                </div>

                                <div class="col-md-2">
                                    <label class="">Provincia: <abbr title="required" class="required">*</abbr> </label>
<?= $select ?> 
                                </div>
                                <div class="col-md-4">
                                    <label class="">Correo electrónico: <abbr title="required" class="required">*</abbr></label>
                                    <input type="text" value="<?= $datos['correo'] ?>" placeholder="Correo de electrónico" id="billing_first_name" name="correo" class="input-text" maxlength="180">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4"><?= form_error('direccion'); ?></div>
                                <div class="col-md-2"><?= form_error('cp'); ?></div>
                                <div class="col-md-2"><?= form_error('cod_provincia'); ?></div>
                                <div class="col-md-4"><?= form_error('correo'); ?></div>
                            </div>
                        </div>
                        <!--///-->

                        <div class="col-md-9"></div>

                        <div class="col-md-3">
                            <button type="submit" value="Guardar Usuario" id="place_order" name="GuardarUsuario" class="button alt">
                                <span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;&nbsp;Guardar 
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>


    </div>
</div>
