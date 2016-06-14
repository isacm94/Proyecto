/*DOCUMENTO JAVASCRIPT que al checkear muestra o quita el formulario de elegir imagen  en 'Modificar producto' */

$('#toggle-imagen').click(function () {//Click en el toggle
    if ($('#toggle-imagen').prop('checked')) {
        $("#selecccionarimagen").show();
    } else {
        $("#selecccionarimagen").hide();
    }
});

