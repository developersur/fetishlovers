<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriaModel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		//$this->load->database();
	}

	function obtenerCategoriasActivas()
	{
		$query = $this->db->query('select * from categoria where habilitado = "Si"');

		if($query->num_rows() > 0)
		{
			return $query;
		}else{
			return false;
		}
	}

	function obtenerCategorias()
	{
		$query = $this->db->get('categoria');

		if($query->num_rows() > 0)
		{
			return $query;
		}else{
			return false;
		}
	}

	function crearCategoria($data)
	{
		$query = $this->db->get_where('categoria', array('nombre' => $data['nombre']));

		if($query->num_rows() > 0)
		{
			return false;
		}else{
			$this->db->insert('categoria',
													array(
													'nombre' => $data['nombre'],
													'descripcion' => $data['descripcion'],
													'habilitado' => $data['habilitado']));
			return true;
		}
	}

	public function updHabilitado($data)
    {
      $this->db->set('habilitado', $data['estado']);
      $this->db->where('id', $data['codigo']);
      $res = $this->db->update('categoria'); 

      return $res;
	}
	
	public function editCategoria($data)
    {
      $res = $this->db->query("update categoria set nombre='".$data['nombre']."', descripcion='".$data['descripcion']."'
                                where id = ".$data['id']);

      return $res;
    }
}
