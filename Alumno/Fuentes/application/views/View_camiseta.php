<?php
/*
 * VISTA que muestra la imagen e información relacionada de una camiseta.
 */
?>
<!-- CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-1">
            </div>

            <div class="col-md-10">
                <div class="product-content-right">                        
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="<?= base_url() . 'assets/img/imagesAPP/' . $camiseta['imagen'] ?>" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name"><?= $camiseta['nombre_cam'] . ' - ' . $camiseta['cod_camiseta'] ?></h2>
                                <div class="product-inner-price">
                                    <?= MostrarDescuento($camiseta['precio'], $camiseta['descuento']) ?>
                                </div>    

                                <form action="<?= site_url() . '/Carrito/comprar/' . $camiseta['idCamiseta'] ?>" method="POST" class="cart">
                                    <div class="quantity">
                                        <input type="number" class="input-text qty text"  value="1" name="cantidadCam" min="1" step="1">
                                    </div>

                                    <button type="submit" class="add_to_cart_button" name="guardar" style="">
                                        <i class="fa fa-shopping-cart"></i> Comprar
                                    </button>
                                    <?php //echo anchor('Carrito/comprar/'.$camiseta[0]['idCamiseta'], '<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Comprar', 'class  = "add_to_cart_button"') ?>
                                </form>   


                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">                                         

                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Descripción</h2>  
                                            <p><?= $camiseta['descripcion'] ?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- CAMISETAS RELACIONDAS -->
                    <div class="related-products-wrapper">
                        <?php $this->load->view('View_camisetasRel'); ?>
                    </div>                    
                </div>

                <div class="col-md-2">
                </div>
            </div>
        </div>
    </div>