<?php

/**
 * MODELO DEL MÓDULO DE VENTA
 */
class Mdl_mostrar extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getLineasAlbaran($idAlbaran) {

        $query = $this->db->query("SELECT l.*, p.nombre 'nombreproducto' "
                . "FROM linea_albaran l "
                . "INNER JOIN producto p on l.idProducto = p.idProducto "
                . "WHERE idAlbaran = $idAlbaran ");

        return $query->result_array();
    }

    public function getNumeroAlbaran($idAlbaran) {
        $query = $this->db->query("SELECT numalbaran "
                . "FROM albaran "
                . "WHERE idAlbaran = $idAlbaran ");

        return $query->row_array()['numalbaran'];
    }

    public function getFechaAlbaran($idAlbaran) {
        $query = $this->db->query("SELECT DATE_FORMAT(fecha_albaran, '%m/%d/%Y') fecha "
                . "FROM albaran "
                . "WHERE idAlbaran = $idAlbaran ");

        return $query->row_array()['fecha'];
    }

    public function getDatosCliente($idAlbaran) {
        $query = $this->db->query("SELECT a.idCliente, a.nombre_cliente 'nombre', a.nif, a.direccion, a.localidad, a.cp, p.nombre 'provincia' "
                . "FROM albaran a "
                . "INNER JOIN provincia p ON p.idProvincia=a.idProvincia "
                . "WHERE a.idAlbaran = $idAlbaran ");

        return $query->row_array();
    }

    public function getAlbaran($idAlbaran) {
        $query = $this->db->query("SELECT importe_total, cantidad_total "
                . "FROM albaran a "
                . "INNER JOIN provincia p ON p.idProvincia=a.idProvincia "
                . "WHERE a.idAlbaran = $idAlbaran ");

        return $query->row_array();
    }

    //FACTURA
    public function getNumeroFactura($idFactura) {
        $query = $this->db->query("SELECT numfactura "
                . "FROM factura "
                . "WHERE idFactura = $idFactura ");

        return $query->row_array()['numfactura'];
    }

    public function getFechaFactura($idFactura) {
        $query = $this->db->query("SELECT DATE_FORMAT(fecha_factura, '%m/%d/%Y') fecha "
                . "FROM factura "
                . "WHERE idFactura = $idFactura ");

        return $query->row_array()['fecha'];
    }

    public function getDatosClientesFactura($idfactura) {
        $query = $this->db->query("SELECT f.idCliente, f.nombre_cliente 'nombre', f.nif, f.direccion, f.localidad, f.cp, p.nombre 'provincia' "
                . "FROM factura f "
                . "INNER JOIN provincia p ON p.idProvincia=f.idProvincia "
                . "WHERE f.idFactura = $idfactura ");

        return $query->row_array();
    }

    public function getLineasAlbaranFactura($idFactura) {

        $query = $this->db->query("SELECT l.*, p.nombre 'nombreproducto' "
                . "FROM linea_albaran l "
                . "INNER JOIN albaran a on l.idAlbaran = a.idAlbaran "
                . "INNER JOIN factura f on f.idFactura = a.idFactura "
                . "INNER JOIN producto p on l.idProducto = p.idProducto "
                . "WHERE a.idFactura = $idFactura;");

        return $query->result_array();
    }

    public function getFactura($idFactura) {
        $query = $this->db->query("SELECT importe_total, cantidad_total, importe_bruto, ifnull(descuento, 0) 'descuento', base_imponible, cantidad_iva "
                . "FROM factura f "
                . "INNER JOIN provincia p ON f.idProvincia=p.idProvincia "
                . "WHERE f.idFactura = $idFactura ");

        return $query->row_array();
    }
}
