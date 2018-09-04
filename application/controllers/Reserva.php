<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reserva extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('ReservaModel');
        $this->load->model('CategoriaModel');
        $this->load->model('ServicioModel');
        // carga los datos
		$this->load->model('DatosModel');
        date_default_timezone_set('America/Santiago');
        
	}


    public function Registrar()
    {
        // Recibe los datos
        $fecha       = $_POST['fecha_visita'];
        $hora        = $_POST['hora_visita'];
        $observacion = $_POST['observacion'];
        
        $fecha = date('Y-m-d', strtotime($fecha));

        // Status a actualizar
        $data = array(
            'fecha'        => $fecha,
            'hora'         => $hora,
            'observacion ' => $observacion
        );

        // Actualiza
        if($this->ReservaModel->Registrar($data)) {
            echo "ok";
        } else {
            echo "error";
        }
    }



    public function Eliminar()
    {
        // Recibe los datos
        $id_reserva = $_POST['id_reserva'];

        // Elimina
        if($this->ReservaModel->Eliminar($id_reserva)) {
            echo "ok";
        } else {
            echo "error";
        }
    }


    public function Listar()
    {
        //$data['categorias'] = $this->CategoriaModel->obtenerCategorias();
		$data['reservas']         = $this->ReservaModel->Listar();

        $this->load->view('/template/head');
		$this->load->view('Reserva/Listado', $data);
		$this->load->view('/template/footer');
    }

    
    public function HorasReservadas()
    {
        // Recibe los datos
        $fecha_seleccionada = $_POST['fecha_seleccionada'];
        $fecha_seleccionada = date('Y-m-d', strtotime($fecha_seleccionada));
        
        $reserva = $this->ReservaModel->ReservasHora($fecha_seleccionada);
        if(count($reserva>0)) {
            foreach ($reserva as $r) {
                $data[]=$r['hora'];
                //echo "".$r['hora']."";
            }
            if(isset($data) and count($data)>0) {
                echo json_encode($data, JSON_FORCE_OBJECT);
            } else {
                echo "0";
            }
        } else {
            echo "0";
        }
    }

    
}
