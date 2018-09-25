<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compra extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('CompraModel');
        $this->load->model('ProductoModel');
        $this->load->model('CategoriaModel');
        $this->load->model('ServicioModel');
        // carga los datos
		$this->load->model('DatosModel');
        date_default_timezone_set('America/Santiago');
        
	}
    /*
	public function index()
	{
		$this->load->view('/template/head');
		$this->load->view('servicios/servicio');
		$this->load->view('/template/footer');
    }


    public function formProducto()
    {
        $data['categorias'] = $this->CategoriaModel->obtenerCategorias();

        $this->load->view('/template/head',$data);
				$this->load->view('Productos/AgregarProducto');
				$this->load->view('/template/footer',$data);
    }
    */

    public function Listar()
    {
        //$data['categorias'] = $this->CategoriaModel->obtenerCategorias();
				$data['compras']    = $this->CompraModel->ListarCompras();

        $this->load->view('/template/head');
				$this->load->view('Compras/Listado', $data);
				$this->load->view('/template/footer');
    }


    public function Detalle()
    {
        $id_compra = $_GET['id_compra'];

        $data['id_compra']      = $id_compra;
        //$data['categorias']     = $this->CategoriaModel->obtenerCategorias();
				$data['compra']         = $this->CompraModel->CompraDetalles($id_compra);
				$data['compra_detalle'] = $this->CompraModel->ProductosCompra($id_compra);
				$data['datospago']      = $this->CompraModel->DetallePagoWebPay($id_compra);

        $this->load->view('/template/head');
				$this->load->view('Compras/Detalle', $data);
				$this->load->view('/template/footer');
    }


    public function ActualizarStatusCompra()
    {
        // Recibe los datos
        $id_compra     = $_POST['id_compra'];
        $status_compra = $_POST['status_compra'];

        // Status a actualizar
        $data = array('status_compra' => $status_compra);

        // Actualiza
        if($this->CompraModel->ActualizarCompra($data,$id_compra)) {
            echo "ok";
        } else {
            echo "error";
        }
    }



    public function ActualizarStatusPago()
    {
        // Recibe los datos
        $id_compra     = $_POST['id_compra'];
        $status_compra = $_POST['status_compra'];

        // Status a actualizar
        $data = array('status_pago' => $status_compra);

        // Actualiza
        if($this->CompraModel->ActualizarCompra($data,$id_compra)) {
            echo "ok";
        } else {
            echo "error";
        }
    }
}
