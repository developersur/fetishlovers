<?php
class ReservaModel extends CI_Model {

    public function __construct()
    {                
        parent::__construct();
        $this->db = $this->load->database('default',true);
    }

    public function Registrar($data){
    	if($this->db->insert('reserva',$data)){
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }

    public function Listar(){
        $result_set = $this->db->query("
        select * from reserva");
        return $result_set->result_array();
    }

    public function ReservasCompras(){
        $result_set = $this->db->query("
        select 
            id_compra, 
            nombre_con, 
            telefono_con, 
            fecha_visita, 
            hora_visita
        from
            compra
        where
            fecha_visita<>'' and 
            hora_visita<>'' 
        ORDER BY 
            fecha_visita ASC
        ");
        return $result_set->result_array();
    }
    
    public function Reservas(){
        $result_set = $this->db->query("
        select * from reserva");
        return $result_set->result_array();
    }

    public function ReservasHora($fecha){
        $result_set = $this->db->query("
        select * from reserva where fecha = '$fecha'");
        return $result_set->result_array();
    }

    public function Eliminar($id_reserva){
        if($this->db->query("delete from reserva where id_reserva='$id_reserva'")) return TRUE;
        else return FALSE;
    }

}