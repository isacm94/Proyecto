<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class CambioPlantilla extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($template = 'template1') {
        if ($template == 'template1' || $template == 'template2') {
            $this->session->set_userdata(array('template_activa' => $template)); //Guarda en la sesión la plantilla usada

            redirect($this->session->userdata('pagina-actual'), 'location', 301); //Vuelve a la página en la que estaba
        } else {
            redirect('Error404', 'location', 301);
        }
    }

}
