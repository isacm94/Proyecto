<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR 
 */
class Producto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_tienda'); //Cargamos modelo
        $this->session->set_userdata(array('pagina-actual-venta' => current_url())); //Guardamos la URL actual
        $this->load->library('myCarrito');
    }

    public function ver($id) {
        if (! SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }        
        
        $producto = $this->Mdl_tienda->getProducto($id);
        if (! $producto) {//Si no devuelve nada la consulta, mostramos error 404
            redirect('/Error404', 'location', 301);
            return; //Sale de la función
        }
        
        $cuerpo = $this->load->view('ven_producto', array('producto' => $producto), true); //Generamos la vista         
        CargaPlantillaVenta($cuerpo, 'activehome', ' | '.$producto['nombre'], $producto['nombre']);
    }
}
