<?php

/**
 * MODELO 
 */
class Mdl_perfil extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getDatosPerfil($id) {
        $query = $this->db->query("SELECT username, nombre, correo "
                . "FROM usuario "
                . "WHERE idUsuario = $id");

        return $query->row_array();
    }
    /**
     * Consulta el número de usuario que tienen el nombre de usuario pasado por parámetro y no es el ID pasado por parámetro
     * @param String $username Nombre de usuario
     * @param Int $id ID de usuario
     * @return Int Nº de usuarios
     */
    public function getCountUsername_mod($username, $id){
        $query = $this->db->query("SELECT count(*) cont "
                . "FROM usuario "
                . "WHERE username = '$username' "
                . "AND idUsuario != $id; ");

        return $query->row_array()['cont'];        
    }
    
    /**
     * Actualiza los datos de un usuario
     * @param Int $id ID de usuario
     * @param Array $data Datos de la actualización
     */
    public function updateUsuario($id, $data) {
        $this->db->where('idUsuario', $id);
        $this->db->update('usuario', $data);
    }
    
    public function updateClave($id, $data) {
        $this->db->where('idUsuario', $id);
        $this->db->update('usuario', $data);
    }
    
}
