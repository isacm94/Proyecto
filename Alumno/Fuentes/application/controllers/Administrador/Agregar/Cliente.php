<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class Cliente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        $this->load->helper('creaSelect');
        $this->load->helper('nif_validate_helper');
        $this->load->model('Mdl_provincias');
        $this->load->model('Mdl_agregar');
    }

    public function index() {
        if (! SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        //Crea el select para las provincias
        $provincias = $this->Mdl_provincias->getProvincias();
        $select = CreaSelectProvincias($provincias, 'provincia');

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErrores();
        $this->setReglasValidacion();

        if ($this->form_validation->run()) {
            $data['nombre'] = $this->input->post('nombre');
            $data['nif'] = $this->input->post('nif');
            $data['correo'] = $this->input->post('correo');
            $data['tipo'] = $this->input->post('tipo');
            $data['cuenta_corriente'] = $this->input->post('cuentacorriente');
            $data['telefono'] = $this->input->post('telefono');
            $data['direccion'] = $this->input->post('direccion');
            $data['localidad'] = $this->input->post('localidad');
            $data['cp'] = $this->input->post('cp');
            $data['idProvincia'] = $this->input->post('provincia');
            $data['anotaciones'] = $this->input->post('anotaciones');
            $this->Mdl_agregar->add('cliente', $data);
        }

//        echo '<pre>';
//        print_r($_POST);
//        echo '</pre>';
        $cuerpo = $this->load->view('adm_addCliente', array('selectProvincias' => $select), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Cliente', "<i class='fa fa-users fa-lg' aria-hidden='true'></i>" . ' Agregar Cliente');
    }

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario agregar proveedor
     */
    function setMensajesErrores() {
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('NIF_check', 'Formato de NIF incorrecto');
        $this->form_validation->set_message('NIF_unico_check', 'El NIF ya está guardado');
        $this->form_validation->set_message('valid_email', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('exact_length', 'El campo %s debe tener %s caracteres');
        $this->form_validation->set_message('integer', 'El campo %s debe ser números enteros');
        $this->form_validation->set_message('FormatoCorrectoTelefono', 'Formato incorrecto');
        
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario agregar proveedor
     */
    function setReglasValidacion() {
        //Proveedor
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('nif', 'NIF', 'required|callback_NIF_check|callback_NIF_unico_check');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('telefono', 'teléfono', 'required|integer|exact_length[9]|callback_FormatoCorrectoTelefono');
        $this->form_validation->set_rules('cuentacorriente', 'Cuenta Corriente', 'required|integer|exact_length[20]');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        $this->form_validation->set_rules('direccion', 'dirección', 'required');
        $this->form_validation->set_rules('localidad', 'localidad', 'required');
        $this->form_validation->set_rules('cp', 'Código Postal', 'required|integer|exact_length[5]');
        $this->form_validation->set_rules('provincia', 'provincia', 'required');
    }

    function NIF_check($NIF) {
        if (isValidNIF($NIF)) {
            return true;
        } else {
            return false;
        }
    }

    function NIF_unico_check($nif) {
        if ($this->Mdl_agregar->getCountNIFCliente($nif) > 0) {
            return false;
        }

        return true;
    }

    /**
     * Función que comprueba que el formato de teléfono sea correcto.
     * El teléfono debe empezar por 9, 8, 6 o 7 seguidor de 8 dígitos del 0 al 9
     * @param String $telefono Número de teléfono
     * @return boolean True si el formato es correcto
     */
    function FormatoCorrectoTelefono($telefono) {

        $telefono = str_replace(' ', '', $telefono); //devuelve cadena sin espacios
        $telefono = str_replace('-', '', $telefono); //devuelve cadena sin guiones

        $expresion = '/^[9|8|6|7][0-9]{8}$/'; //formato español

        if (preg_match($expresion, $telefono)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
