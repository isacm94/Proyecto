<?php

/**
 * MODELO DEL MÓDULO DE VENTA
 */
class Mdl_venta extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getMinoristas() {

        $query = $this->db->query("SELECT nombre, nif, idCliente 'id' "
                . "FROM cliente "
                . "WHERE estado = 'Alta' "
                . "AND tipo LIKE 'Minorista'"
                . "ORDER BY nombre ");

        return $query->result_array();
    }

    public function getMayoristas() {

        $query = $this->db->query("SELECT nombre, nif, idCliente 'id' "
                . "FROM cliente "
                . "WHERE estado = 'Alta' "
                . "AND tipo LIKE 'Mayorista'"
                . "ORDER BY nombre ");

        return $query->result_array();
    }

    public function getTipo($id) {

        $query = $this->db->query("SELECT tipo "
                . "FROM cliente "
                . "WHERE estado = 'Alta' "
                . "AND idCliente = $id");

        return $query->row_array()['tipo'];
    }


    public function getDatosCliente($id) {
         $query = $this->db->query("SELECT idCliente, c.nombre, nif, tipo, direccion, localidad, cp, c.idProvincia, p.nombre 'provincia' "
                . "FROM cliente c "
                 . "INNER JOIN provincia p on c.idProvincia = p.idProvincia "
                . "WHERE estado = 'Alta' "
                . "AND idCliente = $id ");
         
         return $query->row_array();
    }
    
    public function setFactura($datosfactura){
        $this->db->insert('factura', $datosfactura);

        return $this->db->insert_id();//Devolvemos id
    }
    
    public function setAlbaran($datosalboran){
        $this->db->insert('albaran', $datosalboran);

        return $this->db->insert_id();//Devolvemos id
    }
    
    public function setLineaAlbaran($datoslinealabaran){
        $this->db->insert('linea_albaran', $datoslinealabaran);
    }
    
    public function getIva($id){
        $query = $this->db->query("SELECT iva "
                . "FROM producto "
                . "WHERE idProducto = $id ");

        return $query->row_array()['iva'];
    }
}