<?php

/**
 * HELPER funciones necesarias para tener varias plantillas
 */

/**
 * Muestra la plantilla establecida
 * @param String $cuerpo Cuerpo que llevará la plantilla
 * @param String $title Título en el navegador
 * @param String $titulo Título en el cuerpo
 * @param String $descripcion Descripción en el cuerpo
 */
function CargaPlantillaAdmin($cuerpo, $title = "", $titulo = "", $descripcion = "") {
    $CI = get_instance();

    $CI->load->model('Mdl_templates');
    
    $template_activa = $CI->Mdl_templates->getTemplateActivaAdmin();//Guardamos la template activa
    
    $CI->load->view($template_activa, Array('cuerpo' => $cuerpo, 'title' => $title, 'titulo' => $titulo, 'descripcion' => $descripcion,
        'linksConfigPlantillas' => getLinksConfigPlantillas(), 'linksHead' => getLinksHead(), 'linksUsuario' => getLinksUsuario(),
        'linksMenuAgregar' => getLinksMenuAgregar(), 'linksMenuLista' => getLinksMenuLista(), 'linksJS' => getLinksJS(),
        'linkAvisos' => getLinkAvisos(), 'linkVenta'=>getLinkVenta()));
}

/**
 * Devuelve el link que lleva a la configuración de las plantillas
 * @return string URL/Link
 */
function getLinksConfigPlantillas() {
    $links = "<a href='" . site_url("/Administrador/ConfigPlantillas") . "' style='text-decoration: none;'><i class='fa fa-paint-brush' aria-hidden='true'></i> <span>Plantillas</span></a>";

    return $links;
}

/**
 * Devuelve toos los links que necesita la plantillas. CSS, imágenes, ...
 * @return string Links/URLs
 */
function getLinksHead() {
    $links = '<link rel="stylesheet" href="' . base_url() . 'assets/css/estilos.css">';
    $links.= '<link rel="stylesheet" href="' . base_url() . 'assets/css/panel.css">';
    $links.= '<link rel="stylesheet" href="' . base_url() . 'assets/css/detalle.css">';
    $links.= '<link rel="shortcut icon" type="image/x-icon" href="' . base_url() . 'assets/images/favicon.png">';
    $links.= '<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">';//Boostrap datable

    return $links;
}

/**
 * Devuelve toos los links de JavaScript
 * @return string Links/URLs
 */
function getLinksJS() {

    $links = '<script src="' . base_url() . 'assets/js/toggle.js"></script>';
    $links.= '<script src="' . base_url() . 'assets/js/ajax_avisos.js"></script>';
    $links.= '<script type="text/javascript">var site_url = "' . site_url() . '"</script>'; //Definimos el site_url en javascript
    $links.= '<script>getProductosStock()</script>';
    $links.='<script src="' . base_url() . 'assets/js/jquery.dataTables.min.js"></script>';
    $links.='<script src="' . base_url() . 'assets/js/dataTables.bootstrap.min.js"></script>';
    $links.="<script>
                $(document).ready(function () {
                    $('#tabla_pendientes').DataTable();
                    $('#tabla_pendientes_length').hide();
                });
            </script>";//Tabla de facturas pendientes
    
    $links.="<script>
                $(document).ready(function () {
                    $('#tabla_pagadas').DataTable();
                    $('#tabla_pagadas_length').hide();
                });
            </script>";//Tabla de facturas pagadas
    return $links;
}

function getLinkAvisos() {
    $link = '<a href="' . site_url('/Administrador/AvisoStocks/Ver') . '" title="" id="linkAvisos" style="text-decoration: none;">
                <i class="fa fa-bell" id="iconoaviso"></i>
                <span class="label label-warning" id="avisos"></span>
            </a>';
    return $link;
}

/**
 * Devuelve los links y los datos relacionados con el usuario. Nombre de usuario, nombre, link 'Perfil', link 'Cerrar Sesión'
 * @return string Links/URLs
 */
function getLinksUsuario() {
    $CI = get_instance();
    $links['CerrarSesion'] = site_url('/Administrador/Login/Logout');

    $links['username'] = $CI->session->userdata('username');
    $links['nombre'] = $CI->session->userdata('nombre');

    $links['Perfil'] = site_url('/Administrador/Perfil');
    return $links;
}

/**
 * Devuelve todos los links del menú agregar
 * @return string Links/URLs
 */
function getLinksMenuAgregar() {

    $links['Proveedor'] = "<a href='" . site_url('/Administrador/Agregar/Proveedor') . "'><i class='fa fa-truck' aria-hidden='true'></i>Proveedor</a>";
    $links['Categoría'] = "<a href='" . site_url('/Administrador/Agregar/Categoria') . "'><i class='fa fa-folder-open' aria-hidden='true'></i>Categoría</a>";
    $links['Producto'] = "<a href='" . site_url('/Administrador/Agregar/Producto') . "'><i class='fa fa-dropbox' aria-hidden='true'></i>Producto</a>";
    $links['Cliente'] = "<a href='" . site_url('/Administrador/Agregar/Cliente') . "'><i class='fa fa-users' aria-hidden='true'></i>Cliente</a>";
    $links['Usuario'] = "<a href='" . site_url('/Administrador/Agregar/Usuario') . "'><i class='fa fa-user' aria-hidden='true'></i>Usuario</a>";

    return $links;
}

/**
 * Devuelve todos los links del menú listar
 * @return string Links/URLs
 */
function getLinksMenuLista() {

    $links['Proveedor'] = "<a href='" . site_url('/Administrador/Lista/Proveedores') . "'><i class='fa fa-truck' aria-hidden='true'></i>Proveedores</a>";
    $links['Categoria'] = "<a href='" . site_url('/Administrador/Lista/Categorias') . "'><i class='fa fa-folder-open' aria-hidden='true'></i>Categorías</a>";
    $links['Producto'] = "<a href='" . site_url('/Administrador/Lista/Productos') . "'><i class='fa fa-dropbox' aria-hidden='true'></i>Productos</a>";
    $links['Cliente'] = "<a href='" . site_url('/Administrador/Lista/Clientes') . "'><i class='fa fa-users' aria-hidden='true'></i>Clientes</a>";
    $links['Usuario'] = "<a href='" . site_url('/Administrador/Lista/Usuarios') . "'><i class='fa fa-user' aria-hidden='true'></i>Usuarios</a>";
    $links['Factura'] = "<a href='" . site_url('/Administrador/Lista/Facturas') . "'><i class='fa fa-list-alt' aria-hidden='true'></i>Facturas</a>";
    return $links;
}

function getLinkVenta(){
    $link= "<a href='" . site_url() . "' title='Ir al modelo de venta'><i class='fa fa-share-square' aria-hidden='true'></i></a>";
    return $link;
}
