<?php
/**
 * MODELO DEL MÓDULO DE VENTA
 */
class Mdl_venta extends CI_Model {

    public function __construct() {
        $this->load->database();        
    }
    
    public function getMinoristas() {

        $query = $this->db->query("SELECT nombre, nif, idCliente 'id' "
                . "FROM cliente "
                . "WHERE estado = 'Alta' "
                . "AND tipo LIKE 'Minorista'"
                . "ORDER BY nombre ");

        return $query->result_array();
    }
    
    public function getMayoristas() {

        $query = $this->db->query("SELECT nombre, nif, idCliente 'id' "
                . "FROM cliente "
                . "WHERE estado = 'Alta' "
                . "AND tipo LIKE 'Mayorista'"
                . "ORDER BY nombre ");

        return $query->result_array();
    }
}
