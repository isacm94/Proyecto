<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que muestra la lista de categorias
 */
class Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_lista');
        $this->load->library('pagination');
        $this->load->config("paginacion");
    }

    public function index($desde = 0) {
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual

        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $config = $this->getConfigPag();
        $this->pagination->initialize($config);

        $categorias = $this->Mdl_lista->getCategorias($desde, $config['per_page']);

        $cuerpo = $this->load->view('lista/adm_listaCategorias', array('categorias' => $categorias), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Lista de Categorías', "<i class='fa fa-folder-open fa-lg' aria-hidden='true'></i>" . ' Lista de Categorías');
    }

    function Buscar($desde = 0) {  
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        if ($this->input->post()) {
            $campo = $this->input->post('campo'); //Cogemos el valor del post
            $this->session->set_userdata(array('campo' => $campo)); //Lo guardamos en la sesión para la paginación
        } else {
            $campo = $this->session->userdata('campo');//Recuperamos el dato del post
        }
        
        if($campo == ''){//Si no se ha introducido nada, mostramos la lista completa
            redirect('/Administrador/Lista/Categorias', 'location', 301);
            return;
        }
        
        $config = $this->getConfigPagBuscar($campo);
        $this->pagination->initialize($config);

        $categorias = $this->Mdl_lista->BusquedaCategoria($campo, $desde, $config['per_page']);
        
        $sinrdo = "";
        $mensajebuscar = "";
        
        if (!$categorias) {
            $sinrdo = "No se ha encontrado ningún resultado en la búsqueda de <i>'$campo'</i>. Inténtelo de nuevo o vea la <a href='" . site_url('/Administrador/Lista/Categorias') . "'class=''>lista completa</a>";
        } else {
            $mensajebuscar = "Resultado para la búsqueda <i>'$campo'</i>";
        }

        $cuerpo = $this->load->view('lista/adm_listaCategorias', array('categorias' => $categorias, 'mensajebuscar'=>$mensajebuscar, 'sinrdo'=>$sinrdo), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Lista de Categorías', "<i class='fa fa-folder-open fa-lg' aria-hidden='true'></i>". ' Lista de Categorías');
    }
    
    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    private function getConfigPagBuscar($campo) {
        $config['base_url'] = site_url('/Administrador/Lista/Categorias/Buscar');
        $config['total_rows'] = $this->Mdl_lista->BusquedaNumCategorias($campo);
        $config['per_page'] = $this->config->item('per_page_categorias');
        $config['uri_segment'] = 5;
        $config['num_links'] = 6;

        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '<span></span></span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
        $config['last_link'] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
        $config['next_link'] = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        return $config;
    }
    
    /**
     * Cambia su estado a baja
     * @param Int $id ID de la categoría
     */
    public function Baja($id) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->Mdl_lista->setBaja('Categoria', $id);

        redirect($this->session->userdata('pagina-actual'), 'Location', 301);
    }

    /**
     * Cambia su estado a alta
     * @param Int $id ID de la categoría
     */
    public function Alta($id) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->Mdl_lista->setAlta('Categoria', $id);

        redirect($this->session->userdata('pagina-actual'), 'Location', 301);
    }

    function Modificar($id) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $categoria = $this->Mdl_lista->getCategoria($id); //Consultamos los datos de la categoría
        if (!$categoria) {//Si no existe el proveedor, mostramos error
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        if (!$this->input->post())//Si no existen el post, guardamos en post los datos de la categoria, para que los muestre
            $_POST = $categoria;

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_rules('nombre', 'nombre', 'required');

        $error_nom = "";
        $mensajeok = "";
        
        if ($this->form_validation->run() && $this->NombreCategoria_unico_check($this->input->post('nombre'), $id)) {
            $this->Mdl_lista->update('categoria', $id, $this->input->post()); //Añade los datos del post 
            $mensajeok = '<div class="alert alert-success msgok">¡Se ha modificado correctamente!'
                    . ' <a href="' . site_url('/Administrador/Lista/Categorias') . '" class="link">Volver a la lista</a></div>';
        } else if (!$this->NombreCategoria_unico_check($this->input->post('nombre'), $id)) {
            $error_nom = '<div class="alert msgerror"><b>¡Error! </b> El nombre ya está guardado</div>';
        }

        $cuerpo = $this->load->view('lista/adm_modCategoria', array('id' => $id, 'error_nom' => $error_nom, 'mensajeok' => $mensajeok), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Modificar Categoría', "<i class='fa fa-folder-open fa-lg' aria-hidden='true'></i>" . ' Modificar Categoría');
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    private function getConfigPag() {
        $config['base_url'] = site_url('/Administrador/Lista/Categorias/index');
        $config['total_rows'] = $this->Mdl_lista->getNumTotalCategorias();
        $config['per_page'] = $this->config->item('per_page_categorias');
        $config['uri_segment'] = 5;
        $config['num_links'] = 6;

        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '<span></span></span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
        $config['last_link'] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
        $config['next_link'] = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        return $config;
    }

    /**
     * Comprueba que el nombre de la categoría no esté repetido, sin contar al suyo
     * @param String $nombre Nombre de la categoría
     * @return boolean
     */
    function NombreCategoria_unico_check($nombre, $id) {
        if ($this->Mdl_lista->getCountNombreCategoria($nombre, $id) > 0) {
            return false;
        }

        return true;
    }
}
