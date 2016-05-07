<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que realiza el proceso de añadir un producto
 */
class Producto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual
        $this->load->helper('creaselect_helper');
        $this->load->helper('nif_validate_helper');
        $this->load->model('Mdl_provincias');
        $this->load->model('Mdl_agregar');
    }

    /**
     * Muestra y valida el formulario de agregar producto, si todo es correcto muestra el formulario de seleccionar una imagen
     */
    public function index() {
        if (! SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        
        //Crea el select para categorias
        $categorias = $this->Mdl_agregar->getCategorias();
        $select_categorias = CreaSelect($categorias, 'idCategoria', 'Seleccione una categoría');

        //Crea el select para proveedores
        $proveedores = $this->Mdl_agregar->getProveedores();
        $select_proveedores = CreaSelect($proveedores, 'idProveedor', 'Seleccione un proveedor');

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErrores();
        $this->setReglasValidacion();

        if ($this->form_validation->run()) {
            $post['nombre'] = $this->input->post('nombre');
            $post['marca'] = $this->input->post('marca');
            $post['precio'] = $this->input->post('precio');
            $post['precio_venta'] = $this->input->post('precio_venta');
            $post['iva'] = $this->input->post('iva');
            $post['stock'] = $this->input->post('stock');
            $post['categoria'] = $this->Mdl_agregar->getNombreCategoria($this->input->post('idCategoria'));//Guardamos su nombre
            $post['proveedor'] = $this->Mdl_agregar->getNombreProveedor($this->input->post('idProveedor'));
            $post['idCategoria'] = $this->input->post('idCategoria');//Guardamos su id
            $post['idProveedor'] = $this->input->post('idProveedor');
            $post['descripcion'] = $this->input->post('descripcion');

            $this->session->set_userdata(array('post' => $post));//Guarda el post en la sesión para mostrarlo en la imagen de seleccionar imagen
            $this->MuestraFormImagen();
        } else {
            $cuerpo = $this->load->view('adm_addProducto', Array('select_categorias' => $select_categorias, 'select_proveedores' => $select_proveedores), true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' - Agregar Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Agregar Producto');
        }
    }

    /**
     * Muestra el formulario de seleccionar la imagen del producto
     */
    function MuestraFormImagen() {
        $cuerpo = $this->load->view('adm_addImagenProducto', Array('error_img' => ''), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Agregar Imagen del Producto');
    }

    /**
     * Comprueba que la seleccion de imagen sea correcta
     */
    function ProcesaImagen() {
        
        if ($this->checkImagenEnviada()) {
            $error_img = '<div class="alert msgerror"><b>¡Error! </b> No se ha seleccionado una imagen</div>';
        } else if ($_FILES["imagen"]["error"] > 0) {//si se produce un error
            $error_img = '<div class="alert msgerror"><b>¡Error! </b> Se ha producido un error en la súbida de la imagen</div>';
        } else if (!$this->checkTipoImagen()) {//comprueba que sea una imagen
            $error_img = '<div class="alert msgerror"><b>¡Error! </b> La extensión de la imagen es incorrecta, debe ser <i>jpg</i>, <i>jpeg</i>, <i>gif</i> o <i>png</i></div>';
        } else {
            $nombre = time().'_'.$_FILES["imagen"]["name"];
            $ruta = "././images/" . $nombre;//Ruta donde tiene que guardar la imagen
            $resultado = move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);//Guarda la imagen

            if ($resultado) {
                $this->AddProducto($nombre);
                redirect('/Administrador/Lista/Productos', 'location', 301);
                $error_img = '';
            } else {
                $error_img = '<div class="alert msgerror"><b>¡Error! </b> Se ha producido un error en la súbida de la imagen</div>';
            }
        }

        $cuerpo = $this->load->view('adm_addImagenProducto', Array('error_img' => $error_img), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Agregar Imagen del Producto');
    }

    /**
     * Guarda el producto en la base de datos
     * @param String $imagen Nombre y extensión de la imagen
     */
    private function AddProducto($imagen) {
        
        foreach ($this->session->userdata('post') as $key => $value) {//Recuperamos los datos del post
           
            if ($key != "categoria" && $key != "proveedor") {//No puede guardar el nombre de la categoria y del proveedor
                $datos[$key] = $value;
            }
        }
        
        $datos['imagen'] = $imagen;//Guardamos la imagen en el array
        
        $this->Mdl_agregar->add('producto', $datos);//Añade el producto
        $this->session->unset_userdata('post');//Eliminamos los datos del post que están en la sesión
    }

    /**
     * Comprueba que el archivo enviado sea una imagen
     * @return boolean
     */
    private function checkTipoImagen() {
        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");

        if (in_array($_FILES['imagen']['type'], $permitidos))
            return true;
        else {
            return false;
        }
    }

    /**
     * Comprueba que la imagen haya sido enviada
     * @return boolean
     */
    private function checkImagenEnviada() {
        if ($_FILES['imagen']['name'] == '')//Si se ha enviado la imagen
            return true;

        return false;
    }

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario agregar producto
     */
    private function setMensajesErrores() {
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('NombreProducto_unico_check', 'El nombre ya está guardado');
        $this->form_validation->set_message('integer', 'El campo %s debe ser números entero');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser númerico');
        $this->form_validation->set_message('CategoriaSeleccionada_check', 'Categoría no seleccionada');
        $this->form_validation->set_message('ProveedorSeleccionada_check', 'Proveedor no seleccionado');
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario agregar producto
     */
    function setReglasValidacion() {
        //Proveedor
        $this->form_validation->set_rules('nombre', 'nombre', 'required|callback_NombreProducto_unico_check');
        $this->form_validation->set_rules('marca', 'marca', 'required');
        $this->form_validation->set_rules('precio', 'precio', 'required|numeric');
        $this->form_validation->set_rules('precio_venta', 'precio de venta', 'required|numeric');
        $this->form_validation->set_rules('iva', 'IVA', 'required|numeric');
        $this->form_validation->set_rules('stock', 'stock', 'required|integer');
        $this->form_validation->set_rules('idCategoria', 'categoría', 'callback_CategoriaSeleccionada_check');
        $this->form_validation->set_rules('idProveedor', 'proveedor', 'callback_ProveedorSeleccionada_check');
    }

    /**
     * Comprueba que el nombre del producto no esté repetido
     * @param String $nombre Nombre del producto
     * @return boolean
     */
    private function NombreProducto_unico_check($nombre) {
        if ($this->Mdl_agregar->getCountNombreProducto($nombre) > 0) {
            return false;
        }

        return true;
    }
    

    /**
     * Comprueba que haya sido seleccionada una categoría y no el valor por defecto
     * @param String $categoria Categoría elegida
     * @return boolean
     */
    private function CategoriaSeleccionada_check($categoria) {
        if ($categoria == 'defecto')
            return false;

        return true;
    }

    /**
     * Comprueba que haya sido seleccionada un proveedor y no el valor por defecto
     * @param String $proveedor Proveedor
     * @return boolean
     */
    private function ProveedorSeleccionada_check($proveedor) {
        if ($proveedor == 'defecto')
            return false;

        return true;
    }

}
