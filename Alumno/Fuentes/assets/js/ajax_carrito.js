

function ConsultaStock(idProducto) {
    
    var id_input = 'num_'+ idProducto.toString();//cogemos el id del input
        
    var num_stock = document.getElementById(id_input).value;//Guardamos el nº introducido
    
    var ruta = site_url + "/Carrito/CompruebaStockAjax/" + idProducto;
    
    $.post(ruta,{num_stock: num_stock}, MuestraResultado);//Mando el nº introducido
}

function MuestraResultado(carrito) {
    $(".cuerpo").html(carrito);
}

