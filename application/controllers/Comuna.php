<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comuna extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('CostoComunaModel');
        $this->load->model('CategoriaModel');
        $this->load->model('ServicioModel');
        // carga los datos
		$this->load->model('DatosModel');
        date_default_timezone_set('America/Santiago');
        
	}

    public function Listar()
    {
        //$data['categorias'] = $this->CategoriaModel->obtenerCategorias();
		$data['comunas']    = $this->CostoComunaModel->ListarComunas();

        $this->load->view('/template/head');
		$this->load->view('Comuna/Listado', $data);
		$this->load->view('/template/footer');
    }


    public function Actualizar()
    {
        // Recibe los datos
        $id_comuna = $_POST['id_comuna'];
        $mostrar   = $_POST['mostrar'];

        // Status a actualizar
        $data = array('mostrar' => $mostrar);

        // Actualiza
        if($this->CostoComunaModel->ActualizarComuna($data,$id_comuna)) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function ActualizarCosto()
    {
        // Recibe los datos
        $id_comuna = $_POST['id_comuna'];
        $costo     = $_POST['costo'];

        // Status a actualizar
        $data = array('costo' => $costo);

        // Actualiza
        if($this->CostoComunaModel->ActualizarComuna($data,$id_comuna)) {
            echo "ok";
        } else {
            echo "error";
        }
    }


    public function Registrar()
    {
        // Recibe los datos
        $region = $_POST['region'];
        $comuna = $_POST['comuna'];
        $costo  = $_POST['costo'];

        // Status a actualizar
        $data = array(
            'region' => $region,
            'comuna' => $comuna,
            'costo ' => $costo
        );

        // Actualiza
        if($this->CostoComunaModel->Registrar($data)) {
            echo "ok";
        } else {
            echo "error";
        }
    }


    public function HorasReservadas()
    {
        // Recibe los datos
        $fecha_seleccionada = $_POST['fecha_seleccionada'];
        $fecha_seleccionada = date('Y-m-d', strtotime($fecha_seleccionada));
        
        $reserva = $this->CostoComunaModel->ReservasHora($fecha_seleccionada);
        if(count($reserva>0)) {
            foreach ($reserva as $r) {
                echo "".$r['hora']."";
            }
        } else {
            echo "0";
        }
    }

    
}
