<?php

function CargaPlantillaVenta($cuerpo, $active = 'activehome', $title = " - Venta", $titulo = "", $descripcion = "") {
    $CI = get_instance();

    $CI->load->model('Mdl_templates');
    
    $template_activa = $CI->Mdl_templates->getTemplateActivaVenta();//Guardamos la template activa

    $CI->load->view($template_activa, Array('cuerpo' => $cuerpo, 'active' => $active, 'title' => $title, 'titulo' => $titulo, 'descripcion' => $descripcion,
        'linksHeadVenta' => getLinksHeadVenta(), 'linksJS' => getLinkScriptsJS(),
        'linksMenuCategorias' => getLinksMenuCategorias(), 'linksUsuarios'=> getLinksUsuarios(),
        'linkCarrito'=>getLinkCarrito()));
}

/**
 * Devuelve toos los links que necesita la plantillas. CSS, imágenes, ...
 * @return string Links/URLs
 */
function getLinksHeadVenta() {
    $links = '<link rel="stylesheet" href="' . base_url() . 'assets/css/estilos.css">';
    $links.= '<link rel="stylesheet" href="' . base_url() . 'assets/css/panel.css">';
    $links.= '<link rel="stylesheet" href="' . base_url() . 'assets/css/detalle.css">';
    $links.= '<link rel="stylesheet" href="' . base_url() . 'assets/css/tienda.css">';
    $links.= '<link rel="stylesheet" href="' . base_url() . 'assets/css/carrito.css">';
    $links.= '<link rel="shortcut icon" type="image/x-icon" href="' . base_url() . 'assets/images/favicon.png">';
    $links.= '<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />';

    return $links;
}

function getLinkScriptsJS() {
    $links = '<script src="http://code.jquery.com/jquery-1.7.js"></script>';
    $links.= '<script type="text/javascript">var site_url = "' . site_url(). '"</script>'; //Definimos el site_url en javascript
    $links.= '<script src="' . base_url() . 'assets/js/ajax_paginacion.js' . '"></script>';
    $links.= '<script src="' . base_url() . 'assets/js/ajax_carrito.js' . '"></script>';
    $links.= '<script src="' . base_url() . 'assets/js/jquery-2.2.3.min.js' . '"></script>';
    return $links;
}

function getLinksMenuCategorias() {
    $CI = get_instance();

    $CI->load->model('Mdl_tienda');
    $categorias = $CI->Mdl_tienda->getCategorias();

    $links = "";

    foreach ($categorias as $value) {
        $links.= '<li><a href="' . site_url('/Categoria/index/' . $value['id']) . '">' . $value['nombre'] . '</a></li>';
    }

    return $links;
}

function getLinksUsuarios() {

    $links = '<a href="'.site_url("/Login/Logout").'"><i class="fa fa-sign-out"></i> Cerrar Sesión</a>';
    $links.= '&nbsp;&nbsp;<a href="'.site_url('/Perfil').'" class="link_vtemp2"><i class="fa fa-user"></i> Perfil</a>';
    return $links;
}


function getLinkCarrito(){
    $CI = get_instance();
    $link ='<a href="'.site_url('/Carrito').'" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="label label-carrito">'
            . '<span id="articulos_total">'.$CI->myCarrito->articulos_total().'</span> - <span id="precio_total">'.round($CI->myCarrito->precio_total(), 2).' €</span>'
            . '</span></a>';
    return $link;
}