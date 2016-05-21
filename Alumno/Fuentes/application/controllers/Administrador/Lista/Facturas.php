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
    public function index($idfacturapagada = '') {
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual

        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $mensajePagada='';
        if (! EMPTY($idfacturapagada)) {
            $info_factura = $this->Mdl_lista->getInfoFactura($idfacturapagada);
            $mensajePagada = "<div class='alert alert-success'>Se ha marcado como pagada la factura <i>Nº " . $info_factura['numfactura'] . "</i> de <i>".$info_factura['nombre_cliente']."</i> con fecha <i>" . $info_factura['fecha_factura'] . "</i></div>";
        }

        $facturas_pendientes = $this->Mdl_lista->getFacturasPendientes();
        $facturas_pagadas = $this->Mdl_lista->getFacturasPagadas();

        $cuerpo = $this->load->view('adm_listaFacturas', array('facturas_pendientes' => $facturas_pendientes, 'facturas_pagadas' => $facturas_pagadas, 'mensajePagada' => $mensajePagada), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Lista de Facturas', "<i class='fa fa-list-alt fa-lg' aria-hidden='true'></i>" . ' Lista de Facturas');
    }

    public function Pagar($idFactura) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->Mdl_lista->setFacturaPagada($idFactura);

        redirect(site_url('/Administrador/Lista/Facturas/index/'.$idFactura), 'Location', 301);
    }

}
