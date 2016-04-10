<?php
/*
 * VISTA que muestra las camisetas seleccionadas. 
 * Esta vista es la que se muestra al acceder a la aplicación.
 */
?>
<!-- CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">

            <?php foreach ($seleccionadas as $key => $camiseta) : ?>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">

                        </div>
                        <h2> <?php echo anchor('Camiseta/ver/' . $camiseta['idCamiseta'], '<img src="' . base_url() . 'assets/img/imagesAPP/' . $camiseta['imagen'] . '" style="width: 647px; heigth; 500px;">' . $camiseta['descripcion']) ?></h2>
                        <div class="product-carousel-price">                            
                            <?php MostrarDescuento($camiseta['precio'], $camiseta['descuento']) ?>
                        </div>  

                        <div class="product-option-shop">
                            <?php echo anchor('Carrito/comprar/'.$camiseta['idCamiseta'], '<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Comprar', 'class  = "add_to_cart_button"') ?>                         
                             
                        </div>                       
                    </div>
                </div>     
            <?php endforeach; ?>

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