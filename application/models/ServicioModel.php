<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicioModel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function crearServicio($data)
	{
		$query = $this->db->get_where('servicio', array('codigo' => $data['codigo']));

		if($query->num_rows() > 0)
		{
			return false;
		}else{
			$this->db->insert('servicio', array('codigo' => $data['codigo'], 'titulo' => $data['titulo'] ,'descripcion' => $data['descripcion'], 'habilitado' => $data['habilitado']));
			return true;
		}
	}

	function obtenerServiciosActivos()
	{
		$query = $this->db->get_where('servicio', array('habilitado' => 'Si'));
		
		if($query->num_rows() > 0)
		{
			return $query;
		}else{
			return false;
		}
	}

	function obtenerServicios()
	{
		$query = $this->db->get('servicio');

		if($query->num_rows() > 0)
		{
			return $query;
		}else{
			return false;
		}
	}

	function getServicio($id)
	{
		//$query = $this->db->get('servicio', array('id' => $id));
		$query = $this->db->get_where('servicio', array('id' => $id));

		if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return false;
		}
	}

	function crearCategoria($data)
	{
		$query = $this->db->get_where('servicio', array('codigo' => $data['codigo']));

		if($query->num_rows() > 0)
		{
			return false;
		}else{
			$this->db->insert('servicio',
								array(
								'codigo' => $data['codigo'],
								'titulo' => $data['titulo'],
								'descripcion' => $data['descripcion'],
								'habilitado' => $data['habilitado']));
			return true;
		}
	}

	public function updHabilitado($data)
    {
      $this->db->set('habilitado', $data['estado']);
      $this->db->where('id', $data['codigo']);
      $res = $this->db->update('servicio'); 

      return $res;
	}

	public function editServicio($data)
    {
      $res = $this->db->query("update servicio set titulo='".$data['titulo']."', descripcion='".$data['descripcion']."'
                                where id = ".$data['id']);

      return $res;
    }
}
