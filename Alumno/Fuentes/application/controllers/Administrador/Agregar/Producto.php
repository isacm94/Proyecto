<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR
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

    public function index() {
        if (! SesionIniciadaCheck()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        
        //Crea el select para categorias
        $categorias = $this->Mdl_agregar->getCategorias();
        $select_categorias = CreaSelect($categorias, 'Categoria', 'Seleccione una categoría');

        //Crea el select para proveedores
        $proveedores = $this->Mdl_agregar->getProveedores();
        $select_proveedores = CreaSelect($proveedores, 'Proveedor', 'Seleccione un proveedor');

        $this->form_validation->set_error_delimiters('<div class="alert msgerror"><b>¡Error! </b>', '</div>');
        $this->setMensajesErrores();
        $this->setReglasValidacion();

        if ($this->form_validation->run()) {
            $post['nombre'] = $this->input->post('nombre');
            $post['marca'] = $this->input->post('marca');
            $post['precio'] = $this->input->post('precio');
            $post['precio_venta'] = $this->getPrecioMasIVA($this->input->post('precio_venta'), $this->input->post('iva'));
            $post['iva'] = $this->input->post('iva');
            $post['stock'] = $this->input->post('stock');
            $post['categoria'] = $this->Mdl_agregar->getNombreCategoria($this->input->post('Categoria'));//Guardamos su nombre
            $post['proveedor'] = $this->Mdl_agregar->getNombreProveedor($this->input->post('Proveedor'));
            $post['idCategoria'] = $this->input->post('Categoria');//Guardamos su id
            $post['idProveedor'] = $this->input->post('Proveedor');
            $post['descripcion'] = $this->input->post('descripcion');

            $this->session->set_userdata(array('post' => $post));
            $this->MuestraFormImagen();
        } else {
            $cuerpo = $this->load->view('adm_addProducto', Array('select_categorias' => $select_categorias, 'select_proveedores' => $select_proveedores), true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' - Agregar Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Agregar Producto');
        }
    }

    function MuestraFormImagen() {
        $cuerpo = $this->load->view('adm_addImagenProducto', Array('error_img' => ''), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Agregar Imagen del Producto');
    }

    function ProcesaImagen() {
        $correcto = true;
        if ($this->checkImagenEnviada()) {
            $error_img = '<div class="alert msgerror"><b>¡Error! </b> No se ha seleccionado una imagen</div>';
        } else if ($_FILES["imagen"]["error"] > 0) {
            $error_img = '<div class="alert msgerror"><b>¡Error! </b> Se ha producido un error en la súbida de la imagen</div>';
        } else if (!$this->checkTipoImagen()) {
            $error_img = '<div class="alert msgerror"><b>¡Error! </b> La extensión de la imagen es incorrecta, debe ser <i>jpg</i>, <i>jpeg</i>, <i>gif</i> o <i>png</i></div>';
        } else {
            $ruta = "././images/" . $_FILES['imagen']['name'];
            $resultado = move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

            if ($resultado) {
                $this->AddProducto($_FILES['imagen']['name']);
                //Redirigir
                $error_img = '';
            } else {
                $error_img = '<div class="alert msgerror"><b>¡Error! </b> Se ha producido un error en la súbida de la imagen</div>';
            }
        }

        $cuerpo = $this->load->view('adm_addImagenProducto', Array('error_img' => $error_img), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' - Agregar Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Agregar Imagen del Producto');
    }

    function AddProducto($imagen) {
        $post = $this->session->userdata('post');

        $data['nombre'] = $post['nombre'];
        $data['marca'] = $post['marca'];
        $data['precio'] = $post['precio'];
        $data['precio_venta'] = $this->getPrecioMasIVA($post['precio_venta'], $post['iva']);
        $data['iva'] = $post['iva'];
        $data['stock'] = $post['stock'];
        $data['idCategoria'] = $post['idCategoria'];
        $data['idProveedor'] = $post['idProveedor'];
        $data['imagen'] = $imagen;
        $this->Mdl_agregar->add('producto', $data);
    }

    function checkTipoImagen() {
        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");

        if (in_array($_FILES['imagen']['type'], $permitidos))
            return true;
        else {
            return false;
        }
    }

    function checkImagenEnviada() {
        if ($_FILES['imagen']['name'] == '')//Si se ha enviado la imagen
            return true;

        return false;
    }

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario agregar producto
     */
    function setMensajesErrores() {
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
        return $precio * (1 + ($iva / 100));
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
