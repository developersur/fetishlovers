<?php
class CompraModel extends CI_Model {

    public function __construct()
    {                
        parent::__construct();
        $this->db = $this->load->database('default',true);
    }

    public function RegistrarCompra($data){
        $this->db->insert('compra', $data);
        return $this->db->insert_id();
    }

    
    public function RegistrarDetalles($data){
    	if($this->db->insert('compra_detalle',$data)){
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }

    public function ListarCompras(){
        $result_set = $this->db->query("
        select * 
        from 
            compra 
        ORDER BY 
            fecha_creacion DESC");
        return $result_set->result_array();
    }

    public function UltimoIDCompra(){
		$result_set = $this->db->query("
			select max(id_compra) as id_compra from compra");
        return $result_set->result_array();
    }

    public function ListarTopComprasCliente($id_cliente){
        $result_set = $this->db->query("
        select * 
        from 
            compra 
        where 
            id_cliente = $id_cliente
        ORDER BY 
            fecha_creacion DESC
        LIMIT 5");
        return $result_set->result_array();
    }

    public function VerificarRutCorreo($rut_con,$correo_con){
        $result_set = $this->db->query("
            select 
                id_cliente 
            from 
                cliente 
            where 
                rut_con = '$rut_con'
                or
                correo = '$correo_con'
            LIMIT 1");
        return $result_set->result_array();
    }

    public function RegistrarCliente($data){
		$this->db->insert('cliente', $data);
         return $this->db->insert_id();
    }

    public function ListarComprasCliente($id_cliente){
        $result_set = $this->db->query("
        select * 
        from 
            compra 
        where 
            id_cliente = $id_cliente
        ORDER BY 
            fecha_creacion DESC");
        return $result_set->result_array();
    }

    
    public function CompraDetalles($data){
        $result_set = $this->db->query("select * from compra where id_compra=$data");
        return $result_set->result_array();
    }

    public function ProductosCompra($data){
        $result_set = $this->db->query("select * from compra_detalle where id_compra=$data");
        return $result_set->result_array();
    }

    public function DetallePagoWebPay($id_compra){
        $result_set = $this->db->query("select * from pago_webpay where id_compra=$id_compra");
        return $result_set->result_array();
    }

    public function ActualizarCompra($data,$id_compra){
        if ($this->db->update('compra', $data, array('id_compra' => $id_compra))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}