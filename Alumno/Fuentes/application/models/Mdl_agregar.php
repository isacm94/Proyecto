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
    
    /**
     * Cuenta el número de veces que está un CIF
     * @param type $CIF CIF a buscar
     * @return type Nº de veces
     */
    public function getCountCIF($CIF) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM proveedor "
                . "WHERE cif LIKE '$CIF' ");

        return $query->row_array()['cont'];
    }
    
    public function getCountNombreCategoria($nombre) {

        $query = $this->db->query("SELECT count(*) cont "
                . "FROM categoria "
                . "WHERE nombre LIKE '$nombre' ");

        return $query->row_array()['cont'];
    }
    
}
