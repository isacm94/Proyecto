<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que muestra la lista de usuarios
 */
class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_lista');
        $this->load->library('pagination');
        $this->load->config("paginacion");
    }

    /**
     * Muestra el listado paginado de todos los usuarios en forma de tabla
     * @param Int $desde Desde el registro que tiene que mostrar en la paginación
     */
    public function index($desde = 0) {
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual

        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $config = $this->getConfigPag();
        $this->pagination->initialize($config);

        $usuarios = $this->Mdl_lista->getUsuarios($desde, $config['per_page']);

        $cuerpo = $this->load->view('lista/adm_listaUsuarios', array('usuarios' => $usuarios), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Lista de Usuarios', "<i class='fa fa-user fa-lg' aria-hidden='true'></i>" . ' Lista de Usuarios');
    }

    /**
     * Busca en la tabla de usuarios de la base de datos por el campo introducido y muestra los resultados obtenidos en una tabla paginada
     * @param Int $desde Desde el registro que tiene que mostrar en la paginación
     */
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
            redirect('/Administrador/Lista/Usuarios', 'location', 301);
            return;
        }
        
        $config = $this->getConfigPagBuscar($campo);
        $this->pagination->initialize($config);

        $usuarios = $this->Mdl_lista->BusquedaUsuario($campo, $desde, $config['per_page']);
        
        $sinrdo = "";
        $mensajebuscar = "";
        
        if (! $usuarios) {//No se ha encontrado nada
            $sinrdo = "No se ha encontrado ningún resultado en la búsqueda de <i>'$campo'</i>. Inténtelo de nuevo o vea la <a href='" . site_url('/Administrador/Lista/Usuarios') . "'class=''>lista completa</a>";
        } else {
            $mensajebuscar = "Resultado para la búsqueda <i>'$campo'</i>";
        }

        $cuerpo = $this->load->view('lista/adm_listaUsuarios', array('usuarios' => $usuarios, 'mensajebuscar'=>$mensajebuscar, 'sinrdo'=>$sinrdo), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Lista de Usuarios', "<i class='fa fa-user fa-lg' aria-hidden='true'></i>" . ' Lista de Usuarios');
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    private function getConfigPagBuscar($campo) {
        $config['base_url'] = site_url('/Administrador/Lista/Usuarios/Buscar');
        $config['total_rows'] = $this->Mdl_lista->BusquedaNumUsuarios($campo);
        $config['per_page'] = $this->config->item('per_page_usuarios');
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
        $config['base_url'] = site_url('/Administrador/Lista/Usuarios/index');
        $config['total_rows'] = $this->Mdl_lista->getNumTotalUsuarios();
        $config['per_page'] = $this->config->item('per_page_usuarios');
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
     * @param Int $id ID del cliente
     */
    public function Baja($id) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->Mdl_lista->setBaja('Usuario', $id);

        redirect($this->session->userdata('pagina-actual'), 'Location', 301);
    }

    /**
     * Cambia su estado a alta
     * @param Int $id ID del cliente
     */
    public function Alta($id) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->Mdl_lista->setAlta('Usuario', $id);

        redirect($this->session->userdata('pagina-actual'), 'Location', 301);
    }


    

}
