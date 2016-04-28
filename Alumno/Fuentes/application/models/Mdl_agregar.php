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
    
    public function getCountUsername($username) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM usuario "
                . "WHERE username LIKE '$username' ");

        return $query->row_array()['cont'];
    }
    
    public function getCountNIFCliente($nif) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM cliente "
                . "WHERE nif LIKE '$nif' ");

        return $query->row_array()['cont'];
    }
    
    public function getCategorias() {

        $query = $this->db->query("SELECT idCategoria, nombre "
                . "FROM categoria WHERE estado = 'Alta'");

        return $query->result_array();
    }
    
    public function getProveedores() {

        $query = $this->db->query("SELECT idProveedor, nombre "
                . "FROM proveedor WHERE estado = 'Alta'");

        return $query->result_array();
    }
    
    public function getNombreCategoria($id){
        $query = $this->db->query("SELECT nombre "
                . "FROM categoria WHERE idCategoria = $id");

        return $query->row_array()['nombre'];
    }
    
    public function getNombreProveedor($id){
        $query = $this->db->query("SELECT nombre "
                . "FROM proveedor WHERE idProveedor = $id");

        return $query->row_array()['nombre'];
    }
}
