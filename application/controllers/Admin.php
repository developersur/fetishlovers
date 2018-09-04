<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('CategoriaModel');
		$this->load->model('ServicioModel');
		$this->load->model('LoginModel');
		// carga los datos
		$this->load->model('DatosModel');
	}

	public function index()
	{
		//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

		$this->load->view('/template/head');
		$this->load->view('admin/index');
		$this->load->view('/template/footer');
	}

	public function login()
	{
		//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

		$this->load->view('/template/head');
		$this->load->view('admin/login');
		$this->load->view('/template/footer');
	}

	public function accesoAdmin()
	{
    	$username = $this->input->post('username');
    	$password = $this->input->post('password');

    	if($this->LoginModel->login($username, $password))
    	{
	  		$this->load->view('template/head');
        $this->load->view('admin/index');
        $this->load->view('template/footer');
    	}
    	else
    	{
        $data['error'] = '<div id="sms_error" class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i>Error de usuario y/o contraseña</div>';

        $this->load->view('template/head');
        $this->load->view('admin/login', $data);
        $this->load->view('template/footer');
    	}
	}
}
