<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// carga categorias
		$this->load->model('CategoriaModel');
		// Carga productos
		$this->load->model('ProductoModel');
		// carga los datos
		$this->load->model('DatosModel');
	}

	public function index()
	{
		$this->load->view('/template/head');
		$this->load->view('home');
		$this->load->view('/template/footer');
	}
}
