<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class Main extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
//        $this->load->helper('descuentos_helper');       
//        $this->load->library('pagination');
//        $this->load->model('Mdl_seleccionadas'); //Cargamos modelo
//        $this->load->library('Carro', 0, 'myCarrito');
    }
    
    public function index() {   
      $this->session->set_userdata(array('pagina-actual'  => current_url())); 
      
       $cuerpo = $this->load->view('View_index', '', true); //Generamos la vista 
       CargaPlantilla($cuerpo);
       
    }
    
    
    
}
