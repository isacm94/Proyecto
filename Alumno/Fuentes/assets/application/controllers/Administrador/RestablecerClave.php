<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR en el que se lleva a cabo el proceso de cambiar la contraseña de usuario a tráves del correo.
 */
class RestablecerClave extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_restablecerClave');
        $this->load->library('email');
    }

    /**
     * Muestra el formulario que pide el nombre de usuario para enviar el correo, si el usuario no existe muestra un mensaje de error y si existe se envia el correo y muestra un mensaje de éxito.
     */
    public function index() {
        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_rules('username', 'nombre de usuario', 'required');

        if ($this->form_validation->run()) {
            $datos = $this->Mdl_restablecerClave->getDatosFromUsername($this->input->post('username'));
            $this->EnviaCorreo($datos);
        } else {
            $this->load->view('restablecerClave');
        }
    }

    /**
     * Envia un correo para que restablezca la contraseña con los datos especificados
     * @param Array $datos Datos del usuario
     */
    private function EnviaCorreo($datos) {

        $this->email->from('aula4@iessansebastian.com', "Shop's Admin");
        $this->email->to($datos['correo']);

        $this->email->subject("Restablece la contraseña en Shop's Admin");

        $mensaje = "<p><a href='" . site_url("/Administrador/RestablecerClave/Restablece/" . $datos['id'] . "/" . $this->getTonken($datos['id'], $datos['nombre']))."'>Restablece la contraseña accediendo a esta dirección</a></p>";
        $this->email->message($mensaje);

        if (! $this->email->send()) {
            $this->load->view('mailIncorrecto', array('link' => '<p><a href="' . site_url('/Administrador/Login') . '">Login</a></p>'));
        } else {
            $this->load->view('mailCorrecto', array('link' => '<p><a href="' . site_url('/Administrador/Login') . '">Accede a la aplicación</a></p>'));
        }
    }

    /**
     * Devuelve un string encriptado formado por los datos de un usuario
     * @param Int $id ID del usuario
     * @param String $dni DNI del usuario
     * @param String $nombre Nombre del usuario
     * @return String Token generado
     */
    private function getTonken($id, $nombre) {
        return sha1($id . $nombre);
    }

    /**
     * Permite a un usuario restablecer su contraseña de usuario con el correo. Se manda una url con el id y un token, si ese id y token son corectos se le permite modificar la contraseña sino no.
     * @param Int $id ID del usuario
     * @param String $token Token generado
     */
    public function Restablece($id, $token) {
        $datos = $this->Mdl_restablecerClave->getDatosFromId($id);

        if (!$datos) {
            redirect('Error404', 'Location', 306);
            return;
        }

        if ($this->getTonken($datos['id'], $datos['nombre']) == $token) {
            $this->PideClaveRestablecer($datos['username']);
        } else {
            redirect('Error404', 'Location', 306);
        }
    }

    /**
     * Muestra el formulario para cambiar la contraseña desde el correo
     * @param String $username Nombre del usuario
     */
    public function PideClaveRestablecer($username) {

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('ClavesIguales_check', 'Las contraseñas deben ser iguales');
        $this->form_validation->set_rules('clave', 'contraseña', 'required');
        $this->form_validation->set_rules('clave_rep', 'repita contraseña', 'required|callback_ClavesIguales_check');

        if ($this->form_validation->run() == FALSE) {
            $tipo = $this->Mdl_restablecerClave->getTipoUsuario($username);//Guardamos el tipo para mostrar una imagen u otra
            $imagen = $tipo=='Administrador'?'admin':'empleado';
            $this->load->view('pideClaveRestablecer', Array('username' => $username, 'imagen'=>$imagen));
        } else {
            $this->Mdl_restablecerClave->UpdateClave($username, password_hash($this->input->post('clave'), PASSWORD_DEFAULT));
            
           $this->load->view('claveCorrecta', Array('link'=>  site_url('/Administrador/Login')));
        }
    }

    /**
     * Comprueba si dos contraseñas introducidas son correctas
     * @return boolean
     */
    public function ClavesIguales_check() {
        if ($this->input->post('clave') == $this->input->post('clave_rep'))
            return TRUE;
        else
            return FALSE;
    }

}
