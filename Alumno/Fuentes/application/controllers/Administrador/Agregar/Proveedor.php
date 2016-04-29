<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class Proveedor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        $this->load->helper('creaselect_helper');
        $this->load->helper('nif_validate_helper');
        $this->load->model('Mdl_provincias');
        $this->load->model('Mdl_agregar');
    }

    public function index() {
        if (! SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        
        //Crea el select para las provincias
        $provincias = $this->Mdl_provincias->getProvincias();
        $select = CreaSelectProvincias($provincias, 'provincia');

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErrores();
        $this->setReglasValidacion();

        if ($this->form_validation->run()) {
            $data['nombre'] = $this->input->post('nombre');
            $data['nif'] = $this->input->post('nif');
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

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario agregar proveedor
     */
    function setMensajesErrores() {
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('NIF_check', 'Formato de NIF incorrecto');
        $this->form_validation->set_message('NombreProveedor_unico_check', 'El nombre ya está guardado');
        $this->form_validation->set_message('valid_email', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('exact_length', 'El campo %s debe tener %s caracteres');
        $this->form_validation->set_message('integer', 'El campo %s debe ser números enteros');
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario agregar proveedor
     */
    function setReglasValidacion() {
        //Proveedor
        $this->form_validation->set_rules('nombre', 'nombre', 'required|callback_NombreProveedor_unico_check');
        $this->form_validation->set_rules('provincia', 'provincia', 'required');
        $this->form_validation->set_rules('nif', 'NIF', 'required|callback_NIF_check');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('direccion', 'dirección', 'required');
        $this->form_validation->set_rules('localidad', 'localidad', 'required');
        $this->form_validation->set_rules('cp', 'Código Postal', 'required|integer|exact_length[5]');
    }

    function NIF_check($NIF) {
        if (isValidNIF($NIF)) {
            return true;
        } else {
            return false;
        }
    }

    function NombreProveedor_unico_check($nombre) {
        if ($this->Mdl_agregar->getCountNombreProveedor($nombre) > 0) {
            return false;
        }

        return true;
    }
}