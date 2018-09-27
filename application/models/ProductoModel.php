<?php
class ProductoModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default',true);
    }

    public function ListarPrincipal(){
      $result_set = $this->db->query("
        select
          producto.id_producto,
          codigo,
          producto.nombre,
          producto.descripcion,
          precio,
          descuento,
          marca,
          cantidad,
          producto.habilitado,
          nuevo,
          url as imagen
        from producto
        left join imagenes on imagenes.id_producto = producto.codigo
        where producto.habilitado = 'Si'
        group by producto.id_producto
        ");
    	return $result_set -> result_array();
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
                            'categoria' => $data['categoria']));
  			return true;
  		}
    }

    public function crearImagen($data)
    {
      $query = $this->db->get_where('imagenes', array('url' => $data['url']));

  		if($query->num_rows() > 0)
  		{
  			return false;
  		}else{
  			$this->db->insert('imagenes', array('id_producto' => $data['id_producto'],
                           'url' => $data['url']));
  			return true;
  		}
    }

    function obtenerProductos()
  	{
  		$query = $this->db->get('producto');

  		if($query->num_rows() > 0)
  		{
  			return $query;
  		}else{
  			return false;
  		}
    }

    public function ProductosPorCategoria($id_categoria){
      $result_set = $this->db->query("select * from producto where habilitado='Si' and categoria=$id_categoria");
      return $result_set->result_array();
    }

    public function updHabilitado($data)
    {
      $this->db->set('habilitado', $data['estado']);
      $this->db->where('id_producto', $data['codigo']);
      $res = $this->db->update('producto');

      return $res;
    }

    public function updNuevo($data)
    {
      $this->db->set('nuevo', $data['estado']);
      $this->db->where('id_producto', $data['codigo']);
      $res = $this->db->update('producto');

      return $res;
    }

    public function buscaProductos($data)
    {
      $texto = $data['texto'];

      // ---------------------- //
      $data_origin = str_replace(" ", "%", $texto);

      // Separa las palabras en forma de array
      $porciones = explode("%", $texto);

      // Invierte las palabras
      for ($i=count($porciones)-1; $i >= 0; $i--) {

          $invertir[] = $porciones[$i];

      }

      $data_invertida = implode($invertir, "%");

      $res = $this->db->query("select * from producto where (nombre like '%".$data_origin."%' or nombre like '".$data_invertida."') and habilitado='Si'");

      if($res->num_rows() > 0)
      {
        return $res;
      }else{
        return false;
      }
    }

    public function editProducto($data)
    {
      $res = $this->db->query("update producto set nombre='".$data['nombre']."', descripcion='".$data['descripcion']."', precio=".$data['precio']."
                                where id_producto = ".$data['id']);

      return $res;
    }

    public function detalleProducto($codigo)
    {
        $result_set = $this->db->query("
          select
            producto.id_producto,
            codigo,
            producto.nombre,
            producto.descripcion,
            precio,
            descuento,
            marca,
            cantidad,
            producto.habilitado,
            nuevo,
            url as imagen
          from producto
          left join imagenes on imagenes.id_producto = producto.codigo
          where producto.habilitado = 'Si'
                and producto.codigo = $codigo");
      	return $result_set->result_array();
    }
  }
