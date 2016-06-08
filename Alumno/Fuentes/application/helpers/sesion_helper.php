<?php
/*
 * HELPER que contiene funciones que nos dice si se ha iniciado sesión o no
 */

/**
 * Función que devuelve si se ha iniciado sesión en el módulo de administración y es administrador.
 * @return boolean
 */
function SesionIniciadaCheckAdmin() {

    $CI = get_instance();
    if ($CI->session->userdata('username') && $CI->session->userdata('tipo')=='Administrador') {
        return TRUE;
    } else {
        return FALSE;
    }
}

/**
 * Función que devuelve si se ha iniciado sesión en el módulo de venta
 * @return boolean
 */
function SesionIniciadaCheckVen() {

    $CI = get_instance();
    if ($CI->session->userdata('username_ven')) {
        return TRUE;
    } else {
        return FALSE;
    }
}
