<?php
class ClienteModel extends CI_model
{
    public function __construct()
    {
        $this->load->database();
    }
    
    public function DatosCliente($id_cliente){
        $result_set = $this->db->query("
        select * 
        from 
            cliente 
        where 
            id_cliente = $id_cliente
       ");
        return $result_set->result_array();
    }
}
