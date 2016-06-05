
$(document).ready(function () {
    //Paginación de la página home del módulo del producto
    $("#contenedor-home").load(site_url+"/Main/lista");
    $(document).on("click", "#paginacion-home li a", function (e) {
        e.preventDefault();
        var href = $(this).attr("href");//Coge la url de #paginacion-home li a y la carga en el div
        $(".cuerpo-paginacion").load(href);//Lo carga en el cuerpo de la plantilla
        
        
    });
    
    //Paginación de la página categorias del módulo del producto
    $("#contenedor-categoria").load(site_url+"/Categoria/lista");
    $(document).on("click", "#paginacion-categorias li a", function (e) {
        e.preventDefault();
        var href = $(this).attr("href");//Coge la url de #paginacion-home li a y la carga en el div
        $(".cuerpo-paginacion").load(href);//Lo carga en el cuerpo de la plantilla
    });
});
       