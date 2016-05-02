<?php

/**
 * MODELO DEL MÓDULO DE ADMINISTRACIÓN relacionado con listar registros(proveedor, categoría, productos, clientes y usuarios) a la base de datos
 */
class Mdl_lista extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
 
   
    public function getProveedores($start, $limit) {

        $query = $this->db->query("SELECT idProveedor 'id', nombre, nif, correo, estado "
                . "FROM proveedor "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }
    
     public function getNumTotalProveedores() {

        $query = $this->db->query("SELECT COUNT(*) cont "
                . "FROM proveedor ");

        return $query->row_array()['cont'];
    }
    
    /**
     * Cambia el estado de un elemento(Proveedor, Categoria, Producto, Cliente y Usuario) a 'Baja'
     * @param Int $id ID del elemento
     */
    public function setBaja($tabla, $id) {
        $data = array(
            'estado' => 'Baja'
        );
        $this->db->where('id'.$tabla, $id);
        $this->db->update($tabla, $data);
    }
    
     /**
     * Cambia el estado de un elemento(Proveedor, Categoria, Producto, Cliente y Usuario) a 'Alta'
     * @param Int $id ID del elemento
     */
    public function setAlta($tabla, $id) {
        $data = array(
            'estado' => 'Alta'
        );
        $this->db->where('id'.$tabla, $id);
        $this->db->update($tabla, $data);
    }
    
    /**
     * Consulta los datos de un proveedor
     * @param Int $id ID del proveedor
     * @return Array
     */
    public function getProveedor($id){
        $query = $this->db->query("SELECT idProveedor 'id', pro.nombre, nif, correo, direccion, localidad, cp, anotaciones, estado, prov.nombre 'provincia', pro.idProvincia 'idProvincia' "
                . "FROM proveedor pro "
                . "INNER JOIN provincia prov on pro.idProvincia = prov.idProvincia "
                . "WHERE idProveedor = '$id'");

        return $query->row_array();
    }
    
    /**
     * Obtiene el número de veces que está guardado el nombre de un proveedor que no sea el del ID
     * @param String $nombre Nombre de un proveedor
     * @param Int $id ID del proveedor
     * @return Int Nº de veces
     */
    public function getCountNombreProveedor($nombre, $id) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM proveedor "
                . "WHERE nombre LIKE '$nombre' "
                . "AND idProveedor != '$id'");

        return $query->row_array()['cont'];
    }
    
    
    
    public function update($tabla, $id, $data) {
        $this->db->where('id'.$tabla, $id);
        $this->db->update($tabla, $data);
    }
}
