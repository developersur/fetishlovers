<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carousel extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('CarouselModel');
	}

	public function obtenerImagenes()
	{
			$data['imagenes'] = $this->CarouselModel->obtenerImg();

			//$this->load->view('/template/head');
			//$this->load->view('Productos/VerProductos', $data);
			//$this->load->view('/template/footer');
	}

	public function modProducto()
  {
			$data['productos'] = $this->ProductoModel->obtenerProductos();

      $this->load->view('/template/head');
			$this->load->view('Productos/ModificarProducto', $data);
			$this->load->view('/template/footer');
  }

	public function agregarProducto()
	{
		$config['upload_path'] = '././assets/img/productos';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 1000;
		$config['max_width'] = 5418;
		$config['max_height'] = 3048;

		$this->load->library('upload', $config);
		$datos['categorias'] = $this->CategoriaModel->obtenerCategoriasActivas();

		if (!$this->upload->do_upload('imagen'))
		{
				$datos['error'] = array('error' => $this->upload->display_errors());
				//$data['error'] = $error;


				$this->load->view('/template/head');
				$this->load->view('Productos/AgregarProducto',$datos);
				$this->load->view('/template/footer');
		} else {
				$data = array('upload_data' => $this->upload->data());

				$file_name = $this->upload->data('file_name');

				$base = base_url();;

				$data = array(
					'codigo' => $this->input->post('codigo'),
					'nombre' => $this->input->post('nombre'),
					'descripcion' => $this->input->post('descripcion'),
					'precio' => $this->input->post('precio'),
					'descuento' => $this->input->post('descuento'),
					'marca'=> $this->input->post('marca'),
					'cantidad' => $this->input->post('cantidad'),
					'habilitado' => $this->input->post('habilitado'),
					'nuevo' => $this->input->post('nuevo'),
					'categoria' => $this->input->post('categoria'),
					'imagen' => $base.'assets/img/productos/'.$file_name
				);

				$this->ProductoModel->crearProducto($data);

				$datos['exito'] = array('exito' => 'Producto creado con éxito');
				//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

				$this->load->view('/template/head');
				$this->load->view('Productos/AgregarProducto',$datos);
				$this->load->view('/template/footer');
		}
	}


	public function updateHabilitado()
	{
		$data = array(
			'codigo' => $this->input->post('codigo'),
			'estado' => $this->input->post('estado')
		);

		echo $this->ProductoModel->updHabilitado($data);
	}

	 public function editarProducto()
	 {
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'descripcion' => $this->input->post('descripcion'),
				'precio' => $this->input->post('precio'),
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
}
