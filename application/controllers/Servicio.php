<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('ServicioModel');
		$this->load->model('CategoriaModel');
		$this->load->model('ServicioModel');
		// carga los datos
		$this->load->model('DatosModel');
	}

	public function index()
	{
		$data['servicios'] = $this->ServicioModel->obtenerServicios();
		//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

		$this->load->view('/template/head');
		$this->load->view('servicios/servicio', $data);
		$this->load->view('/template/footer');
	}

	public function getServicio()
	{
		$id = $this->input->post('id');
		//echo $id;
		$res = $this->ServicioModel->getServicio($id);

		foreach ($res as $key => $value) {
			$data[] = $value->titulo;
			$data[] = $value->descripcion;
		}

		echo json_encode($data);
	}

	public function viewServicios()
	{
			$data['servicios'] = $this->ServicioModel->obtenerServicios();

			$this->load->view('/template/head');
			$this->load->view('servicios/VerServicios', $data);
			$this->load->view('/template/footer');
	}

	public function addServicio()
	{
		$this->load->view('/template/head');
		$this->load->view('servicios/AgregarServicio');
		$this->load->view('/template/footer');
	}

	public function modServicio()
	{
			$data['servicios'] = $this->ServicioModel->obtenerServicios();

			$this->load->view('/template/head');
			$this->load->view('servicios/ModificarServicio', $data);
			$this->load->view('/template/footer');
	}


	public function agregarServicio()
	{
		$data = array(
			'codigo' => $this->input->post('codigo'),
			'titulo' => $this->input->post('titulo'),
			'descripcion' => $this->input->post('descripcion'),
			'habilitado' => $this->input->post('habilitado'),
		);

		$res = $this->ServicioModel->crearServicio($data);

		if($res){
			$mensaje = array('exito' => 'Producto creado con éxito');
		}else{
			$mensaje = array('error' => 'Ya existe un servicio con el mismo código');
		}

		$this->load->view('/template/head');
		$this->load->view('servicios/AgregarServicio', $mensaje);
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
		
		echo $this->ServicioModel->updHabilitado($data);
	}

	public function editarServicio()
	 {
			$data = array(
				'titulo' => $this->input->post('titulo'),
				'descripcion' => $this->input->post('descripcion'),
				'id' => $this->input->post('id')
			);
			
			$res = $this->ServicioModel->editServicio($data);

			if($res){
				$previous = $_SERVER['HTTP_REFERER'];
				redirect($previous);
			}

			//$this->load->view('/template/head');
			//$this->load->view('Productos/Busqueda',$datos);
			//$this->load->view('/template/footer');
	 }
}
