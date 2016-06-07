<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR DEL MÓDULO DE ADMINISTRACIÓN que muestra la lista de productos
 */
class Productos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_lista');
        $this->load->model('Mdl_agregar');
        $this->load->helper('creaselect_helper');
        $this->load->library('pagination');
        $this->load->config("paginacion");
    }

    /**
     * Muestra el listado paginado de todos los productos en forma de tabla
     * @param Int $desde Desde el registro que tiene que mostrar en la paginación
     */
    public function index($desde = 0) {
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual

        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $config = $this->getConfigPag();
        $this->pagination->initialize($config);

        $productos = $this->Mdl_lista->getProductos($desde, $config['per_page']);

        $cuerpo = $this->load->view('lista/adm_listaProductos', array('productos' => $productos), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Lista de productos', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Lista de Productos');
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    private function getConfigPag() {
        $config['base_url'] = site_url('/Administrador/Lista/Productos/index');
        $config['total_rows'] = $this->Mdl_lista->getNumTotalProductos();
        $config['per_page'] = $this->config->item('per_page_productos');
        $config['uri_segment'] = 5;
        $config['num_links'] = 6;

        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '<span></span></span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
        $config['last_link'] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
        $config['next_link'] = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        return $config;
    }

    /**
     * Muestra con detalle el producto 
     * @param Int $id ID del producto
     */
    public function Ver($id) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $producto = $this->Mdl_lista->getProducto($id);

        if (!$producto) {//Si no existe el producto, mostramos error
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $cuerpo = $this->load->view('lista/adm_detalleProducto', array('producto' => $producto), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Detalle del Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Detalle del Producto');
    }

    /**
     * Busca en la tabla de productos de la base de datos por el campo introducido y muestra los resultados obtenidos en una tabla paginada
     * @param Int $desde Desde el registro que tiene que mostrar en la paginación
     */
    function Buscar($desde = 0) {
        $this->session->set_userdata(array('pagina-actual' => current_url())); //Guardamos la URL actual

        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        if ($this->input->post()) {
            $campo = $this->input->post('campo'); //Cogemos el valor del post
            $this->session->set_userdata(array('campo' => $campo)); //Lo guardamos en la sesión para la paginación
        } else {
            $campo = $this->session->userdata('campo'); //Recuperamos el dato del post
        }

        if ($campo == '') {//Si no se ha introducido nada, mostramos la lista completa
            redirect('/Administrador/Lista/Productos', 'location', 301);
            return;
        }

        $config = $this->getConfigPagBuscar($campo);
        $this->pagination->initialize($config);

        $productos = $this->Mdl_lista->BusquedaProducto($campo, $desde, $config['per_page']);

        $sinrdo = "";
        $mensajebuscar = "";

        if (!$productos) {//No se ha encontrado nada
            $sinrdo = "No se ha encontrado ningún resultado en la búsqueda de <i>'$campo'</i>. Inténtelo de nuevo o vea la <a href='" . site_url('/Administrador/Lista/Productos') . "'class=''>lista completa</a>";
        } else {
            $mensajebuscar = "Resultado para la búsqueda <i>'$campo'</i>";
        }

        $cuerpo = $this->load->view('lista/adm_listaProductos', array('productos' => $productos, 'mensajebuscar' => $mensajebuscar, 'sinrdo' => $sinrdo), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Lista de productos', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Lista de Productos');
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    private function getConfigPagBuscar($campo) {
        $config['base_url'] = site_url('/Administrador/Lista/Productos/Buscar');
        $config['total_rows'] = $this->Mdl_lista->BusquedaNumProductos($campo);
        $config['per_page'] = $this->config->item('per_page_productos');
        $config['uri_segment'] = 5;
        $config['num_links'] = 6;

        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '<span></span></span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
        $config['last_link'] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
        $config['next_link'] = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        return $config;
    }

    /**
     * Cambia su estado a baja
     * @param Int $id ID de la categoría
     */
    public function Baja($id) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->Mdl_lista->setBaja('producto', $id);

        redirect($this->session->userdata('pagina-actual'), 'Location', 301);
    }

    /**
     * Cambia su estado a alta
     * @param Int $id ID de la categoría
     */
    public function Alta($id) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $this->Mdl_lista->setAlta('producto', $id);

        redirect($this->session->userdata('pagina-actual'), 'Location', 301);
    }

    /**
     * Actualiza los datos de un producto
     * @param Int $id ID del producto
     */
    function Modificar($id) {
        if (!SesionIniciadaCheckAdmin()) { //Si no se ha iniciado sesión, vamos al login
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }

        $producto = $this->Mdl_lista->getProducto($id); //Consultamos los datos de la categoría
        if (!$producto) {//Si no existe el producto, mostramos error
            redirect('/Administrador/Login', 'location', 301);
            return; //Sale de la función
        }
        if (!$this->input->post()) {//Si no existen el post, guardamos en post los datos de la categoria, para que los muestre en el formulario
            $producto['precio'] = round($producto['precio'], 2);//Redondeamos para que no salga 00 después de la coma
            $producto['precio_venta'] = round($producto['precio_venta'], 2);
            $producto['iva'] = round($producto['iva'], 2);
            $_POST = $producto;
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

        $error_nom = "";
        $mensajeok = "";

        if ($this->form_validation->run() && $this->NombreProducto_unico_check($this->input->post('nombre'), $id)) {
            //VALIDACIÓN CORRECTA
            $post['nombre'] = $this->input->post('nombre');
            $post['marca'] = $this->input->post('marca');
            $post['precio'] = $this->input->post('precio');
            $post['precio_venta'] = $this->input->post('precio_venta');
            $post['iva'] = $this->input->post('iva');
            $post['stock'] = $this->input->post('stock');
            $post['categoria'] = $this->Mdl_agregar->getNombreCategoria($this->input->post('idCategoria')); //Guardamos su nombre
            $post['proveedor'] = $this->Mdl_agregar->getNombreProveedor($this->input->post('idProveedor'));
            $post['idCategoria'] = $this->input->post('idCategoria'); //Guardamos su id
            $post['idProveedor'] = $this->input->post('idProveedor');
            $post['descripcion'] = $this->input->post('descripcion');
            $post['imagen'] = $this->Mdl_lista->getImagen($id);
            $post['idProducto'] = $id;
            $this->session->set_userdata(array('post' => $post)); //Guarda el post en la sesión para mostrarlo en la imagen de seleccionar imagen
            $this->MuestraFormImagen();
        } else if (!$this->NombreProducto_unico_check($this->input->post('nombre'), $id)) {//Nombre de producto repetido
            $error_nom = '<div class="alert msgerror"><b>¡Error! </b> El nombre ya está guardado</div>';
        } else {//VALIDACIÓN INCORRECTA
            $cuerpo = $this->load->view('lista/adm_modProducto', array('id' => $id, 'error_nom' => $error_nom, 'mensajeok' => $mensajeok, 'select_categorias' => $select_categorias, 'select_proveedores' => $select_proveedores), true); //Generamos la vista 
            CargaPlantillaAdmin($cuerpo, ' | Modificar Producto', "<i class='fa fa-folder-open fa-lg' aria-hidden='true'></i>" . ' Modificar Producto');
        }
    }

    /**
     * Muestra el formulario de seleccionar la imagen del producto
     */
    function MuestraFormImagen() {
        $cuerpo = $this->load->view('lista/adm_modImagenProducto', Array('error_img' => ''), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Modificar Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Modificar Imagen del Producto');
    }

    /**
     * Comprueba que la seleccion de imagen sea correcta
     */
    function ProcesaImagen() {
        $error_img = '';
        $resultado = false;
        if ($this->input->post('toggle-imagen') != NULL && $this->input->post('toggle-imagen') == 'on') {//Quiere cambiar imagen
            if ($this->checkImagenEnviada()) {
                $error_img = '<div class="alert msgerror"><b>¡Error! </b> No se ha seleccionado una imagen</div>';
            } else if ($_FILES["imagen"]["error"] > 0) {//si se produce un error
                $error_img = '<div class="alert msgerror"><b>¡Error! </b> Se ha producido un error en la súbida de la imagen</div>';
            } else if (!$this->checkTipoImagen()) {//comprueba que sea una imagen
                $error_img = '<div class="alert msgerror"><b>¡Error! </b> La extensión de la imagen es incorrecta, debe ser <i>jpg</i>, <i>jpeg</i>, <i>gif</i> o <i>png</i></div>';
            } else {
                $nombre = time() . '_' . $_FILES["imagen"]["name"];
                $ruta = "././images/" . $nombre; //Ruta donde tiene que guardar la imagen
                $resultado = move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta); //Guarda la imagen

                if ($resultado) {
                    $this->updateProducto($nombre); //Añade el producto actualizando la imagen                    
                } else {
                    $error_img = '<div class="alert msgerror"><b>¡Error! </b> Se ha producido un error en la súbida de la imagen</div>';
                }
            }

            if (!$resultado) {
                $cuerpo = $this->load->view('lista/adm_modImagenProducto', Array('error_img' => $error_img, 'mensajeok' => ''), true); //Generamos la vista 
                CargaPlantillaAdmin($cuerpo, ' | Modificar Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Modificar Imagen del Producto');
            }
        } else {//Añade el producto sin actualizar la imagen
            $this->updateProducto();
        }
    }

    /**
     * Actualiza los datos del producto en la base de datos si el procesado de imagen ha ido correctamente
     * @param type $imagen
     */
    private function updateProducto($imagen = '') {

        $post = $this->session->userdata('post');
        foreach ($post as $key => $value) {//Recuperamos los datos del post
            if ($key != "categoria" && $key != "proveedor" && $key != 'idProducto') {//No puede guardar el nombre de la categoria y del proveedor
                $datos[$key] = $value;
            }
        }
        if ($imagen != '') {
            $datos['imagen'] = $imagen; //Pasamos la imagen para que lo actualice
            $post['imagen'] = $imagen; //pasamos la nueva imagen para que la muestre
            $this->session->set_userdata(array('post' => $post));
        }

        $this->Mdl_lista->update('producto', $post['idProducto'], $datos); //Añade los datos del post       

        $mensajeok = '<div class="alert alert-success msgok">¡Se ha modificado correctamente!'
                . ' <a href="' . site_url('/Administrador/Lista/Productos') . '" class="link">Volver a la lista</a></div>';

        $cuerpo = $this->load->view('lista/adm_modImagenProducto', Array('error_img' => '', 'mensajeok' => $mensajeok), true); //Generamos la vista 
        CargaPlantillaAdmin($cuerpo, ' | Modificar Producto', "<i class='fa fa-dropbox fa-lg' aria-hidden='true'></i>" . ' Modificar Imagen del Producto');

        //$this->session->unset_userdata('post'); //Borra los datos de la sesión
    }

    /**
     * Comprueba que el archivo enviado sea una imagen
     * @return boolean
     */
    function checkTipoImagen() {
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
        $this->form_validation->set_message('integer', 'El campo %s debe ser números entero');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser númerico');
        $this->form_validation->set_message('CategoriaSeleccionada_check', 'Categoría no seleccionada');
        $this->form_validation->set_message('ProveedorSeleccionada_check', 'Proveedor no seleccionado');
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario agregar producto
     */
    function setReglasValidacion() {
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('marca', 'marca', 'required');
        $this->form_validation->set_rules('precio', 'precio', 'required|numeric');
        $this->form_validation->set_rules('precio_venta', 'precio de venta', 'required|numeric');
        $this->form_validation->set_rules('iva', 'IVA', 'required|numeric');
        $this->form_validation->set_rules('stock', 'stock', 'required|integer');
        $this->form_validation->set_rules('idCategoria', 'categoría', 'callback_CategoriaSeleccionada_check');
        $this->form_validation->set_rules('idProveedor', 'proveedor', 'callback_ProveedorSeleccionada_check');
    }

    /**
     * Comprueba que el nombre del producto no esté repetido, sin contar al suyo
     * @param String $nombre Nombre de la categoría
     * @param Int $id ID del producto
     * @return boolean
     */
    function NombreProducto_unico_check($nombre, $id) {
        if ($this->Mdl_lista->getCountNombreProducto($nombre, $id) > 0) {
            return false;
        }

        return true;
    }

    /**
     * Comprueba que haya sido seleccionada una categoría y no el valor por defecto
     * @param String $categoria Categoría elegida
     * @return boolean
     */
    function CategoriaSeleccionada_check($categoria) {
        if ($categoria == 'defecto')
            return false;

        return true;
    }

    /**
     * Comprueba que haya sido seleccionada un proveedor y no el valor por defecto
     * @param String $proveedor Proveedor
     * @return boolean
     */
    function ProveedorSeleccionada_check($proveedor) {
        if ($proveedor == 'defecto')
            return false;

        return true;
    }

}
