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
        $this->load->library('highcharts');
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

        $grafico1 = $this->Grafico1();
        $grafico2 = $this->Grafico2();

        $cuerpo = $this->load->view('adm_index', array('anterior_semana' => $anterior_semana, 'esta_semana' => $esta_semana,
            'anterior_mes' => $anterior_mes, 'este_mes' => $este_mes, 'grafico1' => $grafico1, 'grafico2' => $grafico2), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, '', '<i class="fa fa-pie-chart" aria-hidden="true"></i> Estadísticas');
    }
    
    private function Grafico1(){
        $total = $this->Mdl_estadisticas->getTotalVentas();
        $porcentaje_mayoristas = $this->Porcentaje($total, $this->Mdl_estadisticas->getVentasMayoristas());
        $porcentaje_minoristas = $this->Porcentaje($total, $this->Mdl_estadisticas->getVentasMinoristas());
        
        $serie['data'] = array(
            array('Mayoristas', $porcentaje_mayoristas),
            array('Minoristas', $porcentaje_minoristas)
        );
        
        $callback = "function() { return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}";
              
        @$tool->formatter = $callback;
        @$plot->pie->dataLabels->formatter = $callback;

        $this->highcharts
                ->set_type('pie')
                ->set_serie($serie)
                ->set_tooltip($tool)
                ->set_plotOptions($plot)
                ->set_title('Ventas por tipo de cliente');

        $data['charts'] = $this->highcharts->render();
        
        return $data['charts'];
    }
    
    private function Grafico2(){
        
        $total = $this->Mdl_estadisticas->getTotalFacturas();
        $porcentaje_facturas_pagadas = $this->Porcentaje($total, $this->Mdl_estadisticas->getFacturasPagadas());
        $porcentaje_facturas_no_pagadas = $this->Porcentaje($total, $this->Mdl_estadisticas->getFacturasNoPagadas());
        
        $serie['data'] = array(
            array('Pagadas', $porcentaje_facturas_pagadas),
            array('No pagadas', $porcentaje_facturas_no_pagadas)
        );
        
        $callback = "function() { return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}";
        
        @$tool->formatter = $callback;
        @$plot->pie->dataLabels->formatter = $callback;

        $this->highcharts
                ->set_type('pie')
                ->set_serie($serie)
                ->set_tooltip($tool)
                ->set_plotOptions($plot)
                ->set_title('Facturas');

        $data['charts'] = $this->highcharts->render();
        
        return $data['charts'];
    }

    private function Porcentaje($total, $parte) {
        return round($parte / $total * 100);
    }

}
