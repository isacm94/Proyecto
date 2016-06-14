<?php

/**
 * MODELO DEL MÓDULO DE ADMINISTRACIÓN relacionado con listar tablas(proveedor, categoría, productos, clientes y usuarios) a la base de datos
 */
class Mdl_lista extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Consulta todos los proveedores
     * @param Int $start Desde el registro que debe mostrar, para la paginación
     * @param Int $limit Hasta el registro que debe consultar, para la paginación
     * @return Array Proveedores
     */
    public function getProveedores($start, $limit) {

        $query = $this->db->query("SELECT idProveedor, nombre, nif, correo, estado, telefono "
                . "FROM proveedor "
                . "ORDER BY nombre "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Consulta todos las categorías
     * @param Int $start Desde el registro que debe mostrar, para la paginación
     * @param Int $limit Hasta el registro que debe consultar, para la paginación
     * @return Array Categorías
     */
    public function getCategorias($start, $limit) {

        $query = $this->db->query("SELECT * "
                . "FROM categoria "
                . "ORDER BY referencia "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Consulta todos los productos
     * @param Int $start Desde el registro que debe mostrar, para la paginación
     * @param Int $limit Hasta el registro que debe consultar, para la paginación
     * @return Array Productos
     */
    public function getProductos($start, $limit) {

        $query = $this->db->query("SELECT prod.*, cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "ORDER BY prod.referencia "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Consulta todos los clientes
     * @param Int $start Desde el registro que debe mostrar, para la paginación
     * @param Int $limit Hasta el registro que debe consultar, para la paginación
     * @return Array Clientes
     */
    public function getClientes($start, $limit) {

        $query = $this->db->query("SELECT idCliente, nombre, nif, tipo, anotaciones, estado "
                . "FROM cliente "
                . "ORDER BY nombre "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Consulta todos los usuarios
     * @param Int $start Desde el registro que debe mostrar, para la paginación
     * @param Int $limit Hasta el registro que debe consultar, para la paginación
     * @return Array Usuarios
     */
    public function getUsuarios($start, $limit) {

        $query = $this->db->query("SELECT * "
                . "FROM usuario "
                . "ORDER BY nombre "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Consulta el número total de proveedores 
     * @return Int Número de proveedores
     */
    public function getNumTotalProveedores() {

        $query = $this->db->query("SELECT COUNT(*) cont "
                . "FROM proveedor ");

        return $query->row_array()['cont'];
    }

    /**
     * Consulta el número total de categorias 
     * @return Int Número de categorias
     */
    public function getNumTotalCategorias() {

        $query = $this->db->query("SELECT COUNT(*) cont "
                . "FROM categoria ");

        return $query->row_array()['cont'];
    }

    /**
     * Consulta el número total de productos 
     * @return Int Número de productos
     */
    public function getNumTotalProductos() {

        $query = $this->db->query("SELECT COUNT(*) cont "
                . "FROM producto ");

        return $query->row_array()['cont'];
    }

    /**
     * Consulta el número total de clientes 
     * @return Int Número de clientes
     */
    public function getNumTotalClientes() {

        $query = $this->db->query("SELECT COUNT(*) cont "
                . "FROM cliente ");

        return $query->row_array()['cont'];
    }

    /**
     * Consulta el número total de usuarios 
     * @return Int Número de usuarios
     */
    public function getNumTotalUsuarios() {

        $query = $this->db->query("SELECT COUNT(*) cont "
                . "FROM usuario ");

        return $query->row_array()['cont'];
    }

    /**
     * Cambia el estado de un elemento(Proveedor, Categoria, Producto, Cliente y Usuario) a 'Baja'
     * @param String $tabla Nombre del elemento/tabla
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
     * @param String $tabla Nombre del elemento/tabla
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
                . "INNER JOIN provincia prov ON pro.idProvincia = prov.idProvincia "
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
                . "INNER JOIN proveedor prov ON prod.idProveedor = prov.idProveedor "
                . "INNER JOIN categoria cat ON prod.idCategoria = cat.idCategoria "
                . "WHERE idProducto = '$id'");

        return $query->row_array();
    }

    /**
     * Consulta los datos de un cliente
     * @param Int $id ID del cliente
     * @return Array
     */
    public function getCliente($id) {
        $query = $this->db->query("SELECT c.*, prov.nombre 'provincia' "
                . "FROM cliente c "
                . "INNER JOIN provincia prov ON c.idProvincia = prov.idProvincia "
                . "WHERE idCliente = '$id'");

        return $query->row_array();
    }

    /**
     * Obtiene el número de veces que está guardado el nombre de un proveedor que no sea el del ID
     * @param String $nombre Nombre de un proveedor
     * @param Int $id ID del proveedor
     * @return Int Número de veces
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
     * @return Int Número de veces
     */
    public function getCountNombreCategoria($nombre, $id) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM categoria "
                . "WHERE nombre LIKE '$nombre' "
                . "AND idCategoria != '$id'");

        return $query->row_array()['cont'];
    }

    /**
     * Obtiene el número de veces que está guardado el NIF de un cliente que no sea el del ID
     * @param String $nif NIF del producto
     * @param Int $id ID del cliente
     * @return Int Número de veces
     */
    public function getCountNIFCliente($nif, $id) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM cliente "
                . "WHERE nif LIKE '$nif' "
                . "AND idCliente != '$id'");

        return $query->row_array()['cont'];
    }

    /**
     * Obtiene el número de veces que está guardado el nombre de un producto que no sea el del ID
     * @param String $nombre Nombre del producto
     * @param Int $id ID del producto
     * @return Int Número de veces
     */
    public function getCountNombreProducto($nombre, $id) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM producto "
                . "WHERE nombre LIKE '$nombre' "
                . "AND idProducto != '$id'");

        return $query->row_array()['cont'];
    }

    /**
     * Actualiza los datos de un elemento/tabla (Proveedor, Categoria, Producto, Cliente y Usuario)
     * @param String $tabla Nombre del elemento/tabla
     * @param Int $id ID del elemento
     * @param Array $data Datos que van a ser actualizados
     */
    public function update($tabla, $id, $data) {
        $this->db->where('id' . $tabla, $id);
        $this->db->update($tabla, $data);
    }

    /**
     * Busca en los proveedores por la/s palabra/s introducida
     * @param String $campo Palabras/s introducida/s por la que buscar
     * @param Int $start Desde el registro que debe mostrar, para la paginación
     * @param Int $limit Hasta el registro que debe consultar, para la paginación
     * @return Array Proveedores
     */
    public function BusquedaProveedor($campo, $start, $limit) {

        $query = $this->db->query("SELECT prove.* "
                . "FROM proveedor prove "
                . "INNER JOIN provincia provi ON provi.idProvincia=prove.idProvincia "
                . "WHERE prove.nombre LIKE '%$campo%' OR "
                . "prove.nif LIKE '%$campo%' OR "
                . "prove.correo LIKE '%$campo%' OR "
                . "prove.telefono LIKE '%$campo%' OR "
                . "prove.direccion LIKE '%$campo%' OR "
                . "prove.localidad LIKE '%$campo%' OR "
                . "prove.cp LIKE '%$campo%' OR "
                . "prove.anotaciones LIKE '%$campo%' OR "
                . "prove.estado LIKE '%$campo%' OR "
                . "provi.nombre LIKE '%$campo%' "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Consulta el número de proveedores que coincidan con la palabra buscada
     * @param String $campo Palabras/s introducida/s por la que buscar
     * @return Int Número de Proveedores
     */
    public function BusquedaNumProveedores($campo) {
        $query = $this->db->query("SELECT count(*) 'cont' "
                . "FROM proveedor prove "
                . "INNER JOIN provincia provi ON provi.idProvincia=prove.idProvincia "
                . "WHERE prove.nombre LIKE '%$campo%' OR "
                . "prove.nif LIKE '%$campo%' OR "
                . "prove.correo LIKE '%$campo%' OR "
                . "prove.telefono LIKE '%$campo%' OR "
                . "prove.direccion LIKE '%$campo%' OR "
                . "prove.localidad LIKE '%$campo%' OR "
                . "prove.cp LIKE '%$campo%' OR "
                . "prove.anotaciones LIKE '%$campo%' OR "
                . "prove.estado LIKE '%$campo%' OR "
                . "provi.nombre LIKE '%$campo%'");



        return $query->row_array()['cont'];
    }

    /**
     * Busca en las categorías por la/s palabra/s introducida
     * @param String $campo Palabras/s introducida/s por la que buscar
     * @param Int $start Desde el registro que debe mostrar, para la paginación
     * @param Int $limit Hasta el registro que debe consultar, para la paginación
     * @return Array Categorías
     */
    public function BusquedaCategoria($campo, $start, $limit) {

        $query = $this->db->query("SELECT * "
                . "FROM categoria "
                . "WHERE referencia LIKE '%$campo%' OR "
                . "nombre LIKE '%$campo%' OR "
                . "descripcion LIKE '%$campo%' OR "
                . "estado LIKE '%$campo%' "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Consulta el número de categorias que coincidan con la palabra buscada
     * @param String $campo Palabras/s introducida/s por la que buscar
     * @return Int Número de Categorías
     */
    public function BusquedaNumCategorias($campo) {
        $query = $this->db->query("SELECT count(*) 'cont' "
                . "FROM categoria "
                . "WHERE referencia LIKE '%$campo%' OR "
                . "nombre LIKE '%$campo%' OR "
                . "descripcion LIKE '%$campo%' OR "
                . "estado LIKE '%$campo%'");

        return $query->row_array()['cont'];
    }

    /**
     * Busca en los productos por la/s palabra/s introducida
     * @param String $campo Palabras/s introducida/s por la que buscar
     * @param Int $start Desde el registro que debe mostrar, para la paginación
     * @param Int $limit Hasta el registro que debe consultar, para la paginación
     * @return Array Productos
     */
    public function BusquedaProducto($campo, $start, $limit) {

        $query = $this->db->query("SELECT prod.*, cat.nombre 'categoria' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria=cat.idCategoria "
                . "INNER JOIN proveedor prv ON prod.idProveedor=prv.idProveedor "
                . "WHERE prod.referencia LIKE '%$campo%' OR prod.nombre LIKE '%$campo%' OR prod.marca "
                . "LIKE '%$campo%' OR prod.precio LIKE '%$campo%' OR prod.precio_venta LIKE '%$campo%' "
                . "OR prod.iva LIKE '%$campo%' OR prod.stock LIKE '%$campo%' OR prod.descripcion LIKE '%$campo%' OR prod.estado LIKE '%$campo%' "
                . "OR cat.nombre LIKE '%$campo%' OR prv.nombre LIKE '%$campo%' "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Consulta el número de productos que coincidan con la palabra buscada
     * @param String $campo Palabras/s introducida/s por la que buscar
     * @return Int Número de Productos
     */
    public function BusquedaNumProductos($campo) {
        $query = $this->db->query("SELECT count(*) 'cont' "
                . "FROM producto prod "
                . "INNER JOIN categoria cat ON prod.idCategoria=cat.idCategoria "
                . "INNER JOIN proveedor prv ON prod.idProveedor=prv.idProveedor "
                . "WHERE prod.referencia LIKE '%$campo%' OR prod.nombre LIKE '%$campo%' OR prod.marca "
                . "LIKE '%$campo%' OR prod.precio LIKE '%$campo%' OR prod.precio_venta LIKE '%$campo%' "
                . "OR prod.iva LIKE '%$campo%' OR prod.stock LIKE '%$campo%' OR prod.descripcion LIKE '%$campo%' OR prod.estado LIKE '%$campo%' "
                . "OR cat.nombre LIKE '%$campo%' OR prv.nombre LIKE '%$campo%'");

        return $query->row_array()['cont'];
    }

    /**
     * Busca en los clientes por la/s palabra/s introducida
     * @param String $campo Palabras/s introducida/s por la que buscar
     * @param Int $start Desde el registro que debe mostrar, para la paginación
     * @param Int $limit Hasta el registro que debe consultar, para la paginación
     * @return Array Clientes
     */
    public function BusquedaCliente($campo, $start, $limit) {

        $query = $this->db->query("SELECT c.*, p.nombre 'provincia' "
                . "FROM cliente c "
                . "INNER JOIN provincia p ON p.idProvincia=c.idProvincia "
                . "WHERE c.nombre LIKE '%$campo%' OR c.nif LIKE '%$campo%' "
                . "OR c.correo LIKE '%$campo%' OR c.direccion LIKE '%$campo%' "
                . "OR c.localidad LIKE '%$campo%' OR c.cp LIKE '%$campo%' OR c.cuenta_corriente LIKE '%$campo%' "
                . "OR c.tipo LIKE '%$campo%' OR c.anotaciones LIKE '%$campo%' OR c.estado LIKE '%$campo%' "
                . "OR p.nombre LIKE '%$campo%' "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Consulta el número de clientes que coincidan con la palabra buscada
     * @param String $campo Palabras/s introducida/s por la que buscar
     * @return Int Número de Clientes
     */
    public function BusquedaNumClientes($campo) {
        $query = $this->db->query("SELECT count(*) 'cont' "
                . "FROM cliente c "
                . "INNER JOIN provincia p ON p.idProvincia=c.idProvincia "
                . "WHERE c.nombre LIKE '%$campo%' OR c.nif LIKE '%$campo%' "
                . "OR c.correo LIKE '%$campo%' OR c.direccion LIKE '%$campo%' "
                . "OR c.localidad LIKE '%$campo%' OR c.cp LIKE '%$campo%' OR c.cuenta_corriente LIKE '%$campo%' "
                . "OR c.tipo LIKE '%$campo%' OR c.anotaciones LIKE '%$campo%' OR c.estado LIKE '%$campo%' "
                . "OR p.nombre LIKE '%$campo%'");

        return $query->row_array()['cont'];
    }

    /**
     * Busca en los usuarios por la/s palabra/s introducida
     * @param String $campo Palabras/s introducida/s por la que buscar
     * @param Int $start Desde el registro que debe mostrar, para la paginación
     * @param Int $limit Hasta el registro que debe consultar, para la paginación
     * @return Array Usuarios
     */
    public function BusquedaUsuario($campo, $start, $limit) {

        $query = $this->db->query("SELECT * "
                . "FROM usuario "
                . "WHERE username LIKE '%$campo%' OR "
                . "tipo LIKE '%$campo%' OR "
                . "nombre LIKE '%$campo%' OR "
                . "correo LIKE '%$campo%' OR "
                . "estado LIKE '%$campo%' "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Consulta el número de usuarios que coincidan con la palabra buscada
     * @param String $campo Palabras/s introducida/s por la que buscar
     * @return Int Número de Usuarios
     */
    public function BusquedaNumUsuarios($campo) {
        $query = $this->db->query("SELECT count(*) 'cont' "
                . "FROM usuario "
                . "WHERE username LIKE '%$campo%' OR "
                . "tipo LIKE '%$campo%' OR "
                . "nombre LIKE '%$campo%' OR "
                . "correo LIKE '%$campo%' OR "
                . "estado LIKE '%$campo%'");

        return $query->row_array()['cont'];
    }

    /**
     * Consulta el nombre y la extensión de la imagen de un producto
     * @param Int $id ID del producto
     * @return String Imagen
     */
    public function getImagen($id) {
        $query = $this->db->query("SELECT imagen "
                . "FROM producto "
                . "WHERE idProducto = '$id'");
        return $query->row_array()['imagen'];
    }

    /**
     * Consulta todas las facturas que estén pendientes de pagos
     * @return Array Facturas Pendientes
     */
    public function getFacturasPendientes() {
        $query = $this->db->query("SELECT idFactura, numfactura, DATE_FORMAT(fecha_factura, '%d/%m/%Y') 'fecha_factura', "
                . "nombre_cliente, idCliente, importe_total, cantidad_total, ifnull(descuento, 0) 'descuento', importe_total_descuento "
                . "FROM factura "
                . "WHERE pendiente_pago LIKE 'Sí' ");

        return $query->result_array();
    }

    /**
     * Consulta todas las facturas que NO estén pendientes de pagos
     * @return Array Facturas Pendientes
     */
    public function getFacturasPagadas() {
        $query = $this->db->query("SELECT idFactura, numfactura, DATE_FORMAT(fecha_factura, '%d/%m/%Y') 'fecha_factura', nombre_cliente, idCliente, importe_total, cantidad_total "
                . "FROM factura "
                . "WHERE pendiente_pago LIKE 'No' ");

        return $query->result_array();
    }

    /**
     * Establece una factura a pagada
     * @param Int $idFactura ID de la factura
     */
    public function setFacturaPagada($idFactura) {
        $data = array(
            'pendiente_pago' => 'No'
        );
        $this->db->where('idFactura', $idFactura);
        $this->db->update('factura', $data);
    }

    /**
     * Consulta la información de una factura
     * @param Int $idFactura ID de la factura
     * @return Array Indormación de la factura
     */
    public function getInfoFactura($idFactura) {
        $query = $this->db->query("SELECT idFactura, ifnull(descuento, 0) 'descuento', numfactura, nombre_cliente, DATE_FORMAT(fecha_factura, '%d/%m/%Y') 'fecha_factura' "
                . "FROM factura "
                . "WHERE idFactura = $idFactura");

        return $query->row_array();
    }

    /**
     * Consulta el campo pendiente_pago de la factura
     * @param Int $idFactura ID de la factura
     * @return String Campo pendiente_pago
     */
    public function getPendientePago($idFactura) {
        $query = $this->db->query("SELECT pendiente_pago "
                . "FROM factura "
                . "WHERE idFactura = $idFactura");

        return $query->row_array()['pendiente_pago'];
    }

    /**
     * Consulta el campor importe_total de una factura
     * @param Int $idFactura ID de la factura
     * @return Float Campo importe_total
     */
    public function getImporteTotalFactura($idFactura) {
        $query = $this->db->query("SELECT importe_total "
                . "FROM factura "
                . "WHERE idFactura = $idFactura");

        return $query->row_array()['importe_total'];
    }

    /**
     * Actualiza los datos de una factura
     * @param Int $idFactura ID de la factura
     * @param String $data Datos a actualizar
     */
    public function UpdateFactura($idFactura, $data) {

        $this->db->where('idFactura', $idFactura);
        $this->db->update('factura', $data);
    }

}
