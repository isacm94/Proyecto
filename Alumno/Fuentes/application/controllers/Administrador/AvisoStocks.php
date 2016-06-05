<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN 
 */
class AvisoStocks extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_avisoStocks'); //Cargamos modelo
        $this->load->library('pagination');
        $this->load->config("paginacion");
        define("NUM_MAXIMO_STOCK", 50); //Número de productos(stocks) con el que saltará el aviso de un producto con bajo stock
    }

    public function index() {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        $num = $this->Mdl_avisoStocks->getCountStocksBajos(NUM_MAXIMO_STOCK);

        echo $num;
    }

    public function Ver($desde = 0) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        $config = $this->getConfigPag();
        $this->pagination->initialize($config);

        $productos = $this->Mdl_avisoStocks->getProductos(NUM_MAXIMO_STOCK, $desde, $config['per_page']);

        if (!$productos) {
            $rdo = "<div class='alert alert-warning'><i class='fa fa-bell-slash fa-lg' aria-hidden='true'></i> No existen productos con " . NUM_MAXIMO_STOCK . ' artículos o menos en stock</div>';
        } else {
            $rdo = "<div class='alert alert-info'><i class='fa fa-bell fa-lg' aria-hidden='true'></i> Existen " . $this->Mdl_avisoStocks->getCountStocksBajos(NUM_MAXIMO_STOCK) . " productos con " . NUM_MAXIMO_STOCK . " artículos o menos de stock</div>";
        }

        $cuerpo = $this->load->view('adm_avisostocks', array('productos' => $productos, 'rdo' => $rdo), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Avisos de stocks', "<i class='fa fa-bell fa-lg' aria-hidden='true'></i>" . ' Avisos de stocks');
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    private function getConfigPag() {
        $config['base_url'] = site_url('/Administrador/AvisoStocks/Ver');
        $config['total_rows'] = $this->Mdl_avisoStocks->getCountStocksBajos(NUM_MAXIMO_STOCK);
        $config['per_page'] = $this->config->item('per_page_productos');
        $config['uri_segment'] = 4;
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
