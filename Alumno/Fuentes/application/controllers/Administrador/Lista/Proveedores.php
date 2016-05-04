<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que muestra la lista de proveedores
 */
class Proveedores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_lista');
        $this->load->model('Mdl_provincias');
        $this->load->helper('creaselect_helper');
        $this->load->library('pagination');
        $this->load->config("paginacion");
        $this->load->helper('nif_validate_helper');
    }

    public function index($desde = 0) {
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual

        if (!SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $config = $this->getConfigPag();
        $this->pagination->initialize($config);

        $proveedores = $this->Mdl_lista->getProveedores($desde, $config['per_page']);

        $cuerpo = $this->load->view('adm_listaProveedores', array('proveedores' => $proveedores), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Lista de Proveedores', "<i class='fa fa-truck fa-lg' aria-hidden='true'></i>" . ' Lista de Proveedores');
    }

    function Buscar($desde = 0) {  
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        
        if (!SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
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
            redirect('/Administrador/Lista/Proveedores', 'location', 301);
            return;
        }
        
        $config = $this->getConfigPagBuscar($campo);
        $this->pagination->initialize($config);

        $proveedores = $this->Mdl_lista->BusquedaProveedor($campo, $desde, $config['per_page']);
        
        $sinrdo = "";
        $mensajebuscar = "";
        
        if (! $proveedores) {
            $sinrdo = "No se ha encontrado ningún resultado en la búsqueda de <i>'$campo'</i>. Inténtelo de nuevo o vea la <a href='" . site_url('/Administrador/Lista/Proveedores') . "'class=''>lista completa</a>";
        } else {
            $mensajebuscar = "Resultado para la búsqueda <i>'$campo'</i>";
        }

        $cuerpo = $this->load->view('adm_listaProveedores', array('proveedores' => $proveedores, 'mensajebuscar'=>$mensajebuscar, 'sinrdo'=>$sinrdo), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Lista de Proveedores', "<i class='fa fa-truck fa-lg' aria-hidden='true'></i>" . ' Lista de Proveedores');
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    private function getConfigPagBuscar($campo) {
        $config['base_url'] = site_url('/Administrador/Lista/Proveedores/Buscar');
        $config['total_rows'] = $this->Mdl_lista->BusquedaNumProveedores($campo);
        $config['per_page'] = $this->config->item('per_page_proveedores');
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
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    private function getConfigPag() {
        $config['base_url'] = site_url('/Administrador/Lista/Proveedores/index');
        $config['total_rows'] = $this->Mdl_lista->getNumTotalProveedores();
        $config['per_page'] = $this->config->item('per_page_proveedores');
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
     * @param Int $id ID del proveedor
     */
    public function Baja($id) {
        if (!SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->Mdl_lista->setBaja('Proveedor', $id);

        redirect($this->session->userdata('pagina-actual'), 'Location', 301);
    }

    /**
     * Cambia su estado a alta
     * @param Int $id ID del proveedor
     */
    public function Alta($id) {
        if (!SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->Mdl_lista->setAlta('Proveedor', $id);

        redirect($this->session->userdata('pagina-actual'), 'Location', 301);
    }

    /**
     * Muestra con detalle el proveedor 
     * @param Int $id ID del proveedor
     */
    public function Ver($id) {
        if (!SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $proveedor = $this->Mdl_lista->getProveedor($id);

        if (!$proveedor) {//Si no existe el proveedor, mostramos error
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $cuerpo = $this->load->view('adm_detalleProveedor', array('proveedor' => $proveedor), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Detalle del Proveedor', "<i class='fa fa-truck fa-lg' aria-hidden='true'></i>" . ' Detalle del Proveedor');
    }

    /**
     * Actualiza los datos de un proveedor
     * @param Int $id ID del proveedor
     */
    function Modificar($id) {
        if (!SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $proveedor = $this->Mdl_lista->getProveedor($id); //Consultamos los datos del proveedor
        if (!$proveedor) {//Si no existe el proveedor, mostramos error
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        if (!$this->input->post())//Si no existen el post, guardamos en post los datos del proveedor, para que los muestre
            $_POST = $proveedor;

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErrores();
        $this->setReglasValidacion();

        $error_nom = "";
        $mensajeok = "";
        if ($this->form_validation->run() && $this->NombreProveedor_unico_check($this->input->post('nombre'), $id)) {
            $this->Mdl_lista->update('proveedor', $id, $this->input->post()); //Añade los datos del post 
            $mensajeok = '<div class="alert alert-success msgok">¡Se ha modificado correctamente!'
                    . ' <a href="' . site_url('/Administrador/Lista/Proveedores') . '" class="link">Volver a la lista</a></div>';
        } else if (!$this->NombreProveedor_unico_check($this->input->post('nombre'), $id)) {
            $error_nom = '<div class="alert msgerror"><b>¡Error! </b> El nombre ya está guardado</div>';
        }


        //Crea el select para las provincias
        $provincias = $this->Mdl_provincias->getProvincias();
        $select = CreaSelectProvincias($provincias, 'idProvincia');

        $cuerpo = $this->load->view('adm_modProveedor', array('selectProvincias' => $select, 'id' => $id, 'error_nom' => $error_nom, 'mensajeok' => $mensajeok), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Modificar Proveedor', "<i class='fa fa-truck fa-lg' aria-hidden='true'></i>" . ' Modificar Proveedor');
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
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('idProvincia', 'provincia', 'required');
        $this->form_validation->set_rules('nif', 'NIF', 'required|callback_NIF_check');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('direccion', 'dirección', 'required');
        $this->form_validation->set_rules('localidad', 'localidad', 'required');
        $this->form_validation->set_rules('cp', 'Código Postal', 'required|integer|exact_length[5]');
    }

    /**
     * Comprueba que el nombre del proveedor no esté repetido, sin contar al suyo
     * @param String $nombre Nombre del proveedor
     * @return boolean
     */
    function NombreProveedor_unico_check($nombre, $id) {
        if ($this->Mdl_lista->getCountNombreProveedor($nombre, $id) > 0) {
            return false;
        }

        return true;
    }

    /**
     * Valida que el NIF tenga un formato correcto
     * @param String $NIF NIF
     * @return boolean
     */
    function NIF_check($NIF) {
        if (isValidNIF($NIF)) {
            return true;
        } else {
            return false;
        }
    }

}
