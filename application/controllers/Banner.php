<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
    $this->load->model('BannerModel');
    $this->load->model('ProductoModel');
		$this->load->model('CategoriaModel');
		$this->load->model('DatosModel');
	}

	public function viewBanner()
	{
			$data['banners'] = $this->BannerModel->obtenerBanners();

			$this->load->view('/template/head');
			$this->load->view('Banner/VerBanners', $data);
			$this->load->view('/template/footer');
	}

	public function modBanner()
  {
		$data['banners'] = $this->BannerModel->obtenerBanners();

	  $this->load->view('/template/head');
		$this->load->view('Banner/ModificarBanners', $data);
		$this->load->view('/template/footer');
  }

  public function formBanner()
  {
      //$data['categorias'] = $this->CategoriaModel->obtenerCategoriasActivas();

      $this->load->view('/template/head');
			$this->load->view('Banner/AgregarBanner');
			$this->load->view('/template/footer');
  }


	public function agregarBanner()
	{
		$config['upload_path'] = '././assets/img/banner';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 2000;
		$config['max_width'] = 5418;
		$config['max_height'] = 3048;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('imagen'))
		{
				$datos['error'] = array('error' => $this->upload->display_errors());

				$this->load->view('/template/head');
				$this->load->view('Banner/AgregarBanner',$datos);
				$this->load->view('/template/footer');
		} else {
				$data = array('upload_data' => $this->upload->data());

				$file_name = $this->upload->data('file_name');

				$base = base_url();

				$data = array(
					'habilitado' => $this->input->post('habilitado'),
					'imagen' => $base.'assets/img/banner/'.$file_name
				);

				$this->BannerModel->crearBanner($data);

				$datos['exito'] = array('exito' => 'Producto creado con éxito');
				//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

				$this->load->view('/template/head');
				$this->load->view('Banner/AgregarBanner',$datos);
				$this->load->view('/template/footer');
		}
	}

	public function updateHabilitado()
	{
		$data = array(
			'codigo' => $this->input->post('codigo'),
			'estado' => $this->input->post('estado')
		);

		echo $this->BannerModel->updHabilitado($data);
	}

	public function updateNuevo()
	{
		$data = array(
			'codigo' => $this->input->post('codigo'),
			'estado' => $this->input->post('estado')
		);

		echo $this->ProductoModel->updNuevo($data);
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
