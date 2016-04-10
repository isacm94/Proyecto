<?php
/*
 * VISTA que muestra el formulario para añadir un usuario.
 */
?>
<!-- CUERPO -->

<div class="single-product-area">
    <div class="zigzag-bottom"></div>

    <div class="row">
        <div class="col-md-1"></div>

        <div class="col-md-10">

            <form action="<?= base_url() . 'index.php/Registro/Usuario' ?>" class="checkout" method="post">
                <div id="customer_details" class="col2-set">

                    <div class="woocommerce-billing-fields">

                        <div id="" class="form-row form-row-first validate-required">
                            <div class="col-md-4">
                                <label class="">Nombre de usuario:</label>
                                <input type="text" value="<?= set_value('nombre_usu') ?>" placeholder="Nombre de Usuario" id="billing_first_name" name="nombre_usu" class="input-text" maxlength="30">

                            </div>                           

                            <div class="col-md-2">
                                <label class="">Contraseña:</label>
                                <input type="password" value="" style="width: 100%" placeholder="Contraseña" id="billing_first_name" name="clave" class="input-text">                                
                            </div>

                            <div class="col-md-2">
                                <label class="">Repita Contraseña:</label>
                                <input type="password" value="" style="width: 100%" placeholder="Repita Contraseña" id="billing_first_name" name="rep_clave" class="input-text">                                
                            </div>

                            <div class="col-md-4">
                                <label class="">Correo electrónico:</label>
                                <input type="text" value="<?= set_value('correo') ?>" placeholder="Correo de electrónico" id="billing_first_name" name="correo" class="input-text" maxlength="180">
                            </div>

                            <div class="row">
                                <div class="col-md-4"><?= form_error('nombre_usu'); ?></div>
                                <?php
                                if (! EMPTY($errorclave)) {
                                    echo '<div class="col-md-4">';
                                    echo $errorclave;
                                    echo '</div>';
                                }
                                if (EMPTY($errorclave)):
                                    ?>
                                    <div class="col-md-2"><?= form_error('clave'); ?></div>
                                    <div class="col-md-2"><?= form_error('rep_clave'); ?></div>
                                <?php endif ?>                  
                                <div class="col-md-4"><?= form_error('correo'); ?></div>
                            </div>
                            <!--///-->

                            <div class="col-md-4">
                                <label class="">Nombre: </label>
                                <input type="text" value="<?= set_value('nombre_persona') ?>" placeholder="Nombre" id="billing_first_name" name="nombre_persona" class="input-text" maxlength="40"> 
                            </div>                         

                            <div class="col-md-4">
                                <label class="">Apellidos: </label>
                                <input type="text" value="<?= set_value('apellidos_persona') ?>" placeholder="Apellidos" id="billing_first_name" name="apellidos_persona" class="input-text" maxlength="60"> 
                            </div>

                            <div class="col-md-4">
                                <label class="">DNI: </label>
                                <input type="text" value="<?= set_value('dni') ?>" placeholder="DNI" id="billing_first_name" name="dni" class="input-text" maxlength="9"> 
                            </div>

                            <div class="row">
                                <div class="col-md-4"><?= form_error('nombre_persona'); ?></div>
                                <div class="col-md-4"><?= form_error('apellidos_persona'); ?></div>
                                <div class="col-md-4"><?= form_error('dni'); ?></div>
                            </div>
                            <!--///-->

                            <div class="col-md-4">
                                <label class="">Dirección: </label>
                                <input type="text" value="<?= set_value('direccion') ?>" placeholder="Dirección" id="billing_first_name" name="direccion" class="input-text" maxlength="100"> 
                            </div>

                            <div class="col-md-4">
                                <label class="">Código Postal: </label>
                                <input type="text" value="<?= set_value('cp') ?>" placeholder="CP" id="billing_first_name" name="cp" class="input-text" maxlength="5"> 
                            </div>

                            <div class="col-md-4">
                                <label class="">Provincia: </label>
                                <?= $select ?> 
                            </div>

                            <div class="row">
                                <div class="col-md-4"><?= form_error('direccion'); ?></div>
                                <div class="col-md-4"><?= form_error('cp'); ?></div>
                                <div class="col-md-4"><?= form_error('cod_provincia'); ?></div>
                            </div>
                        </div>
                        <!--///-->

                        <div class="col-md-9"></div>

                        <div class="col-md-3">
                            <button type="submit" value="Guardar Usuario" id="place_order" name="GuardarUsuario" class="button alt">
                                <span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;&nbsp;Guardar Usuario
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>


    </div>
</div>
