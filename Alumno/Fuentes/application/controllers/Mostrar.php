<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR 
 */
class Mostrar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_mostrar'); //Cargamos modelo       
        $this->load->library('Carro', 0, 'myCarrito');
        $this->load->library('PDF', 0, 'myPDF');
        $this->session->set_userdata(array('pagina-actual-venta' => current_url())); //Guardamos la URL actual
    }

    public function index($idAlbaran, $idFactura) {

        if (!SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }

        $cuerpo = $this->load->view('ven_ventafinalizada', Array('idAlbaran' => $idAlbaran, 'idFactura' => $idFactura), true); //Generamos la vista         
        CargaPlantillaVenta($cuerpo, '', ' | Venta Finalizada', 'Venta Finalizada');
    }

    /**
     * Crea un PDF de un pedido determinado con todos los datos del pedido y los productos comprados
     * @param Int $idPedido ID del pedido
     * @param Char $metodo I --> envía el fichero al navegador / D --> Fuerza la descarga
     */
    public function Albaran($idAlbaran, $metodo = 'I') {

        $this->myPDF->AddPage();
        $this->myPDF->AliasNbPages(); //nº de páginas
               
        //Nº de Albarán
        $this->myPDF->SetFont('Arial', 'B', 18);
        $numalbaran = $this->Mdl_mostrar->getNumeroAlbaran($idAlbaran);
        $this->myPDF->Cell(0, 7, utf8_decode('ALBARÁN Nº '.$numalbaran), 0, 1, 'R');
        
        //Fecha de albarán
        $this->myPDF->SetFont('Arial', '', 12);
        $fecha = $this->Mdl_mostrar->getFechaAlbaran($idAlbaran);
        $this->myPDF->Cell(0, 7, utf8_decode('Fecha '.$fecha), 0, 1, 'R');
        
        //Datos del cliente
        $datosclientes = $this->Mdl_mostrar->getDatosCliente($idAlbaran);
        $this->myPDF->SetFont('Arial', '', 10);
        $this->myPDF->Cell(0, 7, utf8_decode($datosclientes['nombre']), 0, 1);
        $this->myPDF->Cell(0, 7, utf8_decode("NIF: " . $datosclientes['nif']), 0, 1);
        $this->myPDF->Cell(0, 7, utf8_decode($datosclientes['direccion'] . ', ' . $datosclientes['cp'] . ' (' . $datosclientes['provincia'] . ')'), 0, 1);
                      
        //Tabla líneas de albarán
        $lineas_albaran = $this->Mdl_mostrar->getLineasAlbaran($idAlbaran);  
        $albaran = $this->Mdl_mostrar->getAlbaran($idAlbaran);//Para mostrar cantidad e importe total    
        $this->myPDF->CreaAlbaran($lineas_albaran, $albaran);

        $this->myPDF->Output($metodo, 'albaran.pdf', true);
    }

}
