<?php

/**
 * MODELO DEL MÓDULO DE ADMINISTRACIÓN que gestiona el inicio de sesión en la aplicación
 */
class Mdl_loginAdmin extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Devuelve si el nombre de un usuario está guardado en la base de datos
     * @param String $username Nombre de usuarios
     * @return boolean
     */
    public function checkLoginAdmin($username) {

        $query = $this->db->query("SELECT count(*) "
                . "FROM usuario "
                . "WHERE username LIKE '$username' AND tipo LIKE 'Administrador'");

        if ($query->num_rows() > 0)
            return true;
        else
            return false;
    }

    /**
     * Devuelve la contraseña de un usuario
     * @param String $username Nombre de usuario
     * @return String
     */
    public function getClave($username) {
        $query = $this->db->query("SELECT clave "
                . "FROM usuario "
                . "WHERE username LIKE '$username'");


        return $query->row_array()['clave'];
    }
    
    /**
     * Devuelve el ID de un usuario
     * @param String $username Nombre de usuario
     * @return Int
     */
    public function getID($username) {
        $query = $this->db->query("SELECT idUsuario "
                . "FROM usuario "
                . "WHERE username LIKE '$username'");


        return $query->row_array()['idUsuario'];
    }
    
    
    /**
     * Devuelve el nombre personal de un usuario
     * @param String $username Nombre de usuario
     * @return String
     */
    public function getNombre($username) {
        $query = $this->db->query("SELECT nombre "
                . "FROM usuario "
                . "WHERE username LIKE '$username'");


        return $query->row_array()['nombre'];
    }

}
