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
     * @param Int $idfacturapagada ID de una factura que se ha marcado como pagada, para mostrar un mensaje de éxito
     */
    public function index($idfacturapagada = '') {
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual

        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }


        $mensajePagada = '';
        if (!EMPTY($idfacturapagada)) {//Mostramos mensaje de éxito, si viene una factura pagada
            $info_factura = $this->Mdl_lista->getInfoFactura($idfacturapagada);
            $mensajePagada = "<div class='alert alert-success'>Se ha marcado como pagada la factura <i>Nº " . $info_factura['numfactura'] . "</i> de <i>" . $info_factura['nombre_cliente'] . "</i> con fecha <i>" . $info_factura['fecha_factura'] . "</i></div>";
        }

        $facturas_pendientes = $this->Mdl_lista->getFacturasPendientes();
        $facturas_pagadas = $this->Mdl_lista->getFacturasPagadas();

        $cuerpo = $this->load->view('lista/adm_listaFacturas', array('facturas_pendientes' => $facturas_pendientes, 'facturas_pagadas' => $facturas_pagadas, 'mensajePagada' => $mensajePagada), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Lista de Facturas', "<i class='fa fa-list-alt fa-lg' aria-hidden='true'></i>" . ' Lista de Facturas');
    }

    /**
     * Se marca como pagada una factura pendiente
     * @param ID $idFactura ID de la factura
     */
    public function Pagar($idFactura) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->Mdl_lista->setFacturaPagada($idFactura);

        redirect(site_url('/Administrador/Lista/Facturas/index/' . $idFactura), 'Location', 301);
    }

    /**
     * Se permite aplicarle un descuento a una factura pendiente 
     * @param ID $idFactura ID de la factura
     */
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
        $this->form_validation->set_message('check_mayor0', 'El campo %s tiene que ser mayor o igual a 0');

        $this->form_validation->set_rules('descuento', 'descuento', 'required|numeric|less_than[91]|callback_check_mayor0');

        $mensajeok = '';
        if ($this->form_validation->run()) {
            $descuento = $this->input->post('descuento');
            $this->ActualizarFactura($idFactura, $descuento);
            $info_factura['descuento'] = $this->input->post('descuento'); //Guardamos el valor introducido para mostrarlo
            $mensajeok = "<div class='alert alert-success'>Se ha aplicado correctamente un descuento de un $descuento% a la factura <a href='" . site_url('/Administrador/Lista/Facturas') . "'>Volver a la lista</a></div>";
        } else if ($this->input->post()) {
            $info_factura['descuento'] = $this->input->post('descuento'); //Guardamos el valor introducido para mostrarlo
        }

        $cuerpo = $this->load->view('adm_cambiarDescuento', array('info_factura' => $info_factura, 'mensajeok' => $mensajeok), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Cambiar descuento de factura', "<i class='fa fa-list-alt fa-lg' aria-hidden='true'></i> Cambiar descuento de factura");
    }

    /**
     * Comprueba que el descuento introducido sea mayor o igual a 0
     * @param Float $num Porcentaje de descuento introducido
     * @return boolean
     */
    public function check_mayor0($num) {
        if ($num >= 0) {
            return true;
        }

        return false;
    }

    /**
     * Aplica el descuento a la factura
     * @param Int $idFactura ID de la factura
     * @param Float $descuento Porcentaje de descuento introducido
     */
    private function ActualizarFactura($idFactura, $descuento) {
        $importe_total = $this->Mdl_lista->getImporteTotalFactura($idFactura); //Guardamos el importe total de la factura

        $factura = array(
            'descuento' => $descuento,
            'importe_total_descuento' => $importe_total * (1 - ($descuento / 100))//Le quitamos el descuento
        );
        $this->Mdl_lista->UpdateFactura($idFactura, $factura);
    }

}
