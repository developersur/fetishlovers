<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
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

	public function index()
	{
		//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

		$this->load->view('template/head');
		$this->load->view('login/login');
		$this->load->view('template/footer');
	}

	function login()
	{
		// Si ya inicio sesion lo redirecciono a su panel
		if(isset($_SESSION['login_cliente']) and ($_SESSION['login_cliente']==TRUE)) {
			header("Location: ".base_url()."index.php/Cliente/");
		}

		//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if($this->UsuarioModel->login($username, $password))
		{
			header("Location: ".base_url()."index.php/Cliente/");
		}else{
			$data['error'] = '<div id="sms_error" class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i>Error de usuario y/o contraseña</div>';

			$this->load->view('template/head');
			$this->load->view('login/login', $data);
			$this->load->view('template/footer');
		}
	}

	function salir(){
		$this->session->sess_destroy();
		redirect('Login', 'refresh');
	}
}
