<?php
/*
 * HELPER que contiene una función que nos dice si se ha iniciado sesión o no.
 */

/**
 * Función que devuelve si se ha iniciado sesión en la aplicación y es administrador.
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
 * Función que devuelve si se ha iniciado sesión en la aplicación.
 * @return boolean
 */
function SesionIniciadaCheck() {

    $CI = get_instance();
    if ($CI->session->userdata('username')) {
        return TRUE;
    } else {
        return FALSE;
    }
}
