

$('#toggle-imagen').click(function () {//Click en el toggle
    if ($('#toggle-imagen').prop('checked')) {
        $("#selecccionarimagen").show();
    } else {
        $("#selecccionarimagen").hide();
    }
});

