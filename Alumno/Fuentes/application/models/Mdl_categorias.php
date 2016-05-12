<?php

/**
 * MODELO DEL MÓDULO DE VENTA
 */
class Mdl_categorias extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getCategorias(){
        $query = $this->db->query("SELECT idCategoria 'id', nombre "
                . "FROM categoria "
                . "WHERE estado = 'Alta'");

        return $query->result_array();
    }
    
    public function getProductos($id, $start, $limit) {

        $query = $this->db->query("SELECT prod.nombre, prod.imagen, prod.descripcion, cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "                
                . "AND cat.estado = 'Alta' "
                . "AND cat.idCategoria = $id "
                . "ORDER BY prod.referencia "
                . "LIMIT $start, $limit;");

        return $query->result_array();
    }
    
    public function getNumProductos($id) {

        $query = $this->db->query("SELECT count(*)'cont' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "
                . "AND cat.estado = 'Alta' "
                . "AND cat.idCategoria = $id ");

        return $query->row_array()['cont'];
    }
    
    public function getNombreCategoria($id){
        $query = $this->db->query("SELECT nombre "
                . "FROM categoria "
                . "WHERE idCategoria = $id ");

        return $query->row_array()['nombre'];
    }
}
