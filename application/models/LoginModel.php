<?php
class LoginModel extends CI_model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function login($correo, $password)
    {
        $query = $this->db->get_where('usuario', array('correo' => $correo));

        if($query->num_rows() == 1)
        {
            $row=$query->row();
            if(password_verify($password, $row->password))
            {
                $this->session->logged_in = TRUE;
                $this->session->nombre_user = $row->nombre . ' ' . $row->apellido;
                return true;
            }
        }
        $this->session->unset_userdata('user_data');
        return false;
    }
}
