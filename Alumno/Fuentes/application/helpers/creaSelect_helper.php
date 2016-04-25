<?php
/**
 * HELPER funciones que crean el código html correspondiente a un select
 */


function CreaSelect($datos, $name, $texto_defecto) {

    $datos = CreaArrayParaSelect($datos, $name);
    $html = '<select class="form-control" name="' . $name . '">';

    $html.= "<option value='defecto'>$texto_defecto</option>";
    
    foreach ($datos as $idx => $texto) {
        $html.= "<option value='$idx' " . set_select($name, $idx) . ">$texto</option>";
    }

    $html.= '</select>';

    return $html;
}

function CreaArrayParaSelect($array, $nombre_elemento) {
    $nuevoArray = array();

    foreach ($array as $key => $value) {
        $nuevoArray[$value['id'.$nombre_elemento]] = $value['nombre'];
    }

    return $nuevoArray;
}

/**
 * Función que devuelve una lista desplegable/select.
 * @param array $datos Los datos que va a contener la lista desplegable.
 * @param string $name El nombre del select.
 * @return string Código html generado.
 */
function CreaSelectProvincias($datos, $name) {

    $datos = CreaArrayParaSelectProvincias($datos);
    $html = '<select class="form-control" name="' . $name . '">';

    foreach ($datos as $idx => $texto) {
        $html.= "<option value='$idx' " . set_select($name, $idx) . " >$texto</option>";
    }

    $html.= '</select>';

    return $html;
}


/**
 * Función que devuelve un array correcto para formar una lista desplegable.
 * @param array $array
 * @return array Array correcto.
 */
function CreaArrayParaSelectProvincias($array) {
    $nuevoArray = array();

    foreach ($array as $key => $value) {
        $nuevoArray[$value['idProvincia']] = $value['nombre'];
    }

    return $nuevoArray;
}
