<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que muestra un mensaje de error 404. 
 * Está configurado, a tráves del archivo de configuración 'routes.php' en el parámetro $route['404_override'], para que sea el mensaje a mostrar por defecto.
 */
class Error404 extends CI_Controller {
    
    public function __construct() {
        parent::__construct();    
        $this->load->library('Carro', 0, 'myCarrito');
    }
    /**
     * Muestra la vista del error404
     */
    public function index() {
        $cuerpo = $this->load->view('View_error404', Array('' => ''), true);
        $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Error'));
    }
}
