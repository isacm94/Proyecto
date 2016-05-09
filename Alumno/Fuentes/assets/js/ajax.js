var minutos = 1;
setInterval("getProductosStock()", getMilisegundos(minutos));

function getProductosStock() {
    //alert(site_url);
    var ruta = site_url +"/Administrador/AvisoStocks";
    $.post(ruta, MuestraResultado); //Pasamos a php ese array
}

function MuestraResultado(numProductos) {
    //alert("Número de productos: "+numProductos);
    if (numProductos == 0) {
        $("#iconoaviso").removeClass("fa-bell");//Quita el icono del aviso
        $("#iconoaviso").addClass("fa-bell-slash");//Y lo pone tachado
        $("#linkAvisos").attr("title", "No existen productos con bajo stocks");
    } else {
        $("#avisos").html(numProductos);//Muestra el nº de productos que tienen bajo stock
        $("#iconoaviso").removeClass("fa-bell-slash");//Quita el icono del aviso tachado
        $("#iconoaviso").addClass("fa-bell");//Pone icono del aviso
        $("#linkAvisos").attr("title", numProductos == 1 ?"Ver el producto con bajo stock" : "Ver los "+numProductos+" productos con bajo stock");
    }
}

function getMilisegundos(minutos) {
    return minutos * 60000;
}

