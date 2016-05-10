<?php
/**
 * MODELO DEL MÓDULO DE VENTA
 */
class Mdl_home extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
        
    public function getImagenes() {

        $query = $this->db->query("SELECT prod.nombre, prod.imagen "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "
                . "AND cat.estado = 'Alta'"
                . "ORDER BY prod.referencia ");

        return $query->result_array();
    }
}
