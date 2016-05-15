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

}
