<?php
/**
 * MODELO DEL MÓDULO DE VENTA
 */
class Mdl_carrito extends CI_Model {

    public function __construct() {
        $this->load->database();        
    }
    
    public function getProducto($id) {

        $query = $this->db->query("SELECT prod.*, cat.nombre 'categoria' "
                                    . "FROM producto prod "
                                        . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                                        . "WHERE idProducto = $id; ");
        
        return $query->row_array();
    }
    
    /**
     * Devuelve el stock de un producto
     * @param Int $id ID de un producto
     * @return Int
     */
    public function getStock($id){
        $query = $this->db->query("SELECT stock "
                                    . "FROM producto "
                                        . "WHERE idProducto = $id; ");
        
        return $query->row_array()['stock'];
        
    }
}
