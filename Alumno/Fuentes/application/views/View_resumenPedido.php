<?php
/*
 * VISTA que muestra los datos de un pedido.
 */
?>
<!--CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="cart_totals" style=" float: none; width: 100%;">
                    <h2>Pedido</h2>

                    <table cellspacing="0">
                        <tbody>
                            <tr class="cart-subtotal">
                                <th style="width: 50%;">Importe Total</th>
                                <td><?= round($pedido['importe']*$this->session->userdata('rate'), 2) ?>&nbsp;<?=$this->session->userdata('currency')?></td>
                            </tr>

                            <tr class="shipping">
                                <th style="width: 50%;">Cantidad Total</th>
                                <td><?= $pedido['cantidad_total'] ?> camisetas</td>
                            </tr>

                            <tr class="order-total">
                                <th style="width: 50%;">Estado</th>
                                <td><?= $pedido['estado'] ?></td>
                            </tr>

                            <tr class="order-total">
                                <th style="width: 50%;">Fecha pedido</th>
                                <td><?= cambiaFormatoFecha($pedido['fecha_pedido']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="cart_totals" style=" float: none; width: 100%;">
                    <h2>Datos de envío</h2>

                    <table cellspacing="0">
                        <tbody>
                            <tr class="cart-subtotal">
                                <th style="width: 50%;">Dirección</th>
                                <td><?= $datosenvio['direccion'] ?></td>
                            </tr>

                            <tr class="shipping">
                                <th style="width: 50%;">Código Postal</th>
                                <td><?= $datosenvio['cp'] ?></td>
                            </tr>

                            <tr class="order-total">
                                <th style="width: 50%;">Provincia</th>
                                <td><?= $datosenvio['provincia'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-9">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <h2>Camisetas compradas</h2>
                        <form method="post" action="">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Imagen</th>
                                        <th class="product-name">Descripción</th>
                                        <th class="product-price">Precio</th>
                                        <th class="product-subtotal">IVA Aplicado</th>
                                        <th class="product-quantity">Cantidad</th>
                                        <th class="product-subtotal">Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($lineaspedidos as $linea): ?>
                                        <tr class="cart_item">

                                            <td class="product-thumbnail">
                                                <img width="145" height="145" class="shop_thumbnail" src="<?= base_url() . '/assets/img/imagesAPP/' . $linea['imagen'] ?>">
                                            </td>

                                            <td class="product-name">
                                                <?= $linea['descripcion'] ?>  
                                            </td>

                                            <td class="product-price">
                                                <?= round($linea['precio']*$this->session->userdata('rate'), 2) ?>&nbsp;<?=$this->session->userdata('currency')?>
                                            </td>

                                            <td class="product-quantity">
                                                <?= $linea['iva'] ?>&nbsp;%
                                            </td>

                                            <td class="product-subtotal">
                                                <?= $linea['cantidad'] ?>
                                            </td>

                                            <td class="product-subtotal">
                                                <?= round($linea['importe']*$this->session->userdata('rate'), 2) ?>&nbsp;<?=$this->session->userdata('currency')?>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


