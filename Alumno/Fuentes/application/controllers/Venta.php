<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE VENTA que gestiona la venta de productos
 */
class Venta extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_venta'); //Cargamos modelo       
        $this->load->library('Carro', 0, 'myCarrito');
        $this->session->set_userdata(array('pagina-actual-venta' => current_url())); //Guardamos la URL actual
    }

    /**
     * Muestra una lista desplegable para elegir el usuario
     */
    public function index() {

        if (!SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }

        $minoristas = $this->Mdl_venta->getMinoristas();
        $mayoristas = $this->Mdl_venta->getMayoristas();

        $cuerpo = $this->load->view('venta/ven_venta1', array('minoristas' => $minoristas, 'mayoristas' => $mayoristas), true); //Generamos la vista         
        CargaPlantillaVenta($cuerpo, '', ' | Venta', 'Venta');
    }

    /**
     * Gestiona la venta según el tipo de cliente que haya sido elegido anteriormente
     */
    public function ProcesaCliente() {
        if (!SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }
        $idCliente = $this->input->post('cliente');

        if (!EMPTY($idCliente)) {
            if ($this->Mdl_venta->getTipo($idCliente) == 'Mayorista') {//MAYORISTA, cargamos la vista de seleccionar si se paga en el acto
                $cuerpo = $this->load->view('venta/ven_venta2', array('idCliente' => $idCliente), true); //Pasamos el id para guardarlo en un campo oculto
                CargaPlantillaVenta($cuerpo, '', ' | Venta', 'Venta');
            } else {//MINORISTA
                redirect('/Venta/ResumenVenta/' . $idCliente . '/0', 'location', 301);
            }
        } else {//No ha seleccionado ningún cliente
            $minoristas = $this->Mdl_venta->getMinoristas();
            $mayoristas = $this->Mdl_venta->getMayoristas();

            $errorselect = '<div class="alert msgerror"><b>¡Error! </b> No ha seleccionado ningún cliente</div>';

            $cuerpo = $this->load->view('venta/ven_venta1', array('minoristas' => $minoristas, 'mayoristas' => $mayoristas, 'errorselect' => $errorselect), true); //Generamos la vista         
            CargaPlantillaVenta($cuerpo, '', ' | Venta', 'Venta');
        }
    }

    /**
     * Gestiona el toogle(checkbox moderno) de pagar en el acto del cliente mayorista
     */
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

    /**
     * Muestra un resumen de la venta antes de finalizar ésta
     * @param Int $idCliente ID del cliente
     * @param Int $pagaenelacto Si el cliente paga en el acto, el cliente es minorista siempre pagará en el acto por lo que el valor será 1
     * @return type
     */
    public function ResumenVenta($idCliente, $pagaenelacto = '0') {
        if (!SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }

        $cliente = $this->Mdl_venta->getDatosCliente($idCliente);

        if ($this->Mdl_venta->getTipo($idCliente) == 'Minorista' && $pagaenelacto == '1') {
            //Si no existe el cliente o si el cliente no es mayorista y paga en el acto(por si cambian la URL)
            redirect('/Error404', 'location', 301);
            return; //Sale de la función
        }

        $cuerpo = $this->load->view('venta/ven_resumenventa', array('cliente' => $cliente, 'pagaenelacto' => $pagaenelacto), true); //Generamos la vista         
        CargaPlantillaVenta($cuerpo, '', ' | Resumen Venta', 'Resumen Venta');
    }

    /**
     * Termina la venta y guarda todos los datos en la base de datos
     * @param Int $idCliente ID del cliente
     * @param Int $pagaenelacto Si el cliente paga en el acto, si el cliente es minorista siempre pagará en el acto por lo que el valor será 1
     * @return type
     */
    public function Finalizar($idCliente, $pagaenelacto = '0') {
        if (!SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }

        if ($this->Mdl_venta->getTipo($idCliente) == 'Minorista' || //Si es minorista
                ($this->Mdl_venta->getTipo($idCliente) == 'Mayorista' && $pagaenelacto == '1')) {
            //O si es mayorista y paga en el acto          

            $idFactura = $this->setFactura($idCliente);
            $idAlbaran = $this->setAlbaran($idCliente, $idFactura);
            $this->setLineasAlbaran($idAlbaran);

            //Vacíamos carrito
            $this->myCarrito->destroy();

            redirect('/Mostrar/index/' . $idAlbaran . '/' . $idFactura, 'location', 301);
        } else if ($this->Mdl_venta->getTipo($idCliente) == 'Mayorista' && $pagaenelacto == '0') {//
            //Es mayorista y NO paga en el acto
            $idFactura = $this->setFacturaMayorista($idCliente);
            $idAlbaran = $this->setAlbaran($idCliente, $idFactura);
            $this->setLineasAlbaran($idAlbaran);

            //Vacíamos carrito
            $this->myCarrito->destroy();

            redirect('/Mostrar/index/' . $idAlbaran . '/' . $idFactura . '/' . $pagaenelacto, 'location', 301);
        }
    }

    /**
     * Guarda en la base de datos el producto y los datos de la compra de ese producto, en la tabla línea de albarán
     * @param Int $idAlbaran
     */
    private function setLineasAlbaran($idAlbaran) {
        foreach ($this->myCarrito->get_content() as $items) {
            $linea_albaran = array(
                'idAlbaran' => $idAlbaran,
                'idProducto' => $items['id'],
                'cantidad' => $items['cantidad'],
                'precio' => $items['precio'],
                'iva' => $this->Mdl_venta->getIva($items['id'])
                    //'importe' se inserta en un disparador
            );

            $this->Mdl_venta->setLineaAlbaran($linea_albaran);

            //Actualizamos stock
            $stocknuevo = $this->Mdl_venta->getStock($items['id']) - $items['cantidad']; //Le quitamos al stock actual la cantidad comprada
            $this->Mdl_venta->UpdateStockProducto($items['id'], $stocknuevo);
        }
    }

    /**
     * Guarda el albarán con todos los datos de la compra y lo asocia al cliente y a la factura correcta
     * @param Int $idCliente ID del cliente
     * @param Int $idFactura ID de la factura
     * @return Int ID del albarán
     */
    private function setAlbaran($idCliente, $idFactura) {

        $cliente = $this->Mdl_venta->getDatosCliente($idCliente);
        $albaran = array(
            'idCliente' => $idCliente,
            'idFactura' => $idFactura,
            'cantidad_total' => $this->myCarrito->articulos_total(),
            'importe_total' => $this->myCarrito->precio_total(),
            'fecha_albaran' => date("Y/m/d"),
            'direccion' => $cliente['direccion'],
            'localidad' => $cliente['localidad'],
            'cp' => $cliente['cp'],
            'idProvincia' => $cliente['idProvincia'],
            'nif' => $cliente['nif'],
            'nombre_cliente' => $cliente['nombre']
        );
        $idAlboran = $this->Mdl_venta->setAlbaran($albaran);

        return $idAlboran;
    }

    /**
     * 
     * @param Int $idCliente ID del cliente
     * @param Int $idFactura ID de la factura
     * @return Int ID del albarán
     */
    
    /**
     * Guarda la factura con todos los datos de la compra y lo asocia al cliente
     * @param Int $idCliente ID del cliente
     * @return Int ID de la factura
     */
    private function setFactura($idCliente) {

        $cliente = $this->Mdl_venta->getDatosCliente($idCliente);
        $importebruto = $this->CalculaImporteBruto();
        $factura = array(
            'fecha_factura' => date("Y/m/d"),
            'cantidad_total' => $this->myCarrito->articulos_total(),
            'importe_bruto' => $importebruto,
            'base_imponible' => $importebruto, 
            'cantidad_iva' => $this->myCarrito->precio_total() - $importebruto,
            'importe_total' => $this->myCarrito->precio_total(),
            'descuento'=>0,
            'importe_total_descuento' => $this->myCarrito->precio_total(),//Como no tiene descuento es el mismo importe
            'pendiente_pago' => 'No',
            'fecha_cobro' => date("Y/m/d"),
            'direccion' => $cliente['direccion'],
            'localidad' => $cliente['localidad'],
            'cp' => $cliente['cp'],
            'idProvincia' => $cliente['idProvincia'],
            'nif' => $cliente['nif'],
            'nombre_cliente' => $cliente['nombre'],
            'idCliente' => $idCliente
        );
        $idFactura = $this->Mdl_venta->setFactura($factura);

        return $idFactura;
    }

    /**
     * Guarda la factura con todos los datos de la compra y lo asocia al cliente, se establece la factura pendiente de pago
     * @param Int $idCliente ID del cliente
     * @return Int ID de la factura
     */
    private function setFacturaMayorista($idCliente) {

        $cliente = $this->Mdl_venta->getDatosCliente($idCliente);
        $importebruto = $this->CalculaImporteBruto();

        $ultimafactura = $this->Mdl_venta->getFacturaMayorista($idCliente);

        if (!$ultimafactura) {//Si no existe ultima factura, se genera otra
            $factura = array(
                'fecha_factura' => date("Y/m/d"),
                'cantidad_total' => $this->myCarrito->articulos_total(),
                'importe_bruto' => $importebruto,
                'base_imponible' => $importebruto, //quitar descuento
                'cantidad_iva' => $this->myCarrito->precio_total() - $importebruto,
                'importe_total' => $this->myCarrito->precio_total(),
                'importe_total_descuento'=> $this->myCarrito->precio_total(), //Como no tiene descuento, es el mismo importe
                'pendiente_pago' => 'Sí',
                //'fecha_cobro' => date("Y/m/d"),
                'descuento' => 0,
                'direccion' => $cliente['direccion'],
                'localidad' => $cliente['localidad'],
                'cp' => $cliente['cp'],
                'idProvincia' => $cliente['idProvincia'],
                'nif' => $cliente['nif'],
                'nombre_cliente' => $cliente['nombre'],
                'idCliente' => $idCliente
            );

            $idFactura = $this->Mdl_venta->setFactura($factura);
        } else {//Si existe, se le añaden los nuevos datos
            
            $idFactura = $ultimafactura['idFactura'];

            echo "<h1>$idFactura</h1>";
            
            $importe_total = $ultimafactura['importe_total'];
            $descuento = $ultimafactura['descuento'];
            
            $factura = array(
                'cantidad_total' => $ultimafactura['cantidad_total'] + $this->myCarrito->articulos_total(),
                'importe_bruto' => $ultimafactura['importe_bruto'] + $importebruto,
                'base_imponible' => $ultimafactura['importe_bruto'] + $importebruto, //quitar descuento
                'cantidad_iva' => $ultimafactura['cantidad_iva'] + ($this->myCarrito->precio_total() - $importebruto),
                'importe_total' => $importe_total + $this->myCarrito->precio_total(),
                'pendiente_pago' => 'Sí',
                'importe_total_descuento'=> ($importe_total + $this->myCarrito->precio_total()) * (1 - ($descuento / 100))
                    //le aplicamos el descuento guardado
            );

            $this->Mdl_venta->UpdateFactura($idFactura, $factura);
        }


        return $idFactura;
    }

    /**
     * Calcula el importe bruto de la factura
     * @return Float importe
     */
    private function CalculaImporteBruto() {
        $importebruto = 0;

        foreach ($this->myCarrito->get_content() as $items) {
            $importebruto+= $this->QuitaIvaAlPrecio($items['precio'], $this->Mdl_venta->getIva($items['id']));
        }

        return $importebruto;
    }

    /**
     * Devuelve el precio de un producto sin el IVA
     * @param Float $precio Precio del producto
     * @param Float $iva Porcentaje del IVA
     * @return Float Precio sin IVA
     */
    private function QuitaIvaAlPrecio($precio, $iva) {

        return $precio * ((100 - $iva) / 100);
    }

}
