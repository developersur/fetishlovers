<?php
class BannerModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default',true);
    }

    public function obtenerImg(){
      $query = $this->db->query("select *
                                 from img_carousel
                                 where estado = 1");

  		if($query->num_rows() > 0)
  		{
  			return $query;
  		}else{
  			return false;
  		}
    }

    public function crearBanner($data)
    {
  			$this->db->insert('img_carousel', array(
                            'estado' => $data['habilitado'],
                            'url' => $data['imagen']));
  			return true;
    }

    function obtenerBanners()
  	{
  		$query = $this->db->query("select *
                                 from img_carousel
                                ");

  		if($query->num_rows() > 0)
  		{
  			return $query;
  		}else{
  			return false;
  		}
    }

    public function updHabilitado($data)
    {
      $this->db->set('estado', $data['estado']);
      $this->db->where('id', $data['codigo']);
      $res = $this->db->update('img_carousel');

      return $res;
    }
  }
