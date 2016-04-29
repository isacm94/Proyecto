<?php

/**
 * MODELO relacionado con Restablecer Contraseña por correo. 
 * Recupera datos dando su id o dando su nombre de usuario y actualiza la clave.
 */
class Mdl_restablecerClave extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Consulta los datos de un usuario dando su nombre de usuario
     * @param String $username Nombre del usuario
     * @return Array
     */
    public function getDatosFromUserName($username) {

        $query = $this->db->query("SELECT idUsuario 'id', nombre 'nombre', correo "
                . "FROM usuario "
                . "WHERE username LIKE '$username'; ");

        return $query->row_array();
    }

    /**
     * Consulta los datos de un usuario dando su ID de usuario
     * @param Int $id ID de usuario
     * @return Array
     */
    public function getDatosFromId($id) {

        $query = $this->db->query("SELECT idUsuario 'id', nombre, username, correo "
                . "FROM usuario "
                . "WHERE idUsuario LIKE '$id'; ");

        return $query->row_array();
    }

    /**
     * Actualiza la clave de usuario
     * @param String $username Nombre de usuario
     * @param String $clave Contraseña encriptada
     */
    public function UpdateClave($username, $clave) {
        $data = array(
            'clave' => $clave
        );
        $this->db->where('username', $username);
        $this->db->update('usuario', $data);
    }

}
