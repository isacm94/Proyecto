<?php
/**
 * MODELO DEL MÓDULO DE VENTA
 */
class Mdl_home extends CI_Model {

    public function __construct() {
        $this->load->database();        
        $this->load->library('pagination');
        $this->load->config("paginacion");
    }
        
    public function getProductos($start, $limit) {

        $query = $this->db->query("SELECT prod.nombre, prod.imagen, prod.descripcion, cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "
                . "AND cat.estado = 'Alta' "
                . "ORDER BY prod.referencia "
                . "LIMIT $start, $limit;");

        return $query->result_array();
    }
    
    public function getNumProductos() {

        $query = $this->db->query("SELECT count(*)'cont' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "
                . "AND cat.estado = 'Alta'"
                . "ORDER BY prod.referencia ");

        return $query->row_array()['cont'];
    }
}
