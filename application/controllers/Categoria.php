<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('CategoriaModel');
		$this->load->model('ServicioModel');
		// carga los datos
		$this->load->model('DatosModel');
	}

	public function viewCategorias()
	{
			$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

			$this->load->view('/template/head');
			$this->load->view('categorias/VerCategorias', $data);
			$this->load->view('/template/footer');
	}

	public function addCategoria()
	{
		//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

		$this->load->view('/template/head');
		$this->load->view('categorias/AgregarCategoria');
		$this->load->view('/template/footer');
	}

	public function modCategoria()
	{
			$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

			$this->load->view('/template/head');
			$this->load->view('categorias/ModificarCategoria', $data);
			$this->load->view('/template/footer');
	}

	public function agregarCategoria()
	{
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'descripcion' => $this->input->post('descripcion'),
			'habilitado' => $this->input->post('habilitado'),
		);

		$res = $this->CategoriaModel->crearCategoria($data);

		$exito = array('exito' => 'Categoría creada con éxito');

		$this->load->view('/template/head');
		$this->load->view('categorias/AgregarCategoria', $exito);
		$this->load->view('/template/footer');

				//$previous = $_SERVER['HTTP_REFERER'];
				//redirect($previous);
	}

	public function updateHabilitado()
	{
		$data = array(
			'codigo' => $this->input->post('codigo'),
			'estado' => $this->input->post('estado')
		);
		
		echo $this->CategoriaModel->updHabilitado($data);
	}

	public function editarCategoria()
	 {
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'descripcion' => $this->input->post('descripcion'),
				'id' => $this->input->post('id')
			);
			
			$res = $this->CategoriaModel->editCategoria($data);

			if($res){
				$previous = $_SERVER['HTTP_REFERER'];
				redirect($previous);
			}

			//$this->load->view('/template/head');
			//$this->load->view('Productos/Busqueda',$datos);
			//$this->load->view('/template/footer');
	 }
}
