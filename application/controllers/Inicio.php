<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('/template/head');
		$this->load->view('home');
		$this->load->view('/template/footer');
	}
}
