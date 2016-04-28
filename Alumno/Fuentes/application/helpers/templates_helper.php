<?php

function CargaPlantillaAdmin($cuerpo, $title = "", $titulo = "", $descripcion = "") {
    $CI = get_instance();

    if (!$CI->session->userdata('template-adm-activa')) {//Si no esta definida ninguna template, definimos la primera
        $CI->session->set_userdata(array('template-adm-activa' => 'adm_template1'));
    }

    $template_activa = $CI->session->userdata('template-adm-activa');//Guardamos la template activa

    $CI->load->view($template_activa, Array('cuerpo' => $cuerpo, 'title'=> $title, 'titulo' => $titulo, 'descripcion' => $descripcion, 
            'linksConfigPlantillas'=>getLinksConfigPlantillas(), 'linksHead'=> getLinksHead(), 'linksUsuario' => getLinksUsuario(),
            'linksMenuAgregar'=> getLinksMenuAgregar()));
}

function getLinksConfigPlantillas(){
    $links = "<a href='".base_url() . "ConfigPlantillas' style='text-decoration: none;'><i class='fa fa-paint-brush' aria-hidden='true'></i> Plantillas</a>";
    
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
    $links['CerrarSesion']= site_url()."Administrador/Login/Logout";
    
    $links['username'] = $CI->session->userdata('username');
    $links['nombre'] = $CI->session->userdata('nombre');     
    
    $links['Perfil'] = site_url().'Administrador/Perfil';
    return $links;
}

function getLinksMenuAgregar(){
    
    $links['Proveedor'] = "<a href='".  base_url().'Administrador/Agregar/Proveedor'."'><i class='fa fa-truck' aria-hidden='true'></i>Proveedor</a>";
    $links['Categoria'] = "<a href='".  base_url().'Administrador/Agregar/Categoria'."'><i class='fa fa-folder-open' aria-hidden='true'></i>Categoría</a>";
    $links['Producto'] = "<a href='".  base_url().'Administrador/Agregar/Producto'."'><i class='fa fa-dropbox' aria-hidden='true'></i>Producto</a>";
    $links['Cliente'] = "<a href='".  base_url().'Administrador/Agregar/Cliente'."'><i class='fa fa-users' aria-hidden='true'></i>Cliente</a>";
    $links['Usuario'] = "<a href='".  base_url().'Administrador/Agregar/Usuario'."'><i class='fa fa-user' aria-hidden='true'></i>Usuario</a>";
    
    return $links;
}