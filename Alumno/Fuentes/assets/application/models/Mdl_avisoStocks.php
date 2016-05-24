<?php

/**
 * MODELO DEL MÓDULO DE ADMINISTRACIÓN relacionado con agregar registros(proveedor, categoría, productos, clientes y usuarios) a la base de datos
 */
class Mdl_avisoStocks extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function getCountStocksBajos($numMaximo) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM producto "
                . "WHERE stock <= $numMaximo ");

        return $query->row_array()['cont'];
    }
    
    public function getProductos($numMaximo, $start, $limit) {

        $query = $this->db->query("SELECT prod.*, cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE stock <= $numMaximo "
                . "ORDER BY prod.referencia "                
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }
}
