<?php

/**
 * MODELO que gestiona el inicio de sesión en la aplicación
 */
class Mdl_login extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Devuelve si el nombre de un usuario está guardado en la base de datos y es administrador
     * @param String $username Nombre de usuarios
     * @return boolean
     */
    public function checkLoginAdmin($username) {

        $query = $this->db->query("SELECT count(*) 'cont' "
                . "FROM usuario "
                . "WHERE username LIKE '$username' AND tipo LIKE 'Administrador' AND estado LIKE 'Alta'");

        if ($query->row_array()['cont'] > 0)
            return true;
        else
            return false;
    }
    
    /**
     * Devuelve si el nombre de un usuario está guardado en la base de datos
     * @param String $username Nombre de usuarios
     * @return boolean
     */
    public function checkLogin($username) {

        $query = $this->db->query("SELECT count(*) 'cont' "
                . "FROM usuario "
                . "WHERE username LIKE '$username' AND estado LIKE 'Alta'");

        if ($query->row_array()['cont'] > 0)
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
    
    /**
     * Devuelve el tipo de un usuario
     * @param String $username Nombre de usuario
     * @return Int
     */
    public function getTipo($username) {
        $query = $this->db->query("SELECT tipo "
                . "FROM usuario "
                . "WHERE username LIKE '$username'");


        return $query->row_array()['tipo'];
    }

}
