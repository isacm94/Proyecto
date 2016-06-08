<?php
/**
 * HELPER DEL MÓDULO DE VENTA funciones necesarias para tener varias plantillas
 */

/**
 * Muestra la plantilla establecida
 * @param String $cuerpo Cuerpo que llevará la plantilla
 * @param String $active Item del menú activo, para resaltarlo
 * @param String $title Título en el navegador
 * @param String $titulo Título en el cuerpo
 * @param String $descripcion Descripción en el cuerpo
 */
function CargaPlantillaVenta($cuerpo, $active = 'activehome', $title = " - Venta", $titulo = "", $descripcion = "") {
    $CI = get_instance();

    $CI->load->model('Mdl_templates');
    $template_activa = $CI->Mdl_templates->getTemplateActivaVenta(); //Guardamos la template activa

    $CI->load->view('templates/'.$template_activa, Array('cuerpo' => $cuerpo, 'active' => $active, 'title' => $title, 'titulo' => $titulo, 'descripcion' => $descripcion,
        'linksHeadVenta' => getLinksHeadVenta(), 'linksJS' => getLinkScriptsJS(),
        'linksMenuCategorias' => getLinksMenuCategorias(), 'linksUsuarios' => getLinksUsuarios(),
        'linkCarrito' => getLinkCarrito()));
}

/**
 * Devuelve todos los links que necesita las plantillas en el <head>(CSS, favicon, ...)
 * @return string Links/URLs
 */
function getLinksHeadVenta() {
    $links = '<link rel="stylesheet" href="' .CSS_PATH.'estilos.css">';
    $links.= '<link rel="stylesheet" href="' .CSS_PATH.'panel.css">';
    $links.= '<link rel="stylesheet" href="' .CSS_PATH.'detalle.css">';
    $links.= '<link rel="stylesheet" href="' .CSS_PATH.'tienda.css">';
    $links.= '<link rel="stylesheet" href="' .CSS_PATH.'carrito.css">';
    $links.= '<link rel="shortcut icon" type="image/x-icon" href="' . IMAGES_PATH . 'favicon.png">';
    $links.= '<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />';

    return $links;
}

/**
 * Devuelve todos los links de JavaScript
 * @return string Links/URLs
 */
function getLinkScriptsJS() {
    //$links = '<script src="http://code.jquery.com/jquery-1.7.js"></script>';
    $links.= '<script type="text/javascript">var site_url = "' . site_url() . '"</script>'; //Definimos el site_url en javascript
    $links.= '<script src="' . JS_PATH.'ajax_paginacion.js' . '"></script>';
    $links.= '<script src="' . JS_PATH.'ajax_carrito.js' . '"></script>';
    $links.= '<script src="' . JS_PATH.'jquery-2.2.3.min.js' . '"></script>';
    $links.= '<script src="' . JS_PATH.'flecha-top.js' . '"></script>';
    $links.="<script>
                var altura_ventana = $(window).outerHeight(true);
                var altura_cabecera = $('.cabecera').outerHeight(true);
                var altura_pie = $('.pie').outerHeight(true);

                var altura_cuerpo = altura_ventana - altura_cabecera - altura_pie;//Calculamos la altura quitandole la cabecera y el pie

                $('.cuerpo').css('min-height', altura_cuerpo + 'px');//Establecemos el mínimo de altura
            
        </script>";

    return $links;
}

/**
 * Devuelve los links generados para el menú de ver productos por categorías
 * @return string Links/URLs
 */
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


/**
 * Devuelve los links relacionados con la sesión del usuario(Perfil y Cerrar Sesión)
 * @return string Links/URLs
 */
function getLinksUsuarios() {

    $links = '<a href="' . site_url("/Login/Logout") . '" class="link_vtemp2"><i class="fa fa-sign-out"></i> Cerrar Sesión</a>';
    $links.= '&nbsp;&nbsp;<a href="' . site_url('/Perfil') . '" class="link_vtemp2"><i class="fa fa-user"></i> Perfil</a>';
    return $links;
}

/**
 * Devuelve el link del carrito, donde también se muestra el nº de artículos comprados y el importe total de ellos
 * @return string
 */
function getLinkCarrito() {
    $CI = get_instance();
    $link = '<a href="' . site_url('/Carrito') . '" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="label label-carrito">'
            . '<span id="articulos_total">' . $CI->myCarrito->articulos_total() . '</span> - <span id="precio_total">' . round($CI->myCarrito->precio_total(), 2) . '€</span>'
            . '</span></a>';
    return $link;
}
