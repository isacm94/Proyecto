<?php

/**
 * MODELO DEL MÓDULO DE ADMINISTRACIÓN relacionado con agregar registros(proveedor, categoría, productos, clientes y usuarios) a la base de datos
 */
class Mdl_agregar extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    
    /**
     * Añade un registro a la base de datos
     * @param String $tabla Nombre de la tabla donde inserta
     * @param String $data Datos del registro
     */
    public function add($tabla, $data) {

        $this->db->insert($tabla, $data);
    }
    
    /**
     * Obtiene el número de veces que está guardado el nombre de un proveedor
     * @param String $nombre Nombre de un proveedor
     * @return Int Nº de veces
     */
    public function getCountNombreProveedor($nombre) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM proveedor "
                . "WHERE nombre LIKE '$nombre' ");

        return $query->row_array()['cont'];
    }
    
    /**
     * Obtiene el número de veces que está guardado el nombre de una categoría
     * @param String $nombre Nombre de una categoría
     * @return Int Nº de veces
     */
    public function getCountNombreCategoria($nombre) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM categoria "
                . "WHERE nombre LIKE '$nombre' ");

        return $query->row_array()['cont'];
    }
    
    /**
     * Obtiene el número de veces que está guardado el nombre de un producto
     * @param String $nombre Nombre de un producto
     * @return Int Nº de veces
     */
    public function getCountNombreProducto($nombre) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM producto "
                . "WHERE nombre LIKE '$nombre' ");

        return $query->row_array()['cont'];
    }
    
    /**
     * Obtiene el número de veces que está guardado el nombre de un usuario
     * @param String $username Nombre de usuario
     * @return Int Nº de veces
     */
    public function getCountUsername($username) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM usuario "
                . "WHERE username LIKE '$username' ");

        return $query->row_array()['cont'];
    }
    
    /**
     * Obtiene el número de veces que está guardado un NIF
     * @param String $nif NIF
     * @return Int Nº de veces
     */
    public function getCountNIFCliente($nif) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM cliente "
                . "WHERE nif LIKE '$nif' ");

        return $query->row_array()['cont'];
    }
    
    /**
     * Devuelve todas las categorías para crear un select/Lista desplegables
     * @return Array
     */
    public function getCategorias() {

        $query = $this->db->query("SELECT idCategoria, nombre "
                . "FROM categoria");

        return $query->result_array();
    }
    
     /**
     * Devuelve todos las proveedores para crear el select/Lista desplegables
     * @return Array
     */
    public function getProveedores() {

        $query = $this->db->query("SELECT idProveedor, nombre "
                . "FROM proveedor");

        return $query->result_array();
    }
    
    /**
     * Devuelve el nombre de una categoría
     * @param Int $id ID de la categoría
     * @return String Nombre de la categoría
     */
    public function getNombreCategoria($id){
        $query = $this->db->query("SELECT nombre "
                . "FROM categoria WHERE idCategoria = $id");

        return $query->row_array()['nombre'];
    }
    
    /**
     * Devuelve el nombre de un proveedor
     * @param Int $id ID del proveedor
     * @return String Nombre del proveedor
     */
    public function getNombreProveedor($id){
        $query = $this->db->query("SELECT nombre "
                . "FROM proveedor WHERE idProveedor = $id");

        return $query->row_array()['nombre'];
    }
}
