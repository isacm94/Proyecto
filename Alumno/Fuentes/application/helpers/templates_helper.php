<?php

function CargaPlantilla($cuerpo, $titulo = "", $descripcion = "") {
    $CI = get_instance();
    
    if(! $CI->session->userdata('template_activa')){
        $CI->session->set_userdata(array('template_activa'  => 'template1'));        
    }
    
    $template_activa = $CI->session->userdata('template_activa');
    
    $CI->load->view($template_activa, Array('cuerpo' => $cuerpo, 'titulo' => $titulo, 'descripcion' => $descripcion));
    
    }