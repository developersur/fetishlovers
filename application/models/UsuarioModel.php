<?php
class UsuarioModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default',true);
    }

    public function crearUsuario($data)
    {
      $query = $this->db->get_where('cliente', array('correo' => $data['correo']));

  		if($query->num_rows() > 0)
  		{
  			return false;
  		}else{
  			$this->db->insert('cliente',
                            array('rut_con' => $data['rut'],
                            'nombre_con' => $data['nombre'],
                            'correo' => $data['correo'],
                            'telefono' => $data['telefono'],
                            'clave' => password_hash($data['password'],PASSWORD_DEFAULT)));
  			return true;
  		}
    }

    public function login($correo, $password)
    {
        $query = $this->db->get_where('cliente', array('correo' => $correo));
        if($query->num_rows() == 1)
        {
            $row=$query->row();
            if(password_verify($password, $row->clave))
            {
                $this->session->logged_in_user = TRUE;
                $this->session->nombre_user    = $row->nombre_con;
                
                // Sesiones Cliente Alexis
                $_SESSION['id_cliente']     = $row->id_cliente;
                $_SESSION['nombre_cliente'] = $row->nombre_con;
                $_SESSION['login_cliente']  = TRUE;
                // ---------------------- //

                return true;
            }
        }
        $this->session->unset_userdata('user_data');
        return false;
    }

    function rutUsuario($rut){
        $query = $this->db->get_where('cliente', array('rut_con' => $rut));
        if($query->num_rows() == 1)
        {
            return 'V';
        }else{
            return 'F';
        }
    }
}
