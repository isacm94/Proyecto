<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR 
 */
class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_home'); //Cargamos modelo
        $this->load->library('pagination');
        $this->load->config("paginacion");
        $this->session->set_userdata(array('pagina-actual-venta' => current_url())); //Guardamos la URL actual
    }

    public function index($desde = 0) {
        if (! SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }
        $config = $this->getConfigPag();
        $this->pagination->initialize($config);
        
        $productos = $this->Mdl_home->getProductos($desde, $config['per_page']);
        if (! $productos) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Error404', 'location', 301);
            return; //Sale de la función
        }
        
        $cuerpo = $this->load->view('ven_index', array('productos' => $productos), true); //Generamos la vista 
        
        CargaPlantillaVenta($cuerpo, 'activehome', ' | Home', 'Todos los productos');
    }

    public function lista($desde = 0) {     
        
        $config = $this->getConfigPag();
        $this->pagination->initialize($config);
        
        $productos = $this->Mdl_home->getProductos($desde, $config['per_page']);
        
        $this->load->view('ven_index', array('productos' => $productos)); //Generamos la vista 
        //CargaPlantillaVenta($cuerpo, ' | Home');
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    private function getConfigPag() {
        $config['base_url'] = site_url('/Main/lista/');
        $config['total_rows'] = $this->Mdl_home->getNumProductos();
        $config['per_page'] = $this->config->item('per_page_home');
        $config['uri_segment'] = '3';
        //$config['num_links'] = 6;

        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '<span></span></span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
        $config['last_link'] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
        $config['next_link'] = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        return $config;
    }

}
