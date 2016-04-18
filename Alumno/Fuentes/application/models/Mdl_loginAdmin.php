<?php

/**
 * MODELO 
 */
class Mdl_loginAdmin extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function checkLoginAdmin($username) {

        $query = $this->db->query("SELECT count(*) "
                . "FROM usuario "
                . "WHERE username LIKE '$username' AND tipo LIKE 'Administrador'");

        if ($query->num_rows() > 0)
            return true;
        else
            return false;
    }

    public function getClave($username) {
        $query = $this->db->query("SELECT clave "
                . "FROM usuario "
                . "WHERE username LIKE '$username'");


        return $query->row_array()['clave'];
    }

    public function getID($username) {
        $query = $this->db->query("SELECT idUsuario "
                . "FROM usuario "
                . "WHERE username LIKE '$username'");


        return $query->row_array()['idUsuario'];
    }
    
    public function getNombre($username) {
        $query = $this->db->query("SELECT nombre "
                . "FROM usuario "
                . "WHERE username LIKE '$username'");


        return $query->row_array()['nombre'];
    }

}
