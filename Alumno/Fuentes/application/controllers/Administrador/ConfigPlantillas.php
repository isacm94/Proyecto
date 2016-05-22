<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que permite cambiar de plantillas
 */
class ConfigPlantillas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        $this->load->config("templates");
        $this->load->model('Mdl_templates');
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
        $plantillas_admin = $this->config->item("plantillas_admin");

        //Datos de las plantillas disponibles del módulo de venta
        $plantillas_ven = $this->config->item("plantillas_venta");

        $plant_adm_activa = $this->Mdl_templates->getTemplateActivaAdmin();
        $plant_venta_activa = $this->Mdl_templates->getTemplateActivaVenta();

        $cuerpo = $this->load->view('config_plantillas', array('plantillas_admin' => $plantillas_admin, 'plantillas_ven' => $plantillas_ven, 'plant_adm_activa' => $plant_adm_activa, 'plant_venta_activa' => $plant_venta_activa), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Configuración Plantillas', "<i class='fa fa-paint-brush fa-lg' aria-hidden='true'></i>" . ' Configuración de Plantillas');
    }

    /**
     * Modifica la plantilla que está usuando el módulo de administración
     * @param String $template Nombre del fichero de la plantilla que se pondrá
     */
    public function CambiaPlantillaAdmin($template = 'adm_template1') {

        if (in_array($template, $this->config->item("plant_admin_existentes"))) {
            $this->Mdl_templates->UpdateTemplateActiva('Administración', $template); //Cambiamos la plantilla

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

        if (in_array($template, $this->config->item("plant_venta_existentes"))) {//Sí se pasa una template existente
            $this->Mdl_templates->UpdateTemplateActiva('Venta', $template); //Cambiamos la plantilla

            redirect(site_url('/Administrador/ConfigPlantillas'), 'location', 301); //Vuelve a la página en la que estaba
        } else {
            redirect('Error404', 'location', 301);
        }
    }

}
