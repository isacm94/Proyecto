<?php
/*
 * VISTA que muestra las camisetas de una categoría determinada.
 */

if (count($camisetas) == 0):
    ?>
    <!-- CUERPO -->
    <div class="woocommerce-info">No existen camisetas para mostrar en esta categoría</div>
    <?php
endif;

if (count($camisetas) > 0):
    ?>
    <!-- CUERPO -->
    <div class="single-product-area">
        <div class="container">


            <?php
            $cont = 0;
            foreach ($camisetas as $key => $camiseta) :

                if ($cont == 0) {
                    echo '<div class="row">';
                }

                $cont++;
                ?>
                <div class="col-md-3">
                    <div class="single-shop-product">
                        <div class="product-upper">

                        </div>
                        <h2><?= anchor('Camiseta/ver/' . $camiseta['idCamiseta'], '<img src="' . base_url() . 'assets/img/imagesAPP/' . $camiseta['imagen'] . '"" style="width: 647px; heigth; 500px;">' . $camiseta['descripcion']) ?></h2>
                        <div class="product-carousel-price">
                            
                                <?php MostrarDescuento($camiseta['precio'], $camiseta['descuento']) ?>
                        </div>

                        <div class="product-option-shop">
                            <?php echo anchor('Carrito/comprar/' . $camiseta['idCamiseta'], '<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Comprar', 'class  = "add_to_cart_button"') ?>
                        </div>
                    </div>
                </div>
                <?php
                if ($cont == 3) {
                    echo '</div>';
                    $cont = 0;
                }
                ?>
            <?php endforeach; ?>



        </div>
        <div class="product-pagination text-center">
            <nav>                              
                <!-- PAGINATION CODEIGNITER -->
                <?= $this->pagination->create_links(); ?>

            </nav>                        
        </div>
    </div>


    <?php
endif;
?>

