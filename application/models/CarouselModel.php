<?php
class CarouselModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default',true);
    }

    public function obtenerImg(){
      $query = $this->db->get('img_carousel');

  		if($query->num_rows() > 0)
  		{
  			return $query;
  		}else{
  			return false;
  		}
    }

    public function crearProducto($data)
    {
      $query = $this->db->get_where('producto', array('codigo' => $data['codigo']));

  		if($query->num_rows() > 0)
  		{
  			return false;
  		}else{
  			$this->db->insert('producto', array('codigo' => $data['codigo'],
                            'nombre' => $data['nombre'],
                            'descripcion' => $data['descripcion'],
                            'precio' => $data['precio'],
                            'descuento' => $data['descuento'],
                            'marca' => $data['marca'],
                            'cantidad' => $data['cantidad'],
                            'habilitado' => $data['habilitado'],
                            'nuevo' => $data['nuevo'],
                            'categoria' => $data['categoria'],
                            'imagen' => $data['imagen']));
  			return true;
  		}
    }

    public function updHabilitado($data)
    {
      $this->db->set('habilitado', $data['estado']);
      $this->db->where('id_producto', $data['codigo']);
      $res = $this->db->update('producto');

      return $res;
    }


    public function editProducto($data)
    {
      $res = $this->db->query("update producto set nombre='".$data['nombre']."', descripcion='".$data['descripcion']."', precio=".$data['precio']."
                                where id_producto = ".$data['id']);

      return $res;
    }
  }
