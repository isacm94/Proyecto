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
        $this->session->set_userdata(array('template_activa'  => $template)); 
        
        redirect($this->session->userdata('pagina-actual'), 'location', 301);//Vuelve a la página en la que estaba
    }
    
    
    
}
