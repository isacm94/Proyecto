<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
 */
class Agregar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        $this->load->helper('creaSelect');
        $this->load->helper('nif_validate_helper');
        $this->load->model('Mdl_provincias');
        $this->load->model('Mdl_agregar');
    }

    public function index() {
        
    }

    /*     * *** AGREGAR PROVEEDOR **** */

    public function Proveedor() {

        //Crea el select para las provincias
        $provincias = $this->Mdl_provincias->getProvincias();
        $select = CreaSelectProvincias($provincias, 'provincia');

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErroresProveedor();
        $this->setReglasValidacionProveedor();

        if ($this->form_validation->run()) {
            $data['nombre'] = $this->input->post('nombre');
            $data['nif'] = $this->input->post('nif');
            $data['correo'] = $this->input->post('correo');
            $data['direccion'] = $this->input->post('direccion');
            $data['localidad'] = $this->input->post('localidad');
            $data['cp'] = $this->input->post('cp');
            $data['idProvincia'] = $this->input->post('provincia');
            $data['anotaciones'] = $this->input->post('anotaciones');
            $this->Mdl_agregar->add('proveedor', $data);
        }

        $cuerpo = $this->load->view('adm_addProveedor', array('selectProvincias' => $select), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Producto', "<i class='fa fa-truck fa-lg' aria-hidden='true'></i>" . ' Agregar Proveedor');
    }

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario agregar proveedor
     */
    function setMensajesErroresProveedor() {
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('NIF_check', 'Formato de NIF incorrecto');
        $this->form_validation->set_message('NombreProveedor_unico_check', 'El nombre ya está guardado');
        $this->form_validation->set_message('valid_email', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('exact_length', 'El campo %s debe tener %s caracteres');
        $this->form_validation->set_message('integer', 'El campo %s debe ser un número entero');
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario agregar proveedor
     */
    function setReglasValidacionProveedor() {
        //Proveedor
        $this->form_validation->set_rules('nombre', 'nombre', 'required|callback_NombreProveedor_unico_check');
        $this->form_validation->set_rules('provincia', 'provincia', 'required');
        $this->form_validation->set_rules('nif', 'NIF', 'required|callback_NIF_check');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('direccion', 'dirección', 'required');
        $this->form_validation->set_rules('localidad', 'localidad', 'required');
        $this->form_validation->set_rules('cp', 'Código Postal', 'required|integer|exact_length[5]');
    }

    function NIF_check($NIF) {
        if (isValidNIF($NIF)) {
            return true;
        } else {
            return false;
        }
    }

    function NombreProveedor_unico_check($nombre) {
        if ($this->Mdl_agregar->getCountNombreProveedor($nombre) > 0) {
            return false;
        }

        return true;
    }

    /*     * *** AGREGAR CATEGORÍA **** */

    public function Categoria() {

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_rules('nombre', 'nombre de categoría', 'required|callback_NombreCategoria_unico_check');
        $this->form_validation->set_message('NombreCategoria_unico_check', 'El nombre de la categoría ya está guardado');

        if ($this->form_validation->run()) {
            $data['nombre'] = $this->input->post('nombre');
            $data['descripcion'] = $this->input->post('descripcion');
            $this->Mdl_agregar->add('categoria', $data);
        }

        $cuerpo = $this->load->view('adm_addCategoria', '', true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Categoria', "<i class='fa fa-folder-open fa-lg' aria-hidden='true'></i>" . ' Agregar Categoría');
    }

    function NombreCategoria_unico_check($nombre) {
        if ($this->Mdl_agregar->getCountNombreCategoria($nombre) > 0) {
            return false;
        }

        return true;
    }

    /*     * *** AGREGAR PRODUCTO **** */

    public function Producto() {
        $error_img = "";

        //Crea el select para categorias
        $categorias = $this->Mdl_agregar->getCategorias();
        $select_categorias = CreaSelect($categorias, 'Categoria', 'Seleccione una categoría');

        //Crea el select para proveedores
        $proveedores = $this->Mdl_agregar->getProveedores();
        $select_proveedores = CreaSelect($proveedores, 'Proveedor', 'Seleccione un proveedor');

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErroresProducto();
        $this->setReglasValidacionProducto();

        if ($this->form_validation->run() && $this->checkImagenEnviada() && $_FILES["imagen"]["error"] == 0 && $this->checkTipoImagen()) {
            
            $data['nombre'] = $this->input->post('nombre');
            $data['marca'] = $this->input->post('marca');
            $data['precio'] = $this->input->post('precio');
            $data['precio_venta'] = $this->getPrecioMasIVA($this->input->post('precio_venta'), $this->input->post('iva'));
            $data['iva'] = $this->input->post('iva');
            $data['stock'] = $this->input->post('stock');
            $data['idCategoria'] = $this->input->post('Categoria');
            $data['idProveedor'] = $this->input->post('Proveedor');
            $data['imagen'] = $this->ProcesaImagen();
            $this->Mdl_agregar->add('producto', $data);
            
        } else if (! $this->checkImagenEnviada() /*&& $this->input->post()*/) {//Comprobar si se ha enviado la imagen, sólo si se ha enviado el formulario
            $error_img = "<div class='alert msgerror'><b>¡Error! </b> Imagen no seleccionada</div>'";
        }
        else if ($_FILES["imagen"]["error"] > 0){
            $error_img = "<div class='alert msgerror'><b>¡Error! </b> Ha ocurrido un error en la subida de la imagen</div>'";
        }
        else if(! $this->checkTipoImagen()){
            $error_img = "<div class='alert msgerror'><b>¡Error! </b> La imagen debe ser <i>jpg, jpeg, gif o png</i></div>'";
        }
        echo '<pre>';
        print_r($_FILES);
        echo '</pre>';
        $cuerpo = $this->load->view('adm_addProducto', Array('select_categorias' => $select_categorias, 'select_proveedores' => $select_proveedores, 'error_img' => $error_img), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Agregar Producto');
    }
    
    
    function ProcesaImagen(){
        $ruta = base_url()."images/" .$_FILES['imagen']['name'];
        
        $resultado = move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
        
        return "images/".$_FILES['imagen']['name'];
    }
    
    function checkTipoImagen(){
        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
        
        if ($_FILES && in_array($_FILES['imagen']['type'], $permitidos))
                return true;
        
        return false;
    }
    function checkImagenEnviada() {
        if ($_FILES)//Si se ha enviado la imagen
            return true;

        return false;
    }

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario agregar producto
     */
    function setMensajesErroresProducto() {
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('NombreProducto_unico_check', 'El nombre ya está guardado');
        $this->form_validation->set_message('integer', 'El campo %s debe ser un número entero');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser númerico');
        $this->form_validation->set_message('CategoriaSeleccionada_check', 'Categoría no seleccionada');
        $this->form_validation->set_message('ProveedorSeleccionada_check', 'Proveedor no seleccionado');
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario agregar producto
     */
    function setReglasValidacionProducto() {
        //Proveedor
        $this->form_validation->set_rules('nombre', 'nombre', 'required|callback_NombreProducto_unico_check');
        $this->form_validation->set_rules('marca', 'marca', 'required');
        $this->form_validation->set_rules('precio', 'precio', 'required|numeric');
        $this->form_validation->set_rules('precio_venta', 'precio de venta', 'required|numeric');
        $this->form_validation->set_rules('iva', 'IVA', 'required|numeric');
        $this->form_validation->set_rules('stock', 'stock', 'required|integer');
        $this->form_validation->set_rules('Categoria', 'categoría', 'callback_CategoriaSeleccionada_check');
        $this->form_validation->set_rules('Proveedor', 'proveedor', 'callback_ProveedorSeleccionada_check');
    }

    function NombreProducto_unico_check($nombre) {
        if ($this->Mdl_agregar->getCountNombreProducto($nombre) > 0) {
            return false;
        }

        return true;
    }

    function getPrecioMasIVA($precio, $iva) {
        return $precio * (1 + $iva);
    }

    function CategoriaSeleccionada_check($categoria) {
        if ($categoria == 'defecto')
            return false;

        return true;
    }

    function ProveedorSeleccionada_check($proveedor) {
        if ($proveedor == 'defecto')
            return false;

        return true;
    }

}
