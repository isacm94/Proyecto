<?php

/**
 * MODELO DEL MÓDULO DE ADMINISTRACIÓN 
 */
class Mdl_templates extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getTemplateActivaAdmin() {

        $query = $this->db->query("SELECT template_activa "
                . "FROM template_activa "
                . "WHERE tipo LIKE 'Administración'");

        return $query->row_array()['template_activa'];
    }

    public function getTemplateActivaVenta() {

        $query = $this->db->query("SELECT template_activa "
                . "FROM template_activa "
                . "WHERE tipo LIKE 'Venta'");

        return $query->row_array()['template_activa'];
    }

    public function UpdateTemplateActiva($tipo, $template) {

        $data = array('template_activa' => $template);

        $this->db->where('tipo', $tipo);
        $this->db->update('template_activa', $data);
    }

}
