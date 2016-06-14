/*DOCUMENTO JAVASCRIPT funciones utilizadas para comprobar con Ajax el stock de un producto en el carrito */

/**
 * Función que lanza una petición ajax al servidor del stock de un determinado producto
 * @param Int idProducto ID del producto
 */
function ConsultaStock(idProducto) {
    
    var id_input = 'num_'+ idProducto.toString();//cogemos el id del input
        
    var num_stock = document.getElementById(id_input).value;//Guardamos el nº introducido
    
    var ruta = site_url + "/Carrito/CompruebaStockAjax/" + idProducto;
    
    $.post(ruta,{num_stock: num_stock}, MuestraResultado);//Mando el nº introducido
}

/**
 * Función que actualiza el resultado de la petición ajax
 */
function MuestraResultado(carrito) {
    $(".cuerpo").html(carrito);
}

