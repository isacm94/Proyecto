<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que muestra un mensaje de error 404. 
 * Está configurado, a tráves del archivo de configuración 'routes.php' en el parámetro $route['404_override'], para que sea el mensaje a mostrar por defecto.
 */
class Perfil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_perfil');
        $this->load->model('Mdl_loginAdmin');
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
    }

    /**
     * Muestra la vista del error404
     */
    public function index() {
        $datos = $this->Mdl_perfil->getDatosPerfil($this->session->userdata('userid')); //Recuperamos los datos del usuario que está logueado

        $cuerpo = $this->load->view('adm_perfil', array('datos' => $datos), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Perfil', 'Mi perfil', 'de Usuario');
    }

    public function Modificar() {

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        //Establecemos los mensajes de errores
        $this->setMensajesErrores();
        //Establecemos reglas de validación para el formulario
        $this->setReglasValidacion();

        if ($this->input->post()) {//Si existe post mostramos los datos del post
            $datos['username'] = $this->input->post('username');
            $datos['nombre'] = $this->input->post('nombre');
            $datos['correo'] = $this->input->post('correo');
        } else {//Sino, los de la bd
            $datos = $this->Mdl_perfil->getDatosPerfil($this->session->userdata('userid')); //Recuperamos los datos del usuario que está logueado
        }

        //Comprobamos si los datos introducidos son correctos
        if ($this->form_validation->run()) { //Validación correcta
            $datos['username'] = $this->input->post('username');
            $datos['nombre'] = $this->input->post('nombre');
            $datos['correo'] = $this->input->post('correo');

            $this->Mdl_perfil->updateUsuario($this->session->userdata('userid'), $datos); //Hacemos la modificación

            $datos_sesion = array(//Modificamos los datos en la sesión
                'username' => $this->input->post('username'),
                'nombre' => $this->input->post('nombre')
            );
            $this->session->set_userdata($datos_sesion);

            $mensajeok = '<div class="alert alert-success msgok">¡Se ha modificado su usuario correctamente!</div>';

            $cuerpo = $this->load->view('adm_perfil', array('datos' => $datos, 'mensajeok' => $mensajeok), true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' - Modificar Perfil', 'Modificar mi perfil', 'de Usuario');
        } else {
            $cuerpo = $this->load->view('adm_modUser', array('datos' => $datos), true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' - Modificar Perfil', 'Modificar mi perfil', 'de Usuario');
        }
    }

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
            
            $cuerpo = $this->load->view('adm_cambiarClave', Array('mensajeok' => $mensajeok), true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' - Cambiar contraseña', 'Cambiar contraseña', '');
        } else if ($this->input->post('clave1') != $this->input->post('clave2')) {//Contraseña ditintas
            $mensajeerror = "<div class='alert msgerror'><b>¡Error! </b> Las contraseñas no son iguales</div>";

            $cuerpo = $this->load->view('adm_cambiarClave', Array('mensajeerror' => $mensajeerror), true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' - Cambiar contraseña', 'Cambiar contraseña', '');
        } else {
            $cuerpo = $this->load->view('adm_cambiarClave', '', true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' - Cambiar contraseña', 'Cambiar contraseña', '');
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

    function clave_check($clave) {
        if (password_verify($clave, $this->Mdl_loginAdmin->getClave($this->session->userdata('username')))) {
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
