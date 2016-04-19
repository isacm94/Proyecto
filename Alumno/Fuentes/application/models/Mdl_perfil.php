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
}
