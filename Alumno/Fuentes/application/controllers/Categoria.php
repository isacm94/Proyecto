<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR 
 */
class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_tienda'); //Cargamos modelo
        $this->load->library('pagination');
        $this->load->config("paginacion");
         $this->session->set_userdata(array('pagina-actual-venta' => current_url())); //Guardamos la URL actual
    }

    public function index($idCategoria) {
        $this->session->set_userdata(array('idCategoria' => $idCategoria));//Guardamos la categoría a mostrar en la sesión, para poder paginar con ajax
        
        $config = $this->getConfigPag();
        $this->pagination->initialize($config);
                     
        $desde = 0;
        $productos = $this->Mdl_tienda->getProductosFromCategoria($idCategoria, $desde, $config['per_page']);
         if (! $productos) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Error404', 'location', 301);
            return; //Sale de la función
        }
        
        $nombre = $this->Mdl_tienda->getNombreCategoria($idCategoria);
        
        $cuerpo = $this->load->view('ven_categoria', array('productos' => $productos), true); //Generamos la vista         
        CargaPlantillaVenta($cuerpo, 'activecategorias', ' | Categorías', $nombre);
    }

    public function lista($desde = 0) {     
        
        $config = $this->getConfigPag();
        $this->pagination->initialize($config);
        
        $idCategoria = $this->session->userdata('idCategoria');//Cogemos de la sesión el id de la categoría a mostrar
        
        $productos = $this->Mdl_tienda->getProductosFromCategoria($idCategoria, $desde, $config['per_page']);
        
        $this->load->view('ven_categoria', array('productos' => $productos)); //Generamos la vista 
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    private function getConfigPag() {
        $idCategoria = $this->session->userdata('idCategoria');//Cogemos de la sesión el id de la categoría a mostrar
        
        $config['base_url'] = site_url('/Categoria/lista/');
        $config['total_rows'] = $this->Mdl_tienda->getNumProductosFromCategoria($idCategoria);
        $config['per_page'] = $this->config->item('per_page_categorias_venta');
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
