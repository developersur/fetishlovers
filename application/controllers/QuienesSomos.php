<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuienesSomos extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('QuienesSomosModel');
		$this->load->model('CategoriaModel');
		$this->load->model('ServicioModel');
		// carga los datos
		$this->load->model('DatosModel');
	}

	public function obtenerQS()
	{
		$res = $this->QuienesSomosModel->obtenerQuienesSomos();

		foreach ($res as $key => $value) {
			$data[] = $value->titulo;
			$data[] = $value->descripcion;
		}

		echo json_encode($data);
	}

	public function viewQuienesSomos()
	{
			$data['quienesSomos'] = $this->QuienesSomosModel->obtenerQuienesSomos();

			$this->load->view('/template/head');
			$this->load->view('quienesSomos/VerQuienesSomos', $data);
			$this->load->view('/template/footer');
	}

	public function editarQuienesSomos()
	 {
			$data = array(
				'titulo' => $this->input->post('titulo'),
				'descripcion' => $this->input->post('descripcion'),
				'id' => $this->input->post('id')
			);

			$res = $this->QuienesSomosModel->editServicio($data);

			if($res){
				$previous = $_SERVER['HTTP_REFERER'];
				redirect($previous);
			}
	 }
}
