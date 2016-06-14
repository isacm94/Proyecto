/*DOCUMENTO JAVASCRIPT funciones utilizadas para mostrar los avisos de productos con bajo stock */

var minutos = 1;
setInterval("getProductosStock()", getMilisegundos(minutos));//Actualiza el aviso del stock cada n "minutos"

/**
 * Función que lanza la petición ajax al servidor del número de productos con bajo stock
 */
function getProductosStock() {
    var ruta = site_url +"/Administrador/AvisoStocks";
    $.post(ruta, MuestraResultado); //Pasamos a php ese array
}

/**
 * Función que actualiza el resultado de la petición ajax
 * @param Int numProductos Número de productos que tienen stock bajo
 */
function MuestraResultado(numProductos) {
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

/**
 * Función que convierte los minutos a milisegundos
 * @param Int minutos Número de minutos a convertir
 * @returns Int Milisegundos
 */
function getMilisegundos(minutos) {
    return minutos * 60000;
}

