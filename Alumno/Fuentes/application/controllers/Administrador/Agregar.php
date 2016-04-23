<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class Agregar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        $this->load->helper('creaSelect');
        $this->load->helper('cif_validate_helper');
        $this->load->model('Mdl_provincias');
        $this->load->model('Mdl_agregar');
    }

    public function index() {
        
    }

    public function Proveedor() {

        //Crea el select para las provincias
        $provincias = $this->Mdl_provincias->getProvincias();
        $select = CreaSelect($provincias, 'provincia');

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErroresProveedor();
        $this->setReglasValidacionProveedor();

        if ($this->form_validation->run()) {
            $data['nombre'] = $this->input->post('nombre');
            $data['cif'] = $this->input->post('cif');
            $data['correo'] = $this->input->post('correo');
            $data['direccion'] = $this->input->post('direccion');
            $data['localidad'] = $this->input->post('localidad');
            $data['cp'] = $this->input->post('cp');
            $data['idProvincia'] = $this->input->post('provincia');
            $data['anotaciones'] = $this->input->post('anotaciones');
            $this->Mdl_agregar->add('proveedor', $data);
        }

        $cuerpo = $this->load->view('adm_addProveedor', array('selectProvincias' => $select), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Producto', "<i class='fa fa-truck fa-lg' aria-hidden='true'></i>" . ' Agregar Proveedor');
    }

    public function Categoria() {

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_rules('nombre', 'nombre de categoría', 'required|callback_NombreCategoria_unico_check');
        $this->form_validation->set_message('NombreCategoria_unico_check', 'El nombre de la categoría ya está guardado');

        if ($this->form_validation->run()) {
            $data['nombre'] = $this->input->post('nombre');
            $data['descripcion'] = $this->input->post('descripcion');
            $this->Mdl_agregar->add('categoria', $data);
        } 

        $cuerpo = $this->load->view('adm_addCategoria', '', true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Categoria', "<i class='fa fa-folder-open fa-lg' aria-hidden='true'></i>" . ' Agregar Categoría');
    }
    
    public function Producto() {

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        
        if ($this->form_validation->run()) {
            $data['nombre'] = $this->input->post('nombre_cat');
            $data['descripcion'] = $this->input->post('descripcion');
            $this->Mdl_agregar->add('producto', $data);
        } 

        $cuerpo = $this->load->view('adm_addProducto', '', true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Agregar Producto');
    }

    /******* FUNCIONES VALIDACIÓN PROVEEDOR ****** */

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario agregar proveedor
     */
    function setMensajesErroresProveedor() {
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('CIF_check', 'CIF incorrecto');
        $this->form_validation->set_message('CIF_unico_check', 'El CIF ya está guardado');
        $this->form_validation->set_message('valid_email', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('exact_length', 'El campo %s debe tener %s caracteres');
        $this->form_validation->set_message('integer', 'El campo %s debe ser númerico');
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario agregar proveedor
     */
    function setReglasValidacionProveedor() {
        //Proveedor
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('provincia', 'provincia', 'required');
        $this->form_validation->set_rules('cif', 'CIF', 'required|callback_CIF_check|callback_CIF_unico_check');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('direccion', 'dirección', 'required');
        $this->form_validation->set_rules('localidad', 'localidad', 'required');
        $this->form_validation->set_rules('cp', 'Código Postal', 'required|integer|exact_length[5]');
    }

    function CIF_check($CIF) {
        if (isValidCIF($CIF)) {
            return true;
        } else {
            return false;
        }
    }

    function CIF_unico_check($CIF) {
        if ($this->Mdl_agregar->getCountCIF($CIF) > 0) {
            return false;
        }

        return true;
    }

    /*     * ***** FUNCIONES VALIDACIÓN CATEGORÍA ****** */

    function NombreCategoria_unico_check($nombre) {
        if ($this->Mdl_agregar->getCountNombreCategoria($nombre) > 0) {
            return false;
        }

        return true;
    }

}
