<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que permite cambiar de plantillas
 */
class ConfigPlantillas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
    }

    /**
     * Muestra la vista con las plantillas disponibles
     */
    public function index() {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        //Datos de las plantillas disponibles del módulo de administración
        $plantillas_admin = array(
            'Admin LTE 2' => array('fichero' => 'adm_template1', 'linkDemo' => 'https://almsaeedstudio.com/themes/AdminLTE/index.html'),
            'Universal' => array('fichero' => 'adm_template2', 'linkDemo' => 'http://universal.ondrejsvestka.cz/1-0/')
        );
        
        //Datos de las plantillas disponibles del módulo de venta
        $plantillas_ven = array(
            'Obaju' => array('fichero' => 'ven_template1', 'linkDemo' => 'http://obaju.ondrejsvestka.cz/'),
            'Corlate' => array('fichero' => 'ven_template2', 'linkDemo' => 'http://shapebootstrap.net/item/1524962-corlate-free-responsive-business-html-template/live-demo')
        );

        $cuerpo = $this->load->view('config_plantillas', array('plantillas_admin' => $plantillas_admin, 'plantillas_ven' => $plantillas_ven), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Configuración Plantillas', "<i class='fa fa-paint-brush fa-lg' aria-hidden='true'></i>" . ' Configuración de Plantillas');
    }

    /**
     * Modifica la plantilla que está usuando el módulo de administración
     * @param String $template Nombre del fichero de la plantilla que se pondrá
     */
    public function CambiaPlantillaAdmin($template = 'adm_template1') {

        if ($template == 'adm_template1' || $template == 'adm_template2') {//Sí se pasa una template existente
            $this->session->set_userdata(array('template-adm-activa' => $template)); //Guarda en la sesión la plantilla usada

            redirect(site_url('/Administrador/ConfigPlantillas'), 'location', 301); //Vuelve a la página en la que estaba
        } else {
            redirect('Error404', 'location', 301);
        }
    }
    
    /**
     * Modifica la plantilla que está usuando el módulo de venta
     * @param String $template Nombre del fichero de la plantilla que se pondrá
     */
    public function CambiaPlantillaVenta($template = 'ven_template1') {

        if ($template == 'ven_template1' || $template == 'ven_template2') {//Sí se pasa una template existente
            $this->session->set_userdata(array('template-ven-activa' => $template)); //Guarda en la sesión la plantilla usada

            redirect(site_url('/Administrador/ConfigPlantillas'), 'location', 301); //Vuelve a la página en la que estaba
        } else {
            redirect('Error404', 'location', 301);
        }
    }

}
