<?php

/**
 * MODELO DEL MÓDULO DE ADMINISTRACIÓN de la consultas de provincias.
 */
class Mdl_provincias extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Consulta todas las provincias
     * @return Array
     */
    public function getProvincias() {

        $query = $this->db->query("SELECT idProvincia, nombre "
                                    . "FROM provincia ");
        
        return $query->result_array();
    } 
}
