//Paginación de la página home del módulo del producto
$(document).ready(function () {
    $("#contenedor").load("/Main/lista");
    $(document).on("click", "#paginacion-home li a", function (e) {
        e.preventDefault();
        var href = $(this).attr("href");
        $("#contenedor").load(href);
    });
});
       