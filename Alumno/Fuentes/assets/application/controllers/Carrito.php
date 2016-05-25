<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR 
 */
class Carrito extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_carrito'); //Cargamos modelo
        $this->load->library('Carro', 0, 'myCarrito');
        //$this->session->set_userdata(array('pagina-actual-venta' => current_url())); //Guardamos la URL actual
    }

    public function index() {
        if (!SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }
        $this->BorraMensajesError();

        $cuerpo = $this->load->view('ven_carrito', array('' => ''), true); //Generamos la vista         
        CargaPlantillaVenta($cuerpo, '', ' | Carrito', 'Carrito');
    }

    public function add($id) {
        if (!SesionIniciadaCheckVen()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Login', 'location', 301);
            return; //Sale de la función
        }

        $producto = $this->Mdl_carrito->getProducto($id);
        if (!$producto) { //Si el producto no es correcto o no existe
            redirect('/Error404', 'location', 301);
            return; //Sale de la función
        }


        $stock = $this->Mdl_carrito->getStock($id); //Guardamos su stock
        //Guarda la cantidad que tiene comprada de un producto
        foreach ($this->myCarrito->get_content() as $items) {
            if ($items['id'] == $id) {
                $cantidad = $items['cantidad'];
            }
        }

        $this->BorraMensajesError();

        if ($stock > $cantidad) {//Si no supera el stock 
            $articulo = array(
                "id" => $producto['idProducto'],
                "cantidad" => 1, /* Añade 1, sino hay ninguno pone 1 */
                "stock" => $producto['stock'],
                "precio" => $producto['precio_venta'],
                "nombre" => $producto['nombre'],
                "categoria" => $producto['categoria'],
                "idCategoria" => $producto['idCategoria'],
                "errorstock" => ''
            );
            $this->myCarrito->add($articulo);
            redirect('Carrito', 'location', 301);
        } else {//Si supera el stock
            $articulo = array(
                "id" => $producto['idProducto'],
                "cantidad" => $cantidad, /* Deja la cantidad que estaba */
                "stock" => $producto['stock'],
                "precio" => $producto['precio_venta'],
                "nombre" => $producto['nombre'],
                "categoria" => $producto['categoria'],
                "idCategoria" => $producto['idCategoria'],
                "errorstock" => '<span class="label label-danger">¡Stock superado!</span>',
            );
            $this->myCarrito->actualizar($articulo);

            $cuerpo = $this->load->view('ven_carrito', array('' => ''), true); //Generamos la vista         
            CargaPlantillaVenta($cuerpo, '', ' | Carrito', 'Carrito');
        }
    }

    /**
     * Borra un producto del carrito
     * @param Int $id ID de la camiseta
     */
    public function eliminar($id) {

        foreach ($this->myCarrito->get_content() as $items) {
            if ($items['id'] == $id) {
                $this->myCarrito->remove_producto($items['unique_id']);
            }
        }

        redirect('Carrito', 'location', 301);
    }

    /**
     * Borra todo el carrito
     */
    public function eliminarcompra() {
        $this->myCarrito->destroy();

        redirect('', 'location', 301); //Vuelve a la página principal
    }

    /**
     * Elimina los mensajes de error que se han mostrado anteriormente
     */
    public function BorraMensajesError() {
        if ($this->myCarrito->articulos_total() > 0) :
            foreach ($this->myCarrito->get_content() as $items) {
                $articulo = array(
                    "id" => $items['id'],
                    "cantidad" => $items['cantidad'], /* Deja la cantidad que estaba */
                    "stock" => $items['stock'],
                    "precio" => $items['precio'],
                    "nombre" => $items['nombre'],
                    "categoria" => $items['categoria'],
                    "idCategoria" => $items['idCategoria'],
                    "errorstock" => ''
                );
                $this->myCarrito->actualizar($articulo);
            }
        endif;
    }

    public function CompruebaStockAjax($idProducto) {

        $this->BorraMensajesError();

        $stock = $this->Mdl_carrito->getStock($idProducto);
        $num_stock = $_POST['num_stock']; //Nº introducido en el input
        $this->myCarrito->get_articulo($idProducto);

        //Si el stock es menos al nº introducido mostramos error, sino no mostramos error
        foreach ($this->myCarrito->get_content() as $items) {
            if ($items['id'] == $idProducto) {//Si es el id que buscamos
                if ($num_stock == '') {//Si pone un valor vacío
                    $this->MuestraErrorArticulo($items['id'], '¡Está vacío!');
                    
                } else if (! ctype_digit($num_stock)) {//Si no introduce un número entero
                    $this->MuestraErrorArticulo($items['id'], '¡No es un número entero!');
                    
                } else if ($stock < $num_stock) { //Supera el stock, mostramos error                    
                    $this->MuestraErrorArticulo($items['id'], '¡Stock superado!');
                } else {//No supera stock, mostramos el nº introducido
                    $articulo = array(
                        "id" => $items['id'],
                        "cantidad" => $num_stock, /* Muestra el nº introducido */
                        "stock" => $items['stock'],
                        "precio" => $items['precio'],
                        "nombre" => $items['nombre'],
                        "categoria" => $items['categoria'],
                        "idCategoria" => $items['idCategoria'],
                        "errorstock" => ''//No mostramos error
                    );
                    $this->myCarrito->actualizar($articulo);
                }
            } else {//No es igual al id, dejamos lo que estaba(lo desordenaba)
                $this->MuestraErrorArticulo($items['id'], '');
            }
        }
        
        //Actualizamos en la barra superior
        echo "<script>$('#articulos_total').html('". $this->myCarrito->articulos_total()."');</script>";
        echo "<script>$('#precio_total').html('". $this->myCarrito->precio_total()." €');</script>";

        $this->load->view('ven_carrito', array('' => ''));
    }

    private function MuestraErrorArticulo($idProducto, $mensajeerror) {
        $articulo = $this->myCarrito->get_articulo($idProducto);

        $articulo['errorstock'] = '<span class="label label-warning">'.$mensajeerror.'</span>';
        $this->myCarrito->actualizar($articulo);
    }

}