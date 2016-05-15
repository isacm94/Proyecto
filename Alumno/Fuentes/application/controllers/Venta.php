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
        CargaPlantillaVenta($cuerpo, '', ' | Venta', 'Venta');
    }

    public function ProcesaCliente() {
        if (!SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }
        $idCliente = $this->input->post('cliente');

        if (!EMPTY($idCliente)) {
            if ($this->Mdl_venta->getTipo($idCliente) == 'Mayorista') {//MAYORISTA, cargamos la vista de seleccionar si se paga en el acto
                $cuerpo = $this->load->view('ven_venta2', array('idCliente' => $idCliente), true); //Pasamos el id para guardarlo en un campo oculto
                CargaPlantillaVenta($cuerpo, '', ' | Venta', 'Venta');
            } else {//MINORISTA
                redirect('/Venta/ResumenVenta/' . $idCliente . '/0', 'location', 301);
            }
        } else {//No ha seleccionado ningún cliente
            $minoristas = $this->Mdl_venta->getMinoristas();
            $mayoristas = $this->Mdl_venta->getMayoristas();

            $errorselect = '<div class="alert msgerror"><b>¡Error! </b> No ha seleccionado ningún cliente</div>';

            $cuerpo = $this->load->view('ven_venta1', array('minoristas' => $minoristas, 'mayoristas' => $mayoristas, 'errorselect' => $errorselect), true); //Generamos la vista         
            CargaPlantillaVenta($cuerpo, '', ' | Venta', 'Venta');
        }
    }

    public function ProcesaToggle() {
        if (!SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }
        $toggle = $this->input->post('toggle'); //Toggle pagar en el acto
        $idCliente = $this->input->post('idCliente');

        if ($toggle == 'on') {//SI paga en el acto
            redirect('/Venta/ResumenVenta/' . $idCliente . '/1', 'location', 301); //1 --> si paga en el acto
        } else {//NO paga en el acto
            redirect('/Venta/ResumenVenta/' . $idCliente . '/0', 'location', 301);
        }
    }

    public function ResumenVenta($idCliente, $pagaenelacto = '0') {
        if (!SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }
        
        $cliente = $this->Mdl_venta->getDatosCliente($idCliente);
        
        if($this->Mdl_venta->getTipo($idCliente) == 'Minorista' && $pagaenelacto == '1')  {
            //Si no existe el cliente o si el cliente no es mayorista y paga en el acto(por si cambian la URL)
            redirect('/Error404', 'location', 301);
            return; //Sale de la función
        }               
        
        $cuerpo = $this->load->view('ven_resumenventa', array('cliente' => $cliente, 'pagaenelacto' => $pagaenelacto), true); //Generamos la vista         
        CargaPlantillaVenta($cuerpo, '', ' | Resumen Venta', 'Resumen Venta');
    }

}
