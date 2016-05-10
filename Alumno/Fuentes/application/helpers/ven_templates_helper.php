<?php

function CargaPlantillaVenta($cuerpo, $title = " - Venta", $titulo = "", $descripcion = "") {
    $CI = get_instance();

    if (!$CI->session->userdata('template-ven-activa')) {//Si no esta definida ninguna template, definimos la primera
        $CI->session->set_userdata(array('template-ven-activa' => 'ven_template1'));
    }

    $template_activa = $CI->session->userdata('template-ven-activa'); //Guardamos la template activa

    $CI->load->view($template_activa, Array('cuerpo' => $cuerpo, 'title' => $title, 'titulo' => $titulo, 'descripcion' => $descripcion,
        'linksHeadVenta' => getLinksHeadVenta()));
}

/**
 * Devuelve toos los links que necesita la plantillas. CSS, imágenes, ...
 * @return string Links/URLs
 */
function getLinksHeadVenta() {
    $links = '<link rel="stylesheet" href="' . base_url() . 'assets/css/estilos.css">';
    $links.= '<link rel="stylesheet" href="' . base_url() . 'assets/css/panel.css">';
    $links.= '<link rel="stylesheet" href="' . base_url() . 'assets/css/detalle.css">';
    $links.= '<link rel="shortcut icon" type="image/x-icon" href="' . base_url() . 'assets/images/favicon.png">';

    return $links;
}