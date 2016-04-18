<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->helper('descuentos_helper');       
//        $this->load->library('pagination');
          $this->load->model('Mdl_loginAdmin'); //Cargamos modelo
//        $this->load->library('Carro', 0, 'myCarrito');
    }

    public function index() {
        //$this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual

        if (SesionIniciadaCheck()) {
            redirect("Error404", 'Location', 301);
            return; //Sale de la función
        }

        $this->load->view('login');
    }

    public function Login() {
        if (SesionIniciadaCheck()) {
            redirect("Error404", 'Location', 301);
            return; //Sale de la función
        }
        //----------------------------------------------------
        if ($this->input->post()) {
            $username = $this->input->post('username');
            
            if($this->Mdl_loginAdmin->checkLoginAdmin($username)
                    && password_verify($this->input->post('clave'), $this->Mdl_loginAdmin->getClave($username))){ 
                    //Existe el usuario y la clave es correcto   
                $this->IniciaSesion($username);
                
            }
            else{
                $this->MuestraErrorEnVista();
            }
        } 
    }
    
    private function IniciaSesion($username){
        if (SesionIniciadaCheck()) {
            redirect("Error404", 'Location', 301);
            return; //Sale de la función
        }
        //----------------------------------------------------
        $datos = array(
                'username' => $username,
                'userid' => $this->Mdl_loginAdmin->getId($username),
                'nombre' => $this->Mdl_loginAdmin->getNombre($username),
                'tipo' => 'Administrador'
            );

        $this->session->set_userdata($datos);

        redirect(base_url(), 'Location', 301);
        
    }
    
    public function Logout(){
        if (SesionIniciadaCheck()) {//Sólo puede cerrar sesión si está iniciada, por si entra por url
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('userid');
            $this->session->unset_userdata('tipo');
            $this->session->unset_userdata('nombre');
            
            redirect('Login', 'location', 301); 
        } else {
            redirect('Error404', 'location', 301); 
        }
    }
    
    /**
     * Muestra un error si se ha introducido algún dato incorrecto
     */
    public function MuestraErrorEnVista() {
        $error = "<br><div class='alert msgerror'><b>¡Error!</b> Usuario o contraseña incorrectos</div>";
        $this->load->view('login', Array('error'=>$error));
    }

}