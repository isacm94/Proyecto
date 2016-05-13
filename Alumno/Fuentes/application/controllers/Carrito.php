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

        $cuerpo = $this->load->view('ven_carrito', array('' => ''), true); //Generamos la vista         
        CargaPlantillaVenta($cuerpo, '', ' | Carrito', 'Carrito');
    }

    public function add($id) {

        $producto = $this->Mdl_carrito->getProducto($id);

        $stock = $this->Mdl_carrito->getStock($id); //Guardamos su stock
        //Guarda la cantidad que tiene comprada de un producto
        foreach ($this->myCarrito->get_content() as $items) {
            if ($items['id'] == $id) {
                $cantidad = $items['cantidad'];
            }
        }
        if ($stock > $cantidad) {
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
        } else {
            $articulo = array(
                "id" => $producto['idProducto'],
                "cantidad" => 1, /* Añade 1, sino hay ninguno pone 1 CORREGIR*/
                "stock" => $producto['stock'],
                "precio" => $producto['precio_venta'],
                "nombre" => $producto['nombre'],
                "categoria" => $producto['categoria'],
                "idCategoria" => $producto['idCategoria'],
                "errorstock" => '<span class="label label-danger">¡Stock superado!</span>',
            );
            $this->myCarrito->actualizar($articulo);
            redirect('Carrito', 'location', 301);
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

}
