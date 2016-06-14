<?php

/**
 * MODELO DEL MÓDULO DE ADMINISTRACIÓN usado para la configuración de plantillas
 */
class Mdl_templates extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Consulta la plantilla que esté activa del módulo de Administrador
     * @return String Nombre del fichero de la plantilla Activa
     */
    public function getTemplateActivaAdmin() {

        $query = $this->db->query("SELECT template_activa "
                . "FROM template_activa "
                . "WHERE tipo LIKE 'Administración'");

        return $query->row_array()['template_activa'];
    }

    /**
     * Consulta la plantilla que esté activa del módulo de Venta
     * @return String Nombre del fichero de la plantilla Activa
     */
    public function getTemplateActivaVenta() {

        $query = $this->db->query("SELECT template_activa "
                . "FROM template_activa "
                . "WHERE tipo LIKE 'Venta'");

        return $query->row_array()['template_activa'];
    }

    /**
     * Cambia la plantilla activa
     * @param String $tipo Tipo de plantilla: Venta o Administración
     * @param String $template Nombre del fichero de la plantilla
     */
    public function UpdateTemplateActiva($tipo, $template) {

        $data = array('template_activa' => $template);

        $this->db->where('tipo', $tipo);
        $this->db->update('template_activa', $data);
    }

}
