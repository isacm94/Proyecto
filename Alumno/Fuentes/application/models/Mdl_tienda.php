<?php

/**
 * MODELO DEL MÓDULO DE VENTA usado para la tienda
 */
class Mdl_tienda extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /* HOME */

    /**
     * Consulta todos los productos disponibles
     * @param Int $start Desde el registro que debe mostrar, para la paginación
     * @param Int $limit Hasta el registro que debe consultar, para la paginación
     * @return type Array productos
     */
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

    /**
     * Consulta el número de productos disponibles
     * @return Int Número de productos
     */
    public function getNumProductos() {

        $query = $this->db->query("SELECT count(*)'cont' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "
                . "AND stock > 0 "
                . "AND cat.estado = 'Alta'");

        return $query->row_array()['cont'];
    }

    /* CATEGORIAS */

    /**
     * Consulta las categorías disponibles
     * @return Array Categorías
     */
    public function getCategorias() {
        $query = $this->db->query("SELECT idCategoria 'id', nombre "
                . "FROM categoria "
                . "WHERE estado = 'Alta'");

        return $query->result_array();
    }

    /**
     * Consulta los productos disponibles de una categoría
     * @param Int $idCategoria ID de la categoría
     * @param Int $start Desde el registro que debe mostrar, para la paginación
     * @param Int $limit Hasta el registro que debe consultar, para la paginación
     * @return Array Productos
     */
    public function getProductosFromCategoria($idCategoria, $start, $limit) {

        $query = $this->db->query("SELECT prod.idproducto 'id', prod.nombre, prod.imagen, prod.precio_venta 'precio', prod.descripcion, cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "
                . "AND cat.estado = 'Alta' "
                . "AND cat.idCategoria = $idCategoria "
                . "AND stock > 0 "
                . "ORDER BY prod.referencia "
                . "LIMIT $start, $limit;");

        return $query->result_array();
    }

    /**
     * Consulta el número de productos disponibles de una categoría
     * @param Int $idCategoria ID de la categoría
     * @return Int Número de productos de la categoría
     */
    public function getNumProductosFromCategoria($idCategoria) {

        $query = $this->db->query("SELECT count(*)'cont' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "
                . "AND cat.estado = 'Alta' "
                . "AND stock > 0 "
                . "AND cat.idCategoria = $idCategoria ");

        return $query->row_array()['cont'];
    }

    /**
     * Consulta si una categoría existe y está disponible
     * @param Int $idCategoria ID de la categoría
     * @return boolean
     */
    public function CheckCategoria($idCategoria) {

        $query = $this->db->query("SELECT count(*) 'cont' "
                . "FROM categoria "
                . "WHERE estado LIKE 'Alta' "
                . "AND idCategoria = $idCategoria ");

        if ($query->row_array()['cont'] > 0) {//Categoria correcta
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Consulta el nombre de una categoría
     * @param Int $idCategoria ID de la categoría
     * @return String Nombre de la categoría
     */
    public function getNombreCategoria($idCategoria) {
        $query = $this->db->query("SELECT nombre "
                . "FROM categoria "
                . "WHERE idCategoria = $idCategoria ");

        return $query->row_array()['nombre'];
    }

    /**
     * Devuelve las principales características de los productos disponibles de una categoría
     * @param Int $idCategoria ID de la categoría
     * @return Array Caracteristicas del producto
     */
    public function getProducto($idCategoria) {

        $query = $this->db->query("SELECT prod.*, cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE prod.estado = 'Alta' "
                . "AND cat.estado = 'Alta' "
                . "AND stock > 0 "
                . "AND prod.idProducto = $idCategoria");

        return $query->row_array();
    }

}
