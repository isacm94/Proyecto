<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que muestra la lista de facturas
 */
class Facturas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_lista');
        $this->load->library('pagination');
        $this->load->config("paginacion");
    }

    public function index($desde = 0) {
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual

        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $config = $this->getConfigPag();
        $this->pagination->initialize($config);

        $facturas_pendientes = $this->Mdl_lista->getFacturasPendientes($desde, $config['per_page']);

        $cuerpo = $this->load->view('adm_listaFacturasPendientes', array('facturas_pendientes' => $facturas_pendientes), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Lista de Facturas Pendientes', "<i class='fa fa-list-alt fa-lg' aria-hidden='true'></i>" . ' Lista de Facturas');
    }
    
    

    

    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    private function getConfigPag() {
        $config['base_url'] = site_url('/Administrador/Lista/Facturas/index');
        $config['total_rows'] = $this->Mdl_lista->getNumFacturasPendientes();
        $config['per_page'] = $this->config->item('per_page_facturas');
        $config['uri_segment'] = 5;
        $config['num_links'] = 6;

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
