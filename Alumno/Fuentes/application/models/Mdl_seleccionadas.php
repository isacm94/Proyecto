<?php

/**
 * MODELO que recuperar las camisetas que estén seleccionadas en la tabla camisetas.
 */
class Mdl_seleccionadas extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Consulta las camisetas seleccionadas que se puedan mostrar
     * @param Int $limit Hasta el registro que debe devolver
     * @param Int $start Desde donde debe devolver
     * @return Array
     */
    public function getSeleccionadas($limit, $start) {

        $query = $this->db->query("SELECT cam.nombre_cam, cam.idCamiseta, cam.descripcion, cam.imagen, cam.precio, cam.descuento "
                . "FROM camiseta cam "
                . "INNER JOIN categoria cat on cam.idCategoria = cat.idCategoria "
                . "WHERE cat.mostrar=1 "
                . "AND cam.seleccionada = 1 "
                . "AND cam.mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND stock > 0 "
                . "LIMIT $start, $limit; ");


        return $query->result_array();
    }

    /**
     * Consulta el número de camisetas selecciondas que se pueden mostrar
     * @return Int Nº de camisetas
     */
    public function getNumTotalCamisetasSeleccionadas() {
        $query = $this->db->query("SELECT cam.idCamiseta "
                . "FROM camiseta cam "
                . "INNER JOIN categoria cat on cam.idCategoria = cat.idCategoria "
                . "WHERE cat.mostrar=1 "
                . "AND cam.seleccionada = 1 "
                . "AND cam.mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND stock > 0 ");

        return $query->num_rows();
    }

}
