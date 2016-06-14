<?php

/**
 * MODELO DEL MÓDULO DE VENTA usado para el proceso de venta
 */
class Mdl_venta extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Consulta todos los clientes minoristas disponibles
     * @return Array Clientes minoristas
     */
    public function getMinoristas() {

        $query = $this->db->query("SELECT nombre, nif, idCliente 'id' "
                . "FROM cliente "
                . "WHERE estado = 'Alta' "
                . "AND tipo LIKE 'Minorista'"
                . "ORDER BY nombre ");

        return $query->result_array();
    }

    /**
     * Consulta todos los clientes mayoristas disponibles
     * @return Array Clientes mayoristas
     */
    public function getMayoristas() {

        $query = $this->db->query("SELECT nombre, nif, idCliente 'id' "
                . "FROM cliente "
                . "WHERE estado = 'Alta' "
                . "AND tipo LIKE 'Mayorista'"
                . "ORDER BY nombre ");

        return $query->result_array();
    }

    /**
     * Consulta el tipo de cliente de un cliente
     * @param Int $idCliente
     * @return String Tipo de cliente
     */
    public function getTipo($idCliente) {

        $query = $this->db->query("SELECT tipo "
                . "FROM cliente "
                . "WHERE estado = 'Alta' "
                . "AND idCliente = $idCliente");

        return $query->row_array()['tipo'];
    }

    /**
     * Consulta la información de un cliente
     * @param Int $idCliente ID del cliente
     * @return Array Datos del cliente
     */
    public function getDatosCliente($idCliente) {
        $query = $this->db->query("SELECT idCliente, c.nombre, nif, tipo, direccion, localidad, cp, c.idProvincia, p.nombre 'provincia' "
                . "FROM cliente c "
                . "INNER JOIN provincia p on c.idProvincia = p.idProvincia "
                . "WHERE estado = 'Alta' "
                . "AND idCliente = $idCliente ");

        return $query->row_array();
    }

    /**
     * Guarda una factura
     * @param Array $datosfactura Información de la factura
     * @return Int ID de la factura guardada
     */
    public function setFactura($datosfactura) {
        $this->db->insert('factura', $datosfactura);

        return $this->db->insert_id(); //Devolvemos id
    }

    /**
     * Guarda un albarán
     * @param Array $datosalbaran Información del albarán
     * @return Int ID del albarán guardado
     */
    public function setAlbaran($datosalbaran) {
        $this->db->insert('albaran', $datosalbaran);

        return $this->db->insert_id(); //Devolvemos id
    }

    /**
     * Inserta una línea de albarán
     * @param Array $datoslinealabaran Informacion de la línea de albarán
     */
    public function setLineaAlbaran($datoslinealabaran) {
        $this->db->insert('linea_albaran', $datoslinealabaran);
    }

    /**
     * Consulta el porcentaje de IVA de un producto
     * @param Int $idProducto ID del producto
     * @return Float Porcentaje IVA
     */
    public function getIva($idProducto) {
        $query = $this->db->query("SELECT iva "
                . "FROM producto "
                . "WHERE idProducto = $idProducto ");

        return $query->row_array()['iva'];
    }

    /**
     * Devuelve la última factura no pagada de un cliente si existiera la factura
     * @param Int $idCliente ID del cliente
     * @return Array Factura
     */
    public function getFacturaMayorista($idCliente) {
        $query = $this->db->query("SELECT * "
                . "FROM factura "
                . "WHERE idCliente= $idCliente "
                . "AND pendiente_pago LIKE 'Sí' "
                . "AND fecha_factura  = (select max(fecha_factura) "
                . "FROM factura "
                . "WHERE idCliente=$idCliente "
                . "AND pendiente_pago LIKE 'Sí');");

        return $query->row_array();
    }

    /**
     * Actualiza los datos de una factura
     * @param Int $idFactura ID de la factura
     * @param Array $data Datos de la factura
     */
    public function UpdateFactura($idFactura, $data) {
        $this->db->where('idFactura', $idFactura);
        $this->db->update('factura', $data);
    }

    /**
     * Consulta el número de stock de un producto
     * @param Int $idProducto ID del producto
     * @return Int Stock del producto
     */
    public function getStock($idProducto) {
        $query = $this->db->query("SELECT stock "
                . "FROM producto "
                . "WHERE idProducto= $idProducto");

        return $query->row_array()['stock'];
    }

    /**
     * Actualiza el número de stock de un producto
     * @param Int $idProducto ID del producto
     * @return Int Stock del producto
     */
    public function UpdateStockProducto($idProducto, $stock) {
        $data = array('stock' => $stock);

        $this->db->where('idProducto', $idProducto);
        $this->db->update('producto', $data);
    }

}
