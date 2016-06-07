<?php

/**
 * MODELO DEL MÓDULO DE ADMINISTRACIÓN relacionado con el aviso de productos con stocks bajos
 */
class Mdl_avisoStocks extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    /**
     * Consulta el número de productos que tienen stock bajo
     * @param Int $stockbajo Número a partir del cual se considera que un producto tiene stock bajo
     * @return Int Nº de productos
     */
    public function getCountStocksBajos($stockbajo) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM producto "
                . "WHERE stock <= $stockbajo ");

        return $query->row_array()['cont'];
    }
    
    /**
     * Consulta todos los productos que tienen stock bajo
     * @param Int $stockbajo Número a partir del cual se considera que un producto tiene stock bajo
     * @param Int $start Desde el registro que empieza a consultar(Para la paginación)
     * @param Int $limit Hasta el registro que empieza a consultar(Para la paginación)
     * @return Array Productos con stocks bajos
     */
    public function getProductos($stockbajo, $start, $limit) {

        $query = $this->db->query("SELECT prod.*, cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE stock <= $stockbajo "
                . "ORDER BY prod.referencia "                
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }
}
