<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que proceso el acceso al perfil de usuario
 */
class Perfil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_perfil');
        $this->load->model('Mdl_login');
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
    }

    /**
     * Muestra la vista con los datos del perfil de usuario
     */
    public function index() {

        if (! SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $datos = $this->Mdl_perfil->getDatosPerfil($this->session->userdata('userid')); //Recuperamos los datos del usuario que está logueado

        $cuerpo = $this->load->view('perfil_usuario/adm_perfil', array('datos' => $datos), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Perfil', 'Mi perfil', 'de Usuario');
    }

    /**
     * Actualiza los datos del perfil del usuario que está logueado
     */
    public function Modificar() {
        if (! SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        
        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErrores();
        $this->setReglasValidacion();

        if ($this->input->post()) {//Si existe post mostramos los datos del post
            $datos = $this->input->post();
        } else {//Sino, los de la bd
            $datos = $this->Mdl_perfil->getDatosPerfil($this->session->userdata('userid')); //Recuperamos los datos del usuario que está logueado
        }

        //Comprobamos si los datos introducidos son correctos
        if ($this->form_validation->run()) { //Validación correcta
            foreach ($this->input->post() as $key => $value) {
                if ($key == 'clave') {
                    $datos['clave'] = password_hash($this->input->post('clave'), PASSWORD_DEFAULT);
                } else {
                    $datos[$key] = $this->input->post($key);
                }
            }
            $this->Mdl_perfil->updateUsuario($this->session->userdata('userid'), $datos); //Hacemos la modificación

            $datos_sesion = array(//Modificamos los datos en la sesión
                'username' => $this->input->post('username'),
                'nombre' => $this->input->post('nombre')
            );
            $this->session->set_userdata($datos_sesion);

            $mensajeok = '<div class="alert alert-success msgok">¡Se ha modificado su usuario correctamente!</div>';

            $cuerpo = $this->load->view('perfil_usuario/adm_perfil', array('datos' => $datos, 'mensajeok' => $mensajeok), true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' | Perfil', 'Mi perfil', 'de Usuario');
        } else {
            $cuerpo = $this->load->view('perfil_usuario/adm_modUser', array('datos' => $datos), true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' | Modificar Perfil', 'Modificar mi perfil', 'de Usuario');
        }
    }

    /**
     * Actualiza la contraseña del usuario que está logueado
     */
    function CambiarClave() {
        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('clave_check', 'Contraseña incorrecta');
        $this->form_validation->set_rules('clave1', 'contraseña nueva', 'required');
        $this->form_validation->set_rules('clave2', 'contraseña nueva repetida', 'required');
        $this->form_validation->set_rules('clave', 'contraseña', 'required|callback_clave_check');

        if ($this->form_validation->run() && $this->input->post('clave1') == $this->input->post('clave2')) { //Validación correcta
            $datos['clave'] = password_hash($this->input->post('clave1'), PASSWORD_DEFAULT);

            //Actualizamos la clave del usuario
            $this->Mdl_perfil->updateUsuario($this->session->userdata('userid'), $datos);

            $mensajeok = '<div class="alert msgok">¡Se ha cambiado su contraseña correctamente!</div>';

            $cuerpo = $this->load->view('perfil_usuario/adm_cambiarClave', Array('mensajeok' => $mensajeok), true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' | Cambiar contraseña', 'Cambiar contraseña', '');
        } else if ($this->input->post('clave1') != $this->input->post('clave2')) {//Contraseña ditintas
            $mensajeerror = "<div class='alert msgerror'><b>¡Error! </b> Las contraseñas no son iguales</div>";

            $cuerpo = $this->load->view('perfil_usuario/adm_cambiarClave', Array('mensajeerror' => $mensajeerror), true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' | Cambiar contraseña', 'Cambiar contraseña', '');
        } else {
            $cuerpo = $this->load->view('perfil_usuario/adm_cambiarClave', '', true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' | Cambiar contraseña', 'Cambiar contraseña', '');
        }
    }

    /* FUNCIONES DE MODIFICAR USUARIO */

    /**
     * Comprueba si un nombre de usuario está ya usado
     * @param String $username Nombre del usuario a comprobar
     * @return boolean
     */
    function UsernameRepetido_check($username) {

        $cont = $this->Mdl_perfil->getCountUsername_mod($username, $this->session->userdata('userid'));

        if ($cont == 0) {//No existen nombres guardados
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Comprueba que la contraseña introducida sea la que está guardada en la base de datos.
     * @param type $clave
     * @return boolean
     */
    function clave_check($clave) {
        if (password_verify($clave, $this->Mdl_login->getClave($this->session->userdata('username')))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario
     */
    function setMensajesErrores() {
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('valid_email', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('UsernameRepetido_check', 'El nombre de usuario ya existe');
        $this->form_validation->set_message('clave_check', 'Contraseña incorrecta');
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario
     */
    function setReglasValidacion() {
        $this->form_validation->set_rules('username', 'nombre de usuario', 'required|callback_UsernameRepetido_check');
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('clave', 'contraseña', 'required|callback_clave_check');
    }

}
