<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
    }

    public function index() {
        if (! SesionIniciadaCheck()) {
           //print_r($_SESSION);
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        
        $cuerpo = $this->load->view('adm_index', '', true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo);
    }

}
