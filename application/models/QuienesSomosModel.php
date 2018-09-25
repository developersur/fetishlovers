<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuienesSomosModel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function crearQuienesSomos($data)
	{
		//$this->db->insert('categoria', array('nombre' => $data['nombre'], 'descripcion' => $data['descripcion'], 'fecha_creacion' => $data['fecha_creacion']));
	}

	function obtenerQuienesSomos()
	{
		$query = $this->db->get('quienes_somos');

		if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return false;
		}
	}

	public function editServicio($data)
  {
    $res = $this->db->query("update quienes_somos set titulo='".$data['titulo']."', descripcion='".$data['descripcion']."'
                              where id = ".$data['id']);

    return $res;
  }

	function getQuienesSomo($id)
	{

	}
}
