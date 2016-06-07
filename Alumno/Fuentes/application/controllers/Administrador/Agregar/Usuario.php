<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que realiza el proceso de añadir un usuario
 */
class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        $this->load->model('Mdl_agregar');
        $this->load->library('email');
    }

    /**
     * Muestra y valida el formulario de agregar usuario
     */
    public function index() {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErrores();
        $this->setReglasValidacion();

        if ($this->form_validation->run()) {

            foreach ($this->input->post() as $key => $value) {//Guarda los datos del posts
                $data[$key] = $value;
            }

            $clave = $this->generaPasswordAleatoria(); //Generamos una contraseña aleatoria
            $data['clave'] = password_hash($clave, PASSWORD_DEFAULT); //Codificamos la contraseña y la guardamos
            //Envía un correo al usuario con su usuario y contraseña
            //Y si se envia el correo correctamente, guarda el usuario
            if ($this->EnviaCorreo(array('username' => $data['username'], 'password' => $clave, 'correo' => $data['correo']))) {
                $this->Mdl_agregar->add('usuario', $data);
            }
        } else {
            $cuerpo = $this->load->view('agregar/adm_addUsuario', array('' => ''), true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' | Agregar Usuario', "<i class='fa fa-user fa-lg' aria-hidden='true'></i>" . ' Agregar Usuario');
        }
    }

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario agregar usuario
     */
    function setMensajesErrores() {
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('NombreProveedor_unico_check', 'El nombre ya está guardado');
        $this->form_validation->set_message('valid_email', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('Username_unico_check', 'El nombre de usuario ya está guardado');
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario agregar usuario
     */
    function setReglasValidacion() {
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('username', 'nombre de usuario', 'required|callback_Username_unico_check');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
    }

    /**
     * Comprueba que el nombre de usuario no esté guardado
     * @param String $username Nombre de usuario
     * @return boolean
     */
    function Username_unico_check($username) {
        if ($this->Mdl_agregar->getCountUsername($username) > 0) {
            return false;
        }

        return true;
    }

    /**
     * Devuelve una contraseña generada aleatoriamente con letras y números
     * @return String Contraseña generada
     */
    function generaPasswordAleatoria() {
        //Se define una cadena de caractares
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";

        $longitudCadena = strlen($cadena); //Obtenemos la longitud de la cadena de caracteres

        $password = "";

        $longitudPass = 10; //Longitud que tendrá la contraseña
        //Creamos la contraseña
        for ($i = 1; $i <= $longitudPass; $i++) {
            //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
            $pos = rand(0, $longitudCadena - 1);

            //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
            $password .= substr($cadena, $pos, 1);
        }

        return $password;
    }

    /**
     * Envía un correo electrónico al usuario con su nombre de usuario y su contrasña
     * @param Array $datos Datos del usuario
     * @return boolean Si se envió correctamente el correo
     */
    private function EnviaCorreo($datos) {
        $this->email->from('aula4@iessansebastian.com', "Shop's Admin");
        $this->email->to($datos['correo']);

        $this->email->subject("Bienvenido a Shop's Admin");

        $mensaje = "<h2>Has sido dado de alta en Shop's Admin</h2>";
        $mensaje .="<p><b>Nombre de usuario: </b>" . $datos['username'] . "</p>";
        $mensaje .= "<p><b>Contraseña: </b>" . $datos['password'] . "</p>";
        $mensaje .= "<p><a href='" . site_url() . "'>Pincha aquí para acceder a la aplicación</a></p>";
        $this->email->message($mensaje);

        if (!$this->email->send()) { //Si el envío del correo ha ido mal, mostramos mensaje de error
            $cuerpo = $this->load->view('agregar/mailIncorrecto', array('link' => '<p><a href="' . site_url('/Administrador/Agregar/Usuario') . '">Agregar Usuario</a></p>'), true);
            CargaPlantillaAdmin($cuerpo, ' | Envío incorrecto', "Envío de mail incorrecto");
            return FALSE;
        } else {
            $cuerpo = $this->load->view('agregar/mailCorrecto', array('link' => '<p><a href="' . site_url("/Administrador") . '">Pulse aquí para volver a la página principal</a></p>'), true);
            CargaPlantillaAdmin($cuerpo, ' | Envío correcto', "Envío de mail correcto");
            return TRUE;
        }
    }

}
