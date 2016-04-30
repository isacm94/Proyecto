<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que muestra la vista principal
 */
class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
    }

    /**
     * Muestra la vista principal
     * @return type
     */
    public function index() {
        if (! SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        
        $cuerpo = $this->load->view('adm_index', '', true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo);
    }

}
