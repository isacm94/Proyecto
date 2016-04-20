<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class CambioPlantilla extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($template = 'adm_template1') {
        if ($template == 'adm_template1' || $template == 'adm_template2') {//Sí se pasa una template existente
            $this->session->set_userdata(array('template-adm-activa' => $template)); //Guarda en la sesión la plantilla usada

            redirect($this->session->userdata('pagina-actual'), 'location', 301); //Vuelve a la página en la que estaba
        } else {
            redirect('Error404', 'location', 301);
        }
    }

}
