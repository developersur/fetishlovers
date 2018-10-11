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
		// carga carousel
		//$this->load->model('CarouselModel');
		$this->load->model('BannerModel');
	}

	public function index()
	{
		// Productos para la pagina principal
		$data['productos_destacados'] = $this->ProductoModel->ListarDestacados();
		$data['productos_ofertas'] = $this->ProductoModel->ListarOfertas();

		$this->load->view('/template/head');
		//$this->load->view('home');
		$this->load->view('/Productos/Principal',$data);
		$this->load->view('/template/footer');
	}
}
