<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que muestra un mensaje de error 404. 
 * Está configurado, a tráves del archivo de configuración 'routes.php' en el parámetro $route['404_override'], para que sea el mensaje a mostrar por defecto.
 */
class Error404 extends CI_Controller {
    
    public function __construct() {
        parent::__construct();    
    }
    /**
     * Muestra la vista del error404
     */
    public function index() {
        $this->session->set_userdata(array('pagina-actual'  => current_url())); //Guardamos la URL actual
        
        $cuerpo = $this->load->view('error404', '', true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Error 404');
    }
}
