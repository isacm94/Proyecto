<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR 
 */
class Venta extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_venta'); //Cargamos modelo       
        $this->load->library('Carro', 0, 'myCarrito');
         $this->session->set_userdata(array('pagina-actual-venta' => current_url())); //Guardamos la URL actual
    }

    public function index() {
        
        if (!SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }
        
        $minoristas = $this->Mdl_venta->getMinoristas();
        $mayoristas = $this->Mdl_venta->getMayoristas();
    
        $cuerpo = $this->load->view('ven_venta1', array('minoristas' => $minoristas, 'mayoristas' => $mayoristas), true); //Generamos la vista         
        CargaPlantillaVenta($cuerpo, '', ' | Venta', 'Proceso de Venta');
    }

}
