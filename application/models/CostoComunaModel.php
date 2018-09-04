<?php
class CostoComunaModel extends CI_Model {

    public function __construct()
    {                
        parent::__construct();
        $this->db = $this->load->database('default',true);
    }

    public function ListarComunasMostrar(){
        $result_set = $this->db->query("
        select * from 
            comuna 
        where
            mostrar = 'Si'
        ORDER BY 
            comuna DESC");
        return $result_set->result_array();
    }

    public function ListarRegionesMostrar(){
        $result_set = $this->db->query("
        select 
            region
        from 
            comuna 
        where
            mostrar = 'Si'
        GROUP BY 
            TRIM(region)");
        return $result_set->result_array();
    }

    public function ListarComunas(){
        $result_set = $this->db->query("
        select * from 
            comuna 
        ORDER BY 
            comuna DESC");
        return $result_set->result_array();
    }

    public function ListarRegiones(){
        $result_set = $this->db->query("
        select region from 
            comuna 
        GROUP BY 
            region");
        return $result_set->result_array();
    }

    
    public function ActualizarComuna($data,$id_comuna){
        if ($this->db->update('comuna', $data, array('id_comuna' => $id_comuna))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function Registrar($data){
    	if($this->db->insert('comuna',$data)){
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }


}