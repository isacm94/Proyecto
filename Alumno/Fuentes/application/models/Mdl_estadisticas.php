<?php

/**
 * MODELO DEL MÓDULO DE ADMINISTRACIÓN
 */
class Mdl_estadisticas extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getAnteriorSemana() {
        $this->db->query("SET lc_time_names = 'es_ES'"); //Para que salga el mes en Español

        $query = $this->db->query("SELECT count(*) 'ventas', date_format(curdate()- INTERVAL 7 DAY - (WEEKDAY(curdate())), '%d %M') 'lunes', "
                . "date_format(curdate() - INTERVAL 7 DAY + (6 - WEEKDAY(curdate())), '%d %M') 'domingo' "
                . "FROM albaran "
                . "WHERE YEARWEEK(fecha_albaran, 1) = YEARWEEK(CURDATE() - INTERVAL 7 DAY, 1) ");

        return $query->row_array();
    }

    public function getEstaSemana() {
        $this->db->query("SET lc_time_names = 'es_ES'"); //Para que salga el mes en Español

        $query = $this->db->query("SELECT count(*) 'ventas', date_format(curdate() - (WEEKDAY(curdate())), '%d %M') 'lunes', "
                . "date_format(curdate() + (6 - WEEKDAY(curdate())), '%d %M') 'domingo' "
                . "FROM albaran "
                . "WHERE YEARWEEK(fecha_albaran, 1) = YEARWEEK(CURDATE(), 1)");

        return $query->row_array();
    }

    public function getAnteriorMes() {
        $this->db->query("SET lc_time_names = 'es_ES'"); //Para que salga el mes en Español

        $query = $this->db->query("SELECT count(*) 'ventas', DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%M') 'mes' "
                . "FROM albaran "
                . "WHERE MONTH(fecha_albaran) = MONTH(CURDATE() - INTERVAL 1 MONTH); ");


        return $query->row_array();
    }

    public function getEsteMes() {
        $this->db->query("SET lc_time_names = 'es_ES'"); //Para que salga el mes en Español

        $query = $this->db->query("SELECT count(*) 'ventas', DATE_FORMAT(CURDATE(), '%M') 'mes' "
                . "FROM albaran "
                . "WHERE MONTH(fecha_albaran) = MONTH(CURDATE()); ");


        return $query->row_array();
    }

    public function getTotalVentas() {

        $query = $this->db->query("SELECT count(*) 'num'
                                        FROM albaran; ");


        return $query->row_array()['num'];
    }
    public function getVentasMayoristas() {

        $query = $this->db->query("SELECT count(*) 'num'
                                        FROM albaran a
                                            INNER JOIN cliente c on c.idCliente = a.idcliente 
                                                WHERE c.tipo LIKE 'Mayorista'; ");


        return $query->row_array()['num'];
    }
    
    
    
    public function getVentasMinoristas() {

        $query = $this->db->query("SELECT count(*) 'num'
                                        FROM albaran a
                                            INNER JOIN cliente c on c.idCliente = a.idcliente 
                                                WHERE c.tipo LIKE 'Minorista'; ");


        return $query->row_array()['num'];
    }
    
    public function getTotalFacturas() {

        $query = $this->db->query("SELECT count(*) 'num'
                                        FROM factura; ");


        return $query->row_array()['num'];
    }
    public function getFacturasPagadas() {

        $query = $this->db->query("SELECT count(*) 'num' FROM factura WHERE pendiente_pago LIKE 'No';");

        return $query->row_array()['num'];
    }
    
    
    
    public function getFacturasNoPagadas() {

        $query = $this->db->query("SELECT count(*) 'num' FROM factura WHERE pendiente_pago LIKE 'Sí';");

        return $query->row_array()['num'];
    }
    }
