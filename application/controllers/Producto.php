<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('ProductoModel');
		$this->load->model('CategoriaModel');
		//$this->load->model('BannerModel');
		//$this->load->model('ServicioModel');
		// carga los datos
		$this->load->model('DatosModel');
	}

	public function index()
	{
		// Productos para la pagina principal
		$data['ProductosPrincipal'] = $this->ProductoModel->ListarPrincipal();
		// categorias para la pagina principal
		$data['categorias'] = $this->CategoriaModel->obtenerCategoriasActivas();

		$this->load->view('/template/head');
		$this->load->view('Productos/Principal',$data);
		$this->load->view('/template/footer');
	}

	public function viewProductos()
	{
			$data['productos'] = $this->ProductoModel->obtenerProductos();

			$this->load->view('/template/head');
			$this->load->view('Productos/VerProductos', $data);
			$this->load->view('/template/footer');
	}

    public function formProducto()
    {
        $data['categorias'] = $this->CategoriaModel->obtenerCategoriasActivas();

        $this->load->view('/template/head');
				$this->load->view('Productos/AgregarProducto',$data);
				$this->load->view('/template/footer');
    }

	public function modProducto()
    {
		//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();
		$data['categorias'] = $this->CategoriaModel->obtenerCategoriasActivas();
		$data['productos'] = $this->ProductoModel->obtenerProductos();

    $this->load->view('/template/head');
		$this->load->view('Productos/ModificarProducto', $data);
		$this->load->view('/template/footer');
    }

	public function agregarProducto()
	{
		$data = array();
		if(!empty($_FILES['imagen']['name']))
		{
					 $filesCount = count($_FILES['imagen']['name']);
					 for($i = 0; $i < $filesCount; $i++)
					 {
							 $_FILES['image']['name'] = $_FILES['imagen']['name'][$i];
							 $_FILES['image']['type'] = $_FILES['imagen']['type'][$i];
							 $_FILES['image']['tmp_name'] = $_FILES['imagen']['tmp_name'][$i];
							 $_FILES['image']['error'] = $_FILES['imagen']['error'][$i];
							 $_FILES['image']['size'] = $_FILES['imagen']['size'][$i];

							 $uploadPath = '././assets/img/productos';
							 $config['upload_path'] = $uploadPath;
							 $config['allowed_types'] = 'gif|jpg|png|jpeg';

							 $this->load->library('upload', $config);
							 $this->upload->initialize($config);
							 if($this->upload->do_upload('image'))
							 {
									 $fileData = $this->upload->data();
									 $uploadData[$i]['file_name'] = $fileData['file_name'];
									 $uploadData[$i]['created'] = date("Y-m-d H:i:s");
									 $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
							 }

							 if(empty($uploadData))
							 {
								 $data['error'] = array('error' => $this->upload->display_errors());
								 $data['categorias'] = $this->CategoriaModel->obtenerCategoriasActivas();

				 				 $this->load->view('/template/head');
				 			 	 $this->load->view('Productos/AgregarProducto',$data);
				 				 $this->load->view('/template/footer');
							 }else {
								 $base = base_url();

								 $data_img = array(
				 					'id_producto' => $this->input->post('codigo'),
				 					'url' => $base.'assets/img/productos/'.$uploadData[$i]['file_name']
				 				 );

								 $this->ProductoModel->crearImagen($data_img);

				 				 $data['exito'] = array('exito' => 'Producto creado con éxito');
								 $data['categorias'] = $this->CategoriaModel->obtenerCategoriasActivas();

				 				 $this->load->view('/template/head');
				 				 $this->load->view('Productos/AgregarProducto',$data);
				 				 $this->load->view('/template/footer');
							 }
			     }

					 if(!empty($uploadData))
					 {
						 $data_prod = array(
							'codigo' => $this->input->post('codigo'),
							'nombre' => $this->input->post('nombre'),
							'descripcion' => $this->input->post('descripcion'),
							'precio' => $this->input->post('precio'),
							'descuento' => $this->input->post('descuento'),
							'marca'=> $this->input->post('marca'),
							'cantidad' => $this->input->post('cantidad'),
							'habilitado' => $this->input->post('habilitado'),
							'nuevo' => $this->input->post('nuevo'),
							'categoria' => $this->input->post('categoria')
							//'imagen' => $base.'assets/img/productos/'.$file_name
						 );

						 $this->ProductoModel->crearProducto($data_prod);
					 }
		}
	}


	public function Categoria($categoria)
	{
		$id_categoria = $categoria;//$_GET['id_categoria'];

		$data['id_categoria'] = $id_categoria;
		$data['categorias']   = $this->CategoriaModel->obtenerCategoriasActivas();

			// Productos de la categoria
		$data['productos'] = $this->ProductoModel->ProductosPorCategoria($id_categoria);

		$this->load->view('/template/head',$data);
		$this->load->view('Productos/PorCategoria',$data);
		$this->load->view('/template/footer',$data);
	}

	public function updateHabilitado()
	{
		$data = array(
			'codigo' => $this->input->post('codigo'),
			'estado' => $this->input->post('estado')
		);

		echo $this->ProductoModel->updHabilitado($data);
	}

	public function updateNuevo()
	{
		$data = array(
			'codigo' => $this->input->post('codigo'),
			'estado' => $this->input->post('estado')
		);

		echo $this->ProductoModel->updNuevo($data);
	}

	 public function buscaProducto()
	 {
			$data = array(
				'texto' => htmlspecialchars($this->input->post('texto_buscar')),
			);

			$datos['productos'] = $this->ProductoModel->buscaProductos($data);

			if($datos['productos'] == false)
			{
				$this->load->view('/template/head');
				$this->load->view('Productos/Busqueda');
				$this->load->view('/template/footer');		
			}else{
				$this->load->view('/template/head');
				$this->load->view('Productos/Busqueda',$datos);
				$this->load->view('/template/footer');
			}
	 }

	 public function editarProducto()
	 {
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'descripcion' => $this->input->post('descripcion'),
				'categoria' => $this->input->post('categoria'),
				'precio' => $this->input->post('precio'),
				'descuento' => $this->input->post('descuento'),
				'id' => $this->input->post('id')
			);

			$res = $this->ProductoModel->editProducto($data);

			if($res){
				$previous = $_SERVER['HTTP_REFERER'];
				redirect($previous);
			}

			//$this->load->view('/template/head');
			//$this->load->view('Productos/Busqueda',$datos);
			//$this->load->view('/template/footer');
	 }

	 public function vistaProducto($codigo)
	 {
		 	$datos['producto'] = $this->ProductoModel->detalleProducto($codigo);

			$this->load->view('/template/head');
			$this->load->view('Productos/product-page', $datos);
			$this->load->view('/template/footer');
	 }

	 public function valida_codigo($codigo)
	 {
			$res = $this->ProductoModel->val_cod($codigo);

			echo $res;
	 }
}
