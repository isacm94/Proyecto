<?php

/**
 * MODELO usado para mostrar los datos de albaranes y facturas en PDF
 */
class Mdl_mostrar extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Consulta todas las líneas del albarán de un albarán
     * @param Int $idAlbaran ID del Albarán
     * @return Array Líneas de Albarn
     */
    public function getLineasAlbaran($idAlbaran) {

        $query = $this->db->query("SELECT l.*, p.nombre 'nombreproducto' "
                . "FROM linea_albaran l "
                . "INNER JOIN producto p on l.idProducto = p.idProducto "
                . "WHERE idAlbaran = $idAlbaran ");

        return $query->result_array();
    }

    /**
     * Consulta el número de albarán de un albarán
     * @param Int $idAlbaran ID del Albarán
     * @return Int Número de albarán
     */
    public function getNumeroAlbaran($idAlbaran) {
        $query = $this->db->query("SELECT numalbaran "
                . "FROM albaran "
                . "WHERE idAlbaran = $idAlbaran ");

        return $query->row_array()['numalbaran'];
    }

    /**
     * Consulta la fecha de un albarán
     * @param Int $idAlbaran ID del Albarán
     * @return Date Fecha en formato dd/mm/aaaa
     */
    public function getFechaAlbaran($idAlbaran) {
        $query = $this->db->query("SELECT DATE_FORMAT(fecha_albaran, '%d/%m/%Y') fecha "
                . "FROM albaran "
                . "WHERE idAlbaran = $idAlbaran ");

        return $query->row_array()['fecha'];
    }

    /**
     * Consulta la información del cliente de un albarán
     * @param Int $idAlbaran ID del Albarán
     * @return Array Datos del cliente
     */
    public function getDatosCliente($idAlbaran) {
        $query = $this->db->query("SELECT a.idCliente, a.nombre_cliente 'nombre', a.nif, a.direccion, a.localidad, a.cp, p.nombre 'provincia' "
                . "FROM albaran a "
                . "INNER JOIN provincia p ON p.idProvincia=a.idProvincia "
                . "WHERE a.idAlbaran = $idAlbaran ");

        return $query->row_array();
    }

    /**
     * Consulta el importe y la cantidad total de un albarán
     * @param Int $idAlbaran ID del Albarán
     * @return Array Importe y cantidad total de un albarán
     */
    public function getAlbaran($idAlbaran) {
        $query = $this->db->query("SELECT importe_total, cantidad_total "
                . "FROM albaran a "
                . "INNER JOIN provincia p ON p.idProvincia=a.idProvincia "
                . "WHERE a.idAlbaran = $idAlbaran ");

        return $query->row_array();
    }

    //FACTURA

    /**
     * Consulta el número de factura de factura
     * @param Int $idFactura ID del Factura
     * @return Int Número de factura
     */
    public function getNumeroFactura($idFactura) {
        $query = $this->db->query("SELECT numfactura "
                . "FROM factura "
                . "WHERE idFactura = $idFactura ");

        return $query->row_array()['numfactura'];
    }

    /**
     * Consulta la fecha de una factura
     * @param Int $idFactura ID del Albarán
     * @return Date Fecha en formato dd/mm/aaaa
     */
    public function getFechaFactura($idFactura) {
        $query = $this->db->query("SELECT DATE_FORMAT(fecha_factura, '%d/%m/%Y') fecha "
                . "FROM factura "
                . "WHERE idFactura = $idFactura ");

        return $query->row_array()['fecha'];
    }

    /**
     * Consulta si una factura está o no pagada
     * @param Int $idFactura ID de la factura
     * @return String Resultado
     */
    public function getPagada($idFactura) {
        $query = $this->db->query("SELECT pendiente_pago "
                . "FROM factura "
                . "WHERE idFactura = $idFactura ");

        if ($query->row_array()['pendiente_pago'] == 'Sí') {
            return 'No pagada';
        } else if ($query->row_array()['pendiente_pago'] == 'No') {
            return 'Pagada';
        }
    }

    /**
     * Consulta la información del cliente de una factura
     * @param Int $idfactura ID de la factura
     * @return Array Datos del cliente
     */
    public function getDatosClientesFactura($idfactura) {
        $query = $this->db->query("SELECT f.idCliente, f.nombre_cliente 'nombre', f.nif, f.direccion, f.localidad, f.cp, p.nombre 'provincia', c.tipo 'tipo_cliente' "
                . "FROM factura f "
                . "INNER JOIN provincia p ON p.idProvincia=f.idProvincia "
                . "INNER JOIN cliente c ON f.idCliente =c.idCliente "
                . "WHERE f.idFactura = $idfactura ");

        return $query->row_array();
    }

    /**
     * Consulta todas las líneas de albarán agrupadas por el producto
     * @param Int $idFactura ID de la factura
     * @return Array Líneas de albarán de la factura
     */
    public function getLineasAlbaranFactura($idFactura) {

        $query = $this->db->query("SELECT l.idLineaAlbaran, l.idAlbaran, l.idProducto, l.precio, l.iva, p.nombre 'nombreproducto', sum(importe) 'importe', sum(cantidad) 'cantidad' "
                . "FROM linea_albaran l "
                . "INNER JOIN albaran a on l.idAlbaran = a.idAlbaran "
                . "INNER JOIN factura f on f.idFactura = a.idFactura "
                . "INNER JOIN producto p on l.idProducto = p.idProducto "
                . "WHERE a.idFactura = $idFactura "
                . "GROUP BY p.idProducto;");

        return $query->result_array();
    }

    /**
     * Consulta una factura
     * @param Int $idFactura ID de la factura
     * @return Array Información de la factura
     */
    public function getFactura($idFactura) {
        $query = $this->db->query("SELECT importe_total, cantidad_total, importe_bruto, ifnull(descuento, 0) 'descuento', base_imponible, cantidad_iva, importe_total_descuento "
                . "FROM factura f "
                . "INNER JOIN provincia p ON f.idProvincia=p.idProvincia "
                . "WHERE f.idFactura = $idFactura ");

        return $query->row_array();
    }

}
