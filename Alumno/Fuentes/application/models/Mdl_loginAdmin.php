<?php

/**
 * MODELO 
 */
class Mdl_loginAdmin extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function checkLoginAdmin($username) {

        $query = $this->db->query("SELECT username "
                . "FROM usuario "
                . "WHERE username LIKE '$username' AND tipo LIKE 'Adminisrador'");


        return $query->num_rows();
    }
    
    public function getClave($username){
        $query = $this->db->query("SELECT clave "
                . "FROM usuario "
                . "WHERE username LIKE '$username'");


        return $query->row_array()['clave'];        
    }
    
    public function getID($username){
        $query = $this->db->query("SELECT idUsuario "
                . "FROM usuario "
                . "WHERE username LIKE '$username'");


        return $query->row_array()['clave'];        
    }
}
