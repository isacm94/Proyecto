<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR 
 */
class Main extends CI_Controller {
    
    public function __construct() {
        parent::__construct();    
        $this->load->model('Mdl_home'); //Cargamos modelo
    }
    /**
     * Muestra la vista del error404
     */
    public function index() {
        $this->session->set_userdata(array('pagina-actual'  => current_url())); //Guardamos la URL actual
        
        if (! SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }
        $imagenes = $this->Mdl_home->getImagenes();
        
        $cuerpo = $this->load->view('ven_index', array('imagenes' => $imagenes), true); //Generamos la vista 
        CargaPlantillaVenta($cuerpo, ' | Home');
    }
}
