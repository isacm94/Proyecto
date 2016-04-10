<?php
/*
 * VISTA que muestra todos los pedidos de un usuario.
 */
?>
<!--CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="product-content-right">
            <div class="woocommerce">
                <h2>Camisetas compradas</h2>
                <table cellspacing="0" class="shop_table cart">
                    <thead>
                        <tr>                                        
                            <th class="product-thumbnail">Fecha pedido</th>
                            <th class="product-thumbnail">Estado</th>
                            <th class="product-name">Importe</th>
                            <th class="product-price">Cantidad</th>
                            <th class="product-subtotal">Direccion</th>
                            <th class="product-quantity">CP</th>
                            <th class="product-subtotal">Provincia</th>
                            <th class="product-subtotal">Ver Resumen</th>
                            <th class="product-subtotal">PDF</th>
                            <th class="product-subtotal">Anular pedido</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr class="cart_item">

                                <td class="product-thumbnail">
                                    <?= $pedido['fecha_pedido'] ?>
                                </td>

                                <td class="product-name">
                                    <?= $pedido['estado'] ?>
                                </td>

                                <td class="product-price">
                                    <?= round($pedido['importe']*$this->session->userdata('rate'), 2) ?>&nbsp;<?=$this->session->userdata('currency')?>
                                </td>

                                <td class="product-quantity">
                                    <?= $pedido['cantidad_total'] ?>&nbsp;camisetas
                                </td>

                                <td class="product-subtotal">
                                    <?= $pedido['direccion'] ?>
                                </td>

                                <td class="product-subtotal">
                                    <?= $pedido['cp'] ?>
                                </td>

                                <td class="product-price">
                                    <?= $pedido['nom_provincia'] ?>
                                </td>

                                <td class="product-quantity">
                                    <a title="Ver resumen" href="<?= site_url() . "/Pedidos/MuestraResumen/" . $pedido['idPedido'] ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                </td>

                                <td class="product-subtotal">
                                    <a title="Descargar PDF" href="<?= site_url() . "/Pedidos/DescargarPDFPedido/" . $pedido['idPedido'] ?>"><span class="glyphicon glyphicon-download-alt"></span></a>
                                    /
                                    <a title="Ver PDF" href="<?= site_url() . "/Pedidos/VerPDFPedido/" . $pedido['idPedido'] ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                </td>

                                <td class="product-subtotal">
                                    <a title="Anular Pedido" href="<?= site_url() . "/MisPedidos/AnularPedido/" . $pedido['idPedido'] ?>"><span class="glyphicon glyphicon-remove" style="color: red;"></span></a>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <?php if (!EMPTY($msg_error))
                    echo $msg_error;
                ?>
            </div>
        </div>
        
        <!-- PAGINACIÓN -->
        <div class="row">
            <div class="col-md-12">
                <div class="product-pagination text-center">
                    <nav>                              
                        <!-- PAGINATION CODEIGNITER -->
                        <?= $this->pagination->create_links(); ?>

                    </nav>                        
                </div>
            </div>
        </div>
        
    </div>
</div>



