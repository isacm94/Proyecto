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

        $mensajePagada = '';
        if (!EMPTY($idfacturapagada)) {
            $info_factura = $this->Mdl_lista->getInfoFactura($idfacturapagada);
            $mensajePagada = "<div class='alert alert-success'>Se ha marcado como pagada la factura <i>Nº " . $info_factura['numfactura'] . "</i> de <i>" . $info_factura['nombre_cliente'] . "</i> con fecha <i>" . $info_factura['fecha_factura'] . "</i></div>";
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

        redirect(site_url('/Administrador/Lista/Facturas/index/' . $idFactura), 'Location', 301);
    }

    public function Descuento($idFactura) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        if ($this->Mdl_lista->getPendientePago($idFactura) == 'No') {//Si la factura NO esta pediente de pago, no podemos cambiarle el descuento
            redirect('/Error404', 'location', 301);
            return; //Sale de la función
        }

        $info_factura = $this->Mdl_lista->getInfoFactura($idFactura);

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser númerico');
        $this->form_validation->set_message('less_than', 'El campo %s no puede ser mayor que 90');

        $this->form_validation->set_rules('descuento', 'descuento', 'required|numeric|less_than[91]');
        
         $mensajeok = '';
        if ($this->form_validation->run()) {
            $this->ActualizarFactura($idFactura, $this->input->post('descuento'));
            $info_factura['descuento'] = $this->input->post('descuento'); //Guardamos el valor introducido para mostrarlo
            $mensajeok = "<div class='alert alert-success'>Se ha cambiado correctamente el descuento <a href='".  site_url('/Administrador/Lista/Facturas')."'>Volver a la lista</a></div>";
        } else if($this->input->post()){
            $info_factura['descuento'] = $this->input->post('descuento'); //Guardamos el valor introducido para mostrarlo
           
        }

        $cuerpo = $this->load->view('adm_cambiarDescuento', array('info_factura' => $info_factura, 'mensajeok' => $mensajeok), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Cambiar descuento de factura', "<i class='fa fa-list-alt fa-lg' aria-hidden='true'></i> Cambiar descuento de factura");
    }
    
    private function ActualizarFactura($idFactura, $descuento){
        $factura_ant  = $this->Mdl_lista->getFactura($idFactura);//Guardamos los datos de la factura
        
        $factura = array(
            'base_imponible' => $factura_ant['importe_bruto'] - (1-($descuento/100)),//Le quitamos el descuento
            'importe_total' => $factura_ant['importe_total']- (1-($descuento/100)),
            'descuento'=>$descuento
        );
        $this->Mdl_lista->UpdateFactura($idFactura, $factura);
    }

}
