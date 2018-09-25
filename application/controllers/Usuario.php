<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller
{
	public function __construct()
  {
        parent::__construct();
		$this->load->model('CategoriaModel');
		$this->load->model('UsuarioModel');
		$this->load->model('ServicioModel');
		// carga los datos
		$this->load->model('DatosModel');
	}

	public function index(){
		//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

		$this->load->view('template/head');
		$this->load->view('Usuario/index');
		$this->load->view('template/footer');
	}

	public function registrarUsuario()
	{
		//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

		if( $this->input->post('pass1') ===  $this->input->post('pass2'))
		{
			$data = array(
				 'nombre'    => $this->input->post('nombre_con'),
				 'rut'       => $this->input->post('rut_con'),
				 'telefono'  => $this->input->post('telefono'),
				 'correo'    => $this->input->post('correo'),
				 'password'  => $this->input->post('pass1')
			 );

		 	$res = $this->UsuarioModel->crearUsuario($data);

			if(!$res){
				$data['error'] = '<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> Ya existe un correo asociado</div>';

				$this->load->view('/template/head');
				$this->load->view('login/login', $data);
				$this->load->view('/template/footer');
			}else {
				$data['error'] = '<div class="alert alert-success"><i class="fas fa-check-circle"></i> Usuario registrado</div>';

				$this->load->view('/template/head');
				$this->load->view('login/login', $data);
				$this->load->view('/template/footer');
			}
	 	}else {
				$data['error'] = '<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> Contraseñas no coinciden</div>';

			$this->load->view('/template/head');
			$this->load->view('login/login', $data);
			$this->load->view('/template/footer');
	 	}
	}

	function validaRut(){
		$res = $this->UsuarioModel->rutUsuario($this->input->post('rt'));

		echo $res;
	}
}
