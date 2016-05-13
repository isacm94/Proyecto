<?php
/**
 * MODELO DEL MÓDULO DE VENTA
 */
class Mdl_tienda extends CI_Model {

    public function __construct() {
        $this->load->database();        
    }
    
    /*HOME*/
    public function getProductos($start, $limit) {

        $query = $this->db->query("SELECT prod.nombre, prod.imagen, prod.descripcion, prod.precio_venta 'precio', prod.idProducto 'id', cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "
                . "AND cat.estado = 'Alta' "
                . "AND stock > 0 "
                . "ORDER BY prod.referencia "
                . "LIMIT $start, $limit;");

        return $query->result_array();
    }
    
    public function getNumProductos() {

        $query = $this->db->query("SELECT count(*)'cont' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "
                . "AND stock > 0 "
                . "AND cat.estado = 'Alta'");

        return $query->row_array()['cont'];
    }
    
    /*CATEGORIAS*/
    public function getCategorias(){
        $query = $this->db->query("SELECT idCategoria 'id', nombre "
                . "FROM categoria "
                . "WHERE estado = 'Alta'");

        return $query->result_array();
    }
    
    public function getProductosFromCategoria($id, $start, $limit) {

        $query = $this->db->query("SELECT prod.idproducto 'id', prod.nombre, prod.imagen, prod.precio_venta 'precio', prod.descripcion, cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "                
                . "AND cat.estado = 'Alta' "
                . "AND cat.idCategoria = $id "
                . "AND stock > 0 "
                . "ORDER BY prod.referencia "
                . "LIMIT $start, $limit;");

        return $query->result_array();
    }
    
    public function getNumProductosFromCategoria($id) {

        $query = $this->db->query("SELECT count(*)'cont' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "
                . "AND cat.estado = 'Alta' "
                . "AND stock > 0 "
                . "AND cat.idCategoria = $id ");

        return $query->row_array()['cont'];
    }
    
    public function getNombreCategoria($id){
        $query = $this->db->query("SELECT nombre "
                . "FROM categoria "
                . "WHERE idCategoria = $id ");

        return $query->row_array()['nombre'];
    }
    
    /*DETALLE DE UN PRODUCTO*/
    public function getProducto($id) {

        $query = $this->db->query("SELECT prod.*, cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "
                . "AND cat.estado = 'Alta' "
                . "AND stock > 0 "
                . "AND prod.idProducto = $id");

        return $query->row_array();
    }
}
