<?php
/*
 * VISTA que muestra información sobre las camisetas compradas.
 * Si el carrito está vacío muestra una imagen.
 */

if ($this->myCarrito->articulos_total() > 0):
    ?>
    <!--CUERPO -->
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">Eliminar</th>
                                            <th class="product-thumbnail">Imagen</th>
                                            <th class="product-name">Descripción</th>
                                            <th class="product-price">Precio</th>
                                            <th class="product-quantity">Cantidad</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->myCarrito->get_content() as $items): ?>
                                            <tr class="cart_item">
                                                <td class="product-remove">
                                                    <?= anchor('Carrito/eliminar/' . $items['id'], '<span class="glyphicon glyphicon-remove" style="color: red;"></span>', 'title = "Eliminar esta camiseta"') ?>
                                                </td>

                                                <td class="product-thumbnail">
                                                    <a href="<?= base_url() . 'index.php/Camiseta/ver/' . $items['id'] ?>"><img width="145" height="145" class="shop_thumbnail" src="<?= base_url() . 'assets/img/imagesAPP/' . $items['opciones']['imagen'] ?>"></a>
                                                </td>

                                                <td class="product-name">
                                                    <a href="<?= base_url() . 'index.php/Camiseta/ver/' . $items['id'] ?>"><?= $items['nombre'] ?></a>
                                                </td>

                                                <td class="product-price">
                                                    <span class="amount"> <?= round($items['precio']*$this->session->userdata('rate'), 2).' '.$this->session->userdata('currency')?></span>
                                                </td>

                                                <td class="product-quantity">

                                                    <div class="quantity buttons_added">

                                                        <button type="button" class="add_to_cart_button"  onclick="menos(<?= $items['id'] ?>)">
                                                            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                                        </button>

                                                        <input type="number" id="cantidad[<?= $items['id'] ?>]" name="cantidad[<?= $items['id'] ?>]" size="4" class="input-text qty text" value="<?= $items['cantidad'] ?>" min="1" step="1">

                                                        <button type="button" class="add_to_cart_button"  onclick="mas(<?= $items['id'] ?>)">
                                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                        </button>

                                                        <?= $items['opciones']['error']; ?>

                                                    </div>
                                                </td>

                                                <td class="product-subtotal">
                                                    <span class="amount"><?= round($items['total']*$this->session->userdata('rate'), 2).' '.$this->session->userdata('currency')?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr class="product-name">
                                            <td class="actions" colspan="3">
                                                <strong>Importe Total:</strong>  <?= round($this->myCarrito->precio_total()*$this->session->userdata('rate'), 2).' '.$this->session->userdata('currency')?>
                                            </td>

                                            <td class="actions" colspan="3">
                                                <strong>Cantidad Total:</strong> <?= $this->myCarrito->articulos_total() ?> camisetas
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-8">
                                    <?php
                                    if (isset($msg_error))
                                        echo $msg_error;
                                    ?>

                                </div>
                                <div class="col-md-4">

                                    <button type="submit" style="margin-left: 5px;" class="add_to_cart_button" name="guardar">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> Guardar cambios&nbsp;&nbsp;&nbsp;
                                    </button>
                                    <br><br>
                                </div>
                                <div class="row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <a href="<?= base_url() . 'index.php/Pedidos/RealizaPedido' ?>" style="padding: 11px 20px; width: 186px; height: 42px;" class="add_to_cart_button" >
                                            <span class="glyphicon glyphicon-ok"></span> FINALIZAR COMPRA
                                        </a>
                                        
                                        <br><br>

                                        <a href="<?= base_url() . 'index.php/Carrito/eliminarcompra' ?>" style="padding: 11px 20px; width: 186px; height: 42px;" class="add_to_cart_button">
                                            <span class="glyphicon glyphicon-trash"></span> ELIMINAR COMPRA&nbsp;
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
endif;
if ($this->myCarrito->articulos_total() <= 0):
    $this->load->view('View_fotocarrito');
endif;
?>
