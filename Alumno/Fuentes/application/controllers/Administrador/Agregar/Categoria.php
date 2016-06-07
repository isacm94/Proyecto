<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que realiza el proceso de añadir una categoría
 */
class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        $this->load->helper('creaselect_helper');
        $this->load->helper('nif_validate_helper');
        $this->load->model('Mdl_agregar');
    }

    /**
     * Muestra y valida el formulario de agregar categoría
     */
    public function index() {
        if (! SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_rules('nombre', 'nombre de categoría', 'required|callback_Nombre_unico_check');
        $this->form_validation->set_message('Nombre_unico_check', 'El nombre de la categoría ya está guardado');
        $this->form_validation->set_message('required', 'El campo %s está vacío');

        $mensajeok = "";
        if ($this->form_validation->run()) {//Si la validación es correcta
            
            $data['nombre'] = $this->input->post('nombre');
            $data['descripcion'] = $this->input->post('descripcion');
            
            $this->Mdl_agregar->add('categoria', $data);//Añade la categoria
            
            $mensajeok = '<div class="alert alert-success msgok">¡Se ha guardado correctamente!'
                     . ' <a href="'.  site_url('/Administrador/Lista/Categorias').'" class="link">Ver la lista de categorías</a></div>';
        
        }

        $cuerpo = $this->load->view('agregar/adm_addCategoria', array('mensajeok' => $mensajeok), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Agregar Categoria', "<i class='fa fa-folder-open fa-lg' aria-hidden='true'></i>" . ' Agregar Categoría');
    }

    /**
     * Comprueba que el nombre de categoría introducido no esté repetido
     * @param string $nombre Nombre de la categoría
     * @return boolean
     */
    function Nombre_unico_check($nombre) {
        if ($this->Mdl_agregar->getCountNombreCategoria($nombre) > 0) {
            return false;
        }

        return true;
    }

}
