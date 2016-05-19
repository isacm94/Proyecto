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

    /**
     * Muestra las facturas pendientes
     */
    public function index() {
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual

        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $facturas_pendientes = $this->Mdl_lista->getFacturasPendientes();
        $facturas_pagadas = $this->Mdl_lista->getFacturasPagadas();

        $cuerpo = $this->load->view('adm_listaFacturas', array('facturas_pendientes' => $facturas_pendientes, 'facturas_pagadas' => $facturas_pagadas), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Lista de Facturas', "<i class='fa fa-list-alt fa-lg' aria-hidden='true'></i>" . ' Lista de Facturas');
    }
    
    
}
