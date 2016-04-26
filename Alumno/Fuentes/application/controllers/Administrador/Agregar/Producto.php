<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class Producto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        $this->load->helper('creaSelect');
        $this->load->helper('nif_validate_helper');
        $this->load->model('Mdl_provincias');
        $this->load->model('Mdl_agregar');
    }

    public function index() {

        $error_img = "";

        //Crea el select para categorias
        $categorias = $this->Mdl_agregar->getCategorias();
        $select_categorias = CreaSelect($categorias, 'Categoria', 'Seleccione una categoría');

        //Crea el select para proveedores
        $proveedores = $this->Mdl_agregar->getProveedores();
        $select_proveedores = CreaSelect($proveedores, 'Proveedor', 'Seleccione un proveedor');

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErrores();
        $this->setReglasValidacion();

        if ($this->form_validation->run() && $this->checkImagenEnviada() && $_FILES["imagen"]["error"] == 0 && $this->checkTipoImagen()) {

            $data['nombre'] = $this->input->post('nombre');
            $data['marca'] = $this->input->post('marca');
            $data['precio'] = $this->input->post('precio');
            $data['precio_venta'] = $this->getPrecioMasIVA($this->input->post('precio_venta'), $this->input->post('iva'));
            $data['iva'] = $this->input->post('iva');
            $data['stock'] = $this->input->post('stock');
            $data['idCategoria'] = $this->input->post('Categoria');
            $data['idProveedor'] = $this->input->post('Proveedor');
            $data['imagen'] = $this->ProcesaImagen();
            $this->Mdl_agregar->add('producto', $data);
        } else if (!$this->checkImagenEnviada() /* && $this->input->post() */) {//Comprobar si se ha enviado la imagen, sólo si se ha enviado el formulario
            $error_img = "<div class='alert msgerror'><b>¡Error! </b> Imagen no seleccionada</div>'";
        } else if ($_FILES["imagen"]["error"] > 0) {
            $error_img = "<div class='alert msgerror'><b>¡Error! </b> Ha ocurrido un error en la subida de la imagen</div>'";
        } else if (!$this->checkTipoImagen()) {
            $error_img = "<div class='alert msgerror'><b>¡Error! </b> La imagen debe ser <i>jpg, jpeg, gif o png</i></div>'";
        }
//        echo '<pre>';
//        print_r($_FILES);
//        echo '</pre>';
        $cuerpo = $this->load->view('adm_addProducto', Array('select_categorias' => $select_categorias, 'select_proveedores' => $select_proveedores, 'error_img' => $error_img), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Agregar Producto');
    }

    function ProcesaImagen() {
        $ruta = base_url() . "images/" . $_FILES['imagen']['name'];

        $resultado = move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

        return "images/" . $_FILES['imagen']['name'];
    }

    function checkTipoImagen() {
        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");

        if ($_FILES && in_array($_FILES['imagen']['type'], $permitidos))
            return true;

        return false;
    }

    function checkImagenEnviada() {
        if ($_FILES)//Si se ha enviado la imagen
            return true;

        return false;
    }

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario agregar producto
     */
    function setMensajesErrores() {
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('NombreProducto_unico_check', 'El nombre ya está guardado');
        $this->form_validation->set_message('integer', 'El campo %s debe ser números entero');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser númerico');
        $this->form_validation->set_message('CategoriaSeleccionada_check', 'Categoría no seleccionada');
        $this->form_validation->set_message('ProveedorSeleccionada_check', 'Proveedor no seleccionado');
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario agregar producto
     */
    function setReglasValidacion() {
        //Proveedor
        $this->form_validation->set_rules('nombre', 'nombre', 'required|callback_NombreProducto_unico_check');
        $this->form_validation->set_rules('marca', 'marca', 'required');
        $this->form_validation->set_rules('precio', 'precio', 'required|numeric');
        $this->form_validation->set_rules('precio_venta', 'precio de venta', 'required|numeric');
        $this->form_validation->set_rules('iva', 'IVA', 'required|numeric');
        $this->form_validation->set_rules('stock', 'stock', 'required|integer');
        $this->form_validation->set_rules('Categoria', 'categoría', 'callback_CategoriaSeleccionada_check');
        $this->form_validation->set_rules('Proveedor', 'proveedor', 'callback_ProveedorSeleccionada_check');
    }

    function NombreProducto_unico_check($nombre) {
        if ($this->Mdl_agregar->getCountNombreProducto($nombre) > 0) {
            return false;
        }

        return true;
    }

    function getPrecioMasIVA($precio, $iva) {
        return $precio * (1 + $iva);
    }

    function CategoriaSeleccionada_check($categoria) {
        if ($categoria == 'defecto')
            return false;

        return true;
    }

    function ProveedorSeleccionada_check($proveedor) {
        if ($proveedor == 'defecto')
            return false;

        return true;
    }

}
