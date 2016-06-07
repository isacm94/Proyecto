<?php
/**
 * MODELO DEL MÓDULO DE VENTA que gestiona el carrito
 */
class Mdl_carrito extends CI_Model {

    public function __construct() {
        $this->load->database();        
    }
    
    /**
     * Consulta los datos de un producto
     * @param Int $id ID del producto
     * @return Array Producto
     */
    public function getProducto($id) {

        $query = $this->db->query("SELECT prod.*, cat.nombre 'categoria' "
                                    . "FROM producto prod "
                                        . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                                            . "WHERE idProducto = $id "
                                                . "AND prod.estado LIKE 'Alta' "
                                                    . "AND cat.estado LIKE 'Alta' ; ");
        
        return $query->row_array();
    }
    
    /**
     * Devuelve el stock de un producto
     * @param Int $id ID de un producto
     * @return Int Número de Stock
     */
    public function getStock($id){
        $query = $this->db->query("SELECT stock "
                                    . "FROM producto "
                                        . "WHERE idProducto = $id; ");
        
        return $query->row_array()['stock'];
        
    }
}
