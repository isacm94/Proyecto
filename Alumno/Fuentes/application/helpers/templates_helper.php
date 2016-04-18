<?php

function CargaPlantilla($cuerpo, $title = "", $titulo = "", $descripcion = "") {
    $CI = get_instance();

    if (!$CI->session->userdata('template_activa')) {
        $CI->session->set_userdata(array('template_activa' => 'template1'));
    }

    $template_activa = $CI->session->userdata('template_activa');

    $CI->load->view($template_activa, Array('cuerpo' => $cuerpo, 'title'=> $title, 'titulo' => $titulo, 'descripcion' => $descripcion, 
            'linksPlantillas'=>getLinksCambioPlantillas(), 'linksHead'=> getLinksHead(), 'linksUsuario' => getLinksUsuario()));
}

function getLinksCambioPlantillas(){
    $links['Template 1 - AdminLTE 2'] = site_url() . '/CambioPlantilla/index/template1';
    $links['Template 2 - Gentellela Alela'] = site_url() . '/CambioPlantilla/index/template2';
    
    return $links;
}

function getLinksHead(){
    $links = '<link rel="stylesheet" href="'.base_url() . 'assets/css/estilos.css">';
    $links.= '<link rel="stylesheet" href="'.base_url() . 'assets/css/panel.css">';
    $links.= '<link rel="stylesheet" href="'.base_url() . 'assets/css/detalle.css">';
    $links.= '<link rel="shortcut icon" type="image/x-icon" href="'. base_url() . 'assets/favicon.png">';
    
    return $links;
}
function getLinksUsuario(){
    $CI = get_instance();
    $links['CerrarSesion']= site_url()."/Login/Logout";
    
    $links['username'] = $CI->session->userdata('username');
    $links['nombre'] = $CI->session->userdata('nombre');     
    
    $links['Perfil'] = site_url().'/Perfil';
    return $links;
}
