<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que muestra la vista principal
 */
class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        $this->load->model('Mdl_estadisticas'); //Cargamos modelo
    }

    /**
     * Muestra la vista principal
     * @return type
     */
    public function index() {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $anterior_semana = $this->Mdl_estadisticas->getAnteriorSemana();
        $esta_semana = $this->Mdl_estadisticas->getEstaSemana();
        $anterior_mes = $this->Mdl_estadisticas->getAnteriorMes();
        $este_mes = $this->Mdl_estadisticas->getEsteMes();

        $cuerpo = $this->load->view('adm_index', array('anterior_semana'=>$anterior_semana, 'esta_semana' => $esta_semana, 'anterior_mes' => $anterior_mes, 'este_mes' => $este_mes), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, '', '<i class="fa fa-pie-chart" aria-hidden="true"></i> Estadísticas');
    }

}
