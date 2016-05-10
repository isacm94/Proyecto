<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE VENTA que procesa el logueo en la aplicación
 */
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
          $this->load->model('Mdl_login'); //Cargamos modelo
    }

    /**
     * Muestra el formulario del login
     */
    public function index() {
        if (SesionIniciadaCheck()) {
            redirect("Error404", 'Location', 301);
            return; //Sale de la función
        }

        $this->load->view('ven_login');
    }

    /**
     * Valida el formulario del login
     */
    public function Login() {
        if (SesionIniciadaCheck()) {
            redirect("Error404", 'Location', 301);
            return; //Sale de la función
        }
        //----------------------------------------------------
        if ($this->input->post()) {
            $username = $this->input->post('username');
            
            if($this->Mdl_login->checkLogin($username)
                    && password_verify($this->input->post('clave'), $this->Mdl_login->getClave($username))){ 
                    //Existe el usuario y la clave es correcta
                $this->IniciaSesion($username);
                
            }
            else{
                $this->MuestraErrorEnVista();
            }
        } 
    }
    
    /**
     * Guarda los datos del usuario en la sesión
     * @param String $username Nombre de usuario
     */
    private function IniciaSesion($username){
        if (SesionIniciadaCheckAdmin()) {
            redirect("Error404", 'Location', 301);
            return; //Sale de la función
        }
        //----------------------------------------------------
        $datos = array(
                'username' => $username,
                'userid' => $this->Mdl_login->getId($username),
                'nombre' => $this->Mdl_login->getNombre($username),
                'tipo' =>  $this->Mdl_login->getTipo($username),
            );

        $this->session->set_userdata($datos);

        redirect($this->session->userdata('pagina-actual'), 'Location', 301);
        
    }
    
    /**
     * Cierra la sesión, es decir, elimina los datos correspondientes al usuario en la sesión
     */
    public function Logout(){
        if (SesionIniciadaCheckAdmin()) {//Sólo puede cerrar sesión si está iniciada, por si entra por url
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('userid');
            $this->session->unset_userdata('tipo');
            $this->session->unset_userdata('nombre');
            
            redirect('/Administrador/Login', 'location', 301); 
        } else {
            redirect('Error404', 'location', 301); 
        }
    }
    
    /**
     * Muestra un error si se ha introducido algún dato incorrecto
     */
    public function MuestraErrorEnVista() {
        $error = "<br><div class='alert msgerror'><b>¡Error!</b> Usuario o contraseña incorrectos</div>";
        $this->load->view('ven_login', Array('error'=>$error));
    }

}
