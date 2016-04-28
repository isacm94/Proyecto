<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        $this->load->model('Mdl_agregar');
        $this->load->library('email');
    }

    public function index() {
        if (!SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }


        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErrores();
        $this->setReglasValidacion();

        if ($this->form_validation->run()) {
            $data['nombre'] = $this->input->post('nombre');
            $data['username'] = $this->input->post('username');
            $data['correo'] = $this->input->post('correo');
            $data['tipo'] = $this->input->post('tipo');
            
            $clave = $this->generaPasswordAleatoria();//Generamos una contraseña aleatoria
            $data['clave'] = password_hash($clave, PASSWORD_DEFAULT);//Codificamos la contraseña y la guardamos
                    
            $this->EnviaCorreo(array('username' => $data['username'], 'password'=>$clave, 'correo' => $data['correo']));//Le enviamos al usuario su contraseña
            //con esto podemos ver el resultado
		var_dump($this->email->print_debugger());
            $this->Mdl_agregar->add('usuario', $data);
        }

        $cuerpo = $this->load->view('adm_addUsuario', array('' => ''), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Usuario', "<i class='fa fa-user fa-lg' aria-hidden='true'></i>" . ' Agregar Usuario');
    }

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario agregar proveedor
     */
    function setMensajesErrores() {
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('NombreProveedor_unico_check', 'El nombre ya está guardado');
        $this->form_validation->set_message('valid_email', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('Username_unico_check', 'El nombre de usuario ya está guardado');
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario agregar proveedor
     */
    function setReglasValidacion() {
        //Proveedor
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('username', 'nombre de usuario', 'required|callback_Username_unico_check');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
    }

    function Username_unico_check($username) {
        if ($this->Mdl_agregar->getCountUsername($username) > 0) {
            return false;
        }

        return true;
    }

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

    private function EnviaCorreo($datos) {
        $this->email->from('aula4@iessansebastian.com', "Shop's Admin");
        $this->email->to($datos['correo']);

        $this->email->subject("Bienvenido a Shop's Admin");

        $this->email->message("<h1>Has sido dado de alta en Shop's Admin</h1>");
        $this->email->message("<p><b>Nombre de usuario: </b>".$datos['username']."</p>");
        $this->email->message("<p><b>Contraseña: </b>". $datos['password']."</p>");

        if (!$this->email->send())
            echo "<pre>\n\nError enviado mail\n</pre>";
        else
            echo "<pre>\n\nMail enviado correctamente\n</pre>";
    }

}
