<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class ConfigPlantillas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
    }

    public function index() {
        if (!SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $plantillas_admin = array(
            'Admin LTE 2' => array('fichero' => 'adm_template1', 'linkDemo' => 'https://almsaeedstudio.com/themes/AdminLTE/index.html'),
            'Universal' => array('fichero' => 'adm_template2', 'linkDemo' => 'http://universal.ondrejsvestka.cz/1-0/')
        );

        $cuerpo = $this->load->view('config_plantillas', array('plantillas_admin' => $plantillas_admin), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Configuración Plantillas', "<i class='fa fa-paint-brush fa-lg' aria-hidden='true'></i>" . ' Configuración de Plantillas');
    }

    public function CambiaPlantillaAdmin($template = 'adm_template1') {

        if ($template == 'adm_template1' || $template == 'adm_template2') {//Sí se pasa una template existente
            $this->session->set_userdata(array('template-adm-activa' => $template)); //Guarda en la sesión la plantilla usada

            redirect(base_url() . 'ConfigPlantillas', 'location', 301); //Vuelve a la página en la que estaba
        } else {
            redirect('Error404', 'location', 301);
        }
    }

}
