<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        $this->load->helper('creaSelect');
        $this->load->helper('nif_validate_helper');
        $this->load->model('Mdl_agregar');
    }

    public function index() {

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_rules('nombre', 'nombre de categoría', 'required|callback_Nombre_unico_check');
        $this->form_validation->set_message('Nombre_unico_check', 'El nombre de la categoría ya está guardado');
        $this->form_validation->set_message('required', 'El campo %s está vacío');

        if ($this->form_validation->run()) {
            $data['nombre'] = $this->input->post('nombre');
            $data['descripcion'] = $this->input->post('descripcion');
            $this->Mdl_agregar->add('categoria', $data);
        }

        $cuerpo = $this->load->view('adm_addCategoria', '', true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Categoria', "<i class='fa fa-folder-open fa-lg' aria-hidden='true'></i>" . ' Agregar Categoría');
    }


    function Nombre_unico_check($nombre) {
        if ($this->Mdl_agregar->getCountNombreCategoria($nombre) > 0) {
            return false;
        }

        return true;
    }

}
