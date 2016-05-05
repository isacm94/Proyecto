<?php

/**
 * MODELO DEL MÓDULO DE ADMINISTRACIÓN relacionado con listar registros(proveedor, categoría, productos, clientes y usuarios) a la base de datos
 */
class Mdl_lista extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getProveedores($start, $limit) {

        $query = $this->db->query("SELECT idProveedor, nombre, nif, correo, estado, telefono "
                . "FROM proveedor "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    public function getCategorias($start, $limit) {

        $query = $this->db->query("SELECT * "
                . "FROM categoria "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    public function getProductos($start, $limit) {

        $query = $this->db->query("SELECT prod.*, cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat on prod.idCategoria = cat.idCategoria "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    public function getNumTotalProveedores() {

        $query = $this->db->query("SELECT COUNT(*) cont "
                . "FROM proveedor ");

        return $query->row_array()['cont'];
    }

    public function getNumTotalCategorias() {

        $query = $this->db->query("SELECT COUNT(*) cont "
                . "FROM categoria ");

        return $query->row_array()['cont'];
    }
    
    public function getNumTotalProductos() {

        $query = $this->db->query("SELECT COUNT(*) cont "
                . "FROM producto ");

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
        $this->db->where('id' . $tabla, $id);
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
        $this->db->where('id' . $tabla, $id);
        $this->db->update($tabla, $data);
    }

    /**
     * Consulta los datos de un proveedor
     * @param Int $id ID del proveedor
     * @return Array
     */
    public function getProveedor($id) {
        $query = $this->db->query("SELECT idProveedor, pro.nombre, nif, correo, direccion, localidad, cp, anotaciones, estado, prov.nombre 'provincia', pro.idProvincia 'idProvincia' "
                . "FROM proveedor pro "
                . "INNER JOIN provincia prov on pro.idProvincia = prov.idProvincia "
                . "WHERE idProveedor = '$id'");

        return $query->row_array();
    }

    /**
     * Consulta los datos de una categoría
     * @param Int $id ID del categoria
     * @return Array
     */
    public function getCategoria($id) {
        $query = $this->db->query("SELECT * "
                . "FROM categoria "
                . "WHERE idCategoria = '$id'");

        return $query->row_array();
    }

    /**
     * Consulta los datos de un Producto
     * @param Int $id ID del producto
     * @return Array
     */
    public function getProducto($id) {
        $query = $this->db->query("SELECT prod.*, prov.nombre 'proveedor' , cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN proveedor prov on prod.idProveedor = prov.idProveedor "
                . "INNER JOIN categoria cat on prod.idCategoria = cat.idCategoria "
                . "WHERE idProducto = '$id'");

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

    /**
     * Obtiene el número de veces que está guardado el nombre de una categoría que no sea el del ID
     * @param String $nombre Nombre de una categoría
     * @param Int $id ID de la categoría
     * @return Int Nº de veces
     */
    public function getCountNombreCategoria($nombre, $id) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM categoria "
                . "WHERE nombre LIKE '$nombre' "
                . "AND idCategoria != '$id'");

        return $query->row_array()['cont'];
    }

    public function update($tabla, $id, $data) {
        $this->db->where('id' . $tabla, $id);
        $this->db->update($tabla, $data);
    }

    public function BusquedaProveedor($campo, $start, $limit) {

        $query = $this->db->query("SELECT * "
                . "FROM proveedor "
                . "WHERE nombre LIKE '%$campo%' OR "
                . "nif LIKE '%$campo%' OR "
                . "correo LIKE '%$campo%' OR "
                . "telefono LIKE '%$campo%' OR "
                . "direccion LIKE '%$campo%' OR "
                . "localidad LIKE '%$campo%' OR "
                . "cp LIKE '%$campo%' OR "
                . "anotaciones LIKE '%$campo%' OR "
                . "estado LIKE '%$campo%' OR "
                . "idProvincia = (select idProvincia from provincia where nombre LIKE '$campo')"
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    public function BusquedaNumProveedores($campo) {
        $query = $this->db->query("SELECT count(*) 'cont' "
                . "FROM proveedor "
                . "WHERE nombre LIKE '%$campo%' OR "
                . "nif LIKE '%$campo%' OR "
                . "correo LIKE '%$campo%' OR "
                . "telefono LIKE '%$campo%' OR "
                . "direccion LIKE '%$campo%' OR "
                . "localidad LIKE '%$campo%' OR "
                . "cp LIKE '%$campo%' OR "
                . "anotaciones LIKE '%$campo%' OR "
                . "estado LIKE '%$campo%' OR "
                . "idProvincia = (select idProvincia from provincia where nombre LIKE '$campo')");

        return $query->row_array()['cont'];
    }

    public function BusquedaCategoria($campo, $start, $limit) {

        $query = $this->db->query("SELECT * "
                . "FROM categoria "
                . "WHERE referencia LIKE '%$campo%' OR "
                . "nombre LIKE '%$campo%' OR "
                . "descripcion LIKE '%$campo%' OR "
                . "estado LIKE '%$campo%'");

        return $query->result_array();
    }

    public function BusquedaNumCategorias($campo) {
        $query = $this->db->query("SELECT count(*) 'cont' "
                . "FROM categoria "
                . "WHERE referencia LIKE '%$campo%' OR "
                . "nombre LIKE '%$campo%' OR "
                . "descripcion LIKE '%$campo%' OR "
                . "estado LIKE '%$campo%'");

        return $query->row_array()['cont'];
    }

}
