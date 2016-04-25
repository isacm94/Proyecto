<?php

/**
 * MODELO relacionado con las consultas, insercción y actualización de la tabla usuario.
 */
class Mdl_agregar extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    
    /**
     * Añade un registro a la base de datos
     * @param type $tabla Nombre de la tabla donde inserta
     * @param type $data Datos del registro
     */
    public function add($tabla, $data) {

        $this->db->insert($tabla, $data);
    }
    
    
    public function getCountNombreProveedor($nombre) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM proveedor "
                . "WHERE nombre LIKE '$nombre' ");

        return $query->row_array()['cont'];
    }
    
    public function getCountNombreCategoria($nombre) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM categoria "
                . "WHERE nombre LIKE '$nombre' ");

        return $query->row_array()['cont'];
    }
    public function getCountNombreProducto($nombre) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM producto "
                . "WHERE nombre LIKE '$nombre' ");

        return $query->row_array()['cont'];
    }
    public function getCategorias() {

        $query = $this->db->query("SELECT idCategoria, nombre "
                . "FROM categoria ");

        return $query->result_array();
    }
    
    public function getProveedores() {

        $query = $this->db->query("SELECT idProveedor, nombre "
                . "FROM proveedor ");

        return $query->result_array();
    }
}
