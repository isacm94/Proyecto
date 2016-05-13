<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR 
 */
class Carrito extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_tienda'); //Cargamos modelo
        $this->session->set_userdata(array('pagina-actual-venta' => current_url())); //Guardamos la URL actual
    }

    public function index() {
        if (! SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }   
        
        $cuerpo = $this->load->view('ven_carrito', array('' => ''), true); //Generamos la vista         
        CargaPlantillaVenta($cuerpo, '', ' | Carrito', 'Carrito');
    }

}
