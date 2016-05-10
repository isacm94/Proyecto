<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que muestra la lista de clientes
 */
class Clientes extends CI_Controller {

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

        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $config = $this->getConfigPag();
        $this->pagination->initialize($config);

        $clientes = $this->Mdl_lista->getClientes($desde, $config['per_page']);

        $cuerpo = $this->load->view('adm_listaClientes', array('clientes' => $clientes), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Lista de Clientes', "<i class='fa fa-users fa-lg' aria-hidden='true'></i>" . ' Lista de Clientes');
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
            $campo = $this->session->userdata('campo'); //Recuperamos el dato del post
        }

        if ($campo == '') {//Si no se ha introducido nada, mostramos la lista completa
            redirect('/Administrador/Lista/Proveedores', 'location', 301);
            return;
        }

        $config = $this->getConfigPagBuscar($campo);
        $this->pagination->initialize($config);

        $clientes = $this->Mdl_lista->BusquedaCliente($campo, $desde, $config['per_page']);

        $sinrdo = "";
        $mensajebuscar = "";

        if (!$clientes) {
            $sinrdo = "No se ha encontrado ningún resultado en la búsqueda de <i>'$campo'</i>. Inténtelo de nuevo o vea la <a href='" . site_url('/Administrador/Lista/Clientes') . "'class=''>lista completa</a>";
        } else {
            $mensajebuscar = "Resultado para la búsqueda <i>'$campo'</i>";
        }

        $cuerpo = $this->load->view('adm_listaClientes', array('clientes' => $clientes, 'mensajebuscar' => $mensajebuscar, 'sinrdo' => $sinrdo), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Lista de Clientes', "<i class='fa fa-users fa-lg' aria-hidden='true'></i>" . ' Lista de Clientes');
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    private function getConfigPagBuscar($campo) {
        $config['base_url'] = site_url('/Administrador/Lista/Clientes/Buscar');
        $config['total_rows'] = $this->Mdl_lista->BusquedaNumClientes($campo);
        $config['per_page'] = $this->config->item('per_page_clientes');
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
        $config['base_url'] = site_url('/Administrador/Lista/Clientes/index');
        $config['total_rows'] = $this->Mdl_lista->getNumTotalClientes();
        $config['per_page'] = $this->config->item('per_page_clientes');
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
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->Mdl_lista->setBaja('Cliente', $id);

        redirect($this->session->userdata('pagina-actual'), 'Location', 301);
    }

    /**
     * Cambia su estado a alta
     * @param Int $id ID del proveedor
     */
    public function Alta($id) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->Mdl_lista->setAlta('Cliente', $id);

        redirect($this->session->userdata('pagina-actual'), 'Location', 301);
    }

    /**
     * Muestra con detalle el proveedor 
     * @param Int $id ID del proveedor
     */
    public function Ver($id) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $cliente = $this->Mdl_lista->getCliente($id);

        if (!$cliente) {//Si no existe el proveedor, mostramos error
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $cuerpo = $this->load->view('adm_detalleCliente', array('cliente' => $cliente), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Detalle del Cliente', "<i class='fa fa-users fa-lg' aria-hidden='true'></i>" . ' Detalle del Cliente');
    }

    /**
     * Actualiza los datos de un cliente
     * @param Int $id ID del cliente
     */
    function Modificar($id) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $cliente = $this->Mdl_lista->getCliente($id); //Consultamos los datos del proveedor
        if (!$cliente) {//Si no existe el cliente, mostramos error
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        if (!$this->input->post())//Si no existen el post, guardamos en post los datos del cliente, para que los muestre
            $_POST = $cliente;

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErrores();
        $this->setReglasValidacion();

        $error_nif = "";
        $mensajeok = "";
        if ($this->form_validation->run() && $this->NIF_unico_check($this->input->post('nif'), $id)) {
            $this->Mdl_lista->update('cliente', $id, $this->input->post()); //Añade los datos del post 
            $mensajeok = '<div class="alert alert-success msgok">¡Se ha modificado correctamente!'
                    . ' <a href="' . site_url('/Administrador/Lista/Clientes') . '" class="link">Volver a la lista</a></div>';
        } else if (!$this->NIF_unico_check($this->input->post('nif'), $id)) {
            $error_nif = '<div class="alert msgerror"><b>¡Error! </b> El NIF ya está guardado</div>';
        }


        //Crea el select para las provincias
        $provincias = $this->Mdl_provincias->getProvincias();
        $select = CreaSelectProvincias($provincias, 'idProvincia');

        $cuerpo = $this->load->view('adm_modCliente', array('selectProvincias' => $select, 'id' => $id, 'error_nif' => $error_nif, 'mensajeok' => $mensajeok), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Modificar Cliente', "<i class='fa fa-users fa-lg' aria-hidden='true'></i>" . ' Modificar Cliente');
    }

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario agregar cliente
     */
    function setMensajesErrores() {
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('NIF_check', 'Formato de NIF incorrecto');
        $this->form_validation->set_message('NIF_unico_check', 'El NIF ya está guardado');
        $this->form_validation->set_message('valid_email', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('exact_length', 'El campo %s debe tener %s caracteres');
        $this->form_validation->set_message('integer', 'El campo %s debe ser números enteros');
        $this->form_validation->set_message('FormatoCorrectoTelefono', 'Formato incorrecto');
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario agregar cliente
     */
    function setReglasValidacion() {
        //Proveedor
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('nif', 'NIF', 'required|callback_NIF_check');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('telefono', 'teléfono', 'required|integer|exact_length[9]|callback_FormatoCorrectoTelefono');
        $this->form_validation->set_rules('cuenta_corriente', 'Cuenta Corriente', 'required|integer|exact_length[20]');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        $this->form_validation->set_rules('direccion', 'dirección', 'required');
        $this->form_validation->set_rules('localidad', 'localidad', 'required');
        $this->form_validation->set_rules('cp', 'Código Postal', 'required|integer|exact_length[5]');
        $this->form_validation->set_rules('idProvincia', 'provincia', 'required');
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

    /**
     * Valida que el NIF introducido no esté en la base de datos, sin contar el suyo
     * @param String $nif
     * @return boolean
     */
    function NIF_unico_check($nif, $id) {
        if ($this->Mdl_lista->getCountNIFCliente($nif, $id) > 0) {
            return false;
        }

        return true;
    }

    /**
     * Función que comprueba que el formato de teléfono sea correcto.
     * El teléfono debe empezar por 9, 8, 6 o 7 seguidor de 8 dígitos del 0 al 9
     * @param String $telefono Número de teléfono
     * @return boolean 
     */
    function FormatoCorrectoTelefono($telefono) {

        $telefono = str_replace(' ', '', $telefono); //devuelve cadena sin espacios
        $telefono = str_replace('-', '', $telefono); //devuelve cadena sin guiones

        $expresion = '/^[9|8|6|7][0-9]{8}$/'; //formato español

        if (preg_match($expresion, $telefono)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
