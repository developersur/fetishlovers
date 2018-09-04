<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller
{
	public function __construct()
  {
        parent::__construct();
        $this->load->model('CategoriaModel');
        $this->load->model('ClienteModel');
        $this->load->model('CompraModel');
        $this->load->model('ServicioModel');
        // carga los datos
		$this->load->model('DatosModel');
		        date_default_timezone_set('America/Santiago');
                
	}

	public function index(){

        // --------- VERIFICA SESION DEL CLIENTE ------------ //
        if((!isset($_SESSION['login_cliente'])) or (isset($_SESSION['login_cliente']) and $_SESSION['login_cliente']==FALSE)) {
            header("Location: ".base_url()."index.php/Login");
        }
        // ------------- FIN VERIFICA SESION --------------- //

        // Datos de la sesion
        $id_cliente = 0;
        if(isset($_SESSION['id_cliente'])) $id_cliente = $_SESSION['id_cliente'];

        // Funciones
        //$data['categorias']   = $this->CategoriaModel->obtenerCategorias();
        $data['datoscliente'] = $this->ClienteModel->DatosCliente($id_cliente);
				$data['compras']      = $this->CompraModel->ListarTopComprasCliente($id_cliente);

        // Vistas
        $this->load->view('template/head');
				$this->load->view('Cliente/index',$data);
				$this->load->view('template/footer');
    }


	public function ListarCompras(){

        // --------- VERIFICA SESION DEL CLIENTE ------------ //
        if((!isset($_SESSION['login_cliente'])) or (isset($_SESSION['login_cliente']) and $_SESSION['login_cliente']==FALSE)) {
            header("Location: ".base_url()."index.php/Login");
        }
        // ------------- FIN VERIFICA SESION --------------- //


        // Datos de la sesion
        $id_cliente = 0;
        if(isset($_SESSION['id_cliente'])) $id_cliente = $_SESSION['id_cliente'];

        // Funciones
        //$data['categorias'] = $this->CategoriaModel->obtenerCategorias();
				$data['compras']    = $this->CompraModel->ListarComprasCliente($id_cliente);

        // Vistas
        $this->load->view('/template/head');
				$this->load->view('Cliente/ListadoCompras',$data);
				$this->load->view('/template/footer');
    }


    public function DetalleCompra()
    {

        // --------- VERIFICA SESION DEL CLIENTE ------------ //
        if((!isset($_SESSION['login_cliente'])) or (isset($_SESSION['login_cliente']) and $_SESSION['login_cliente']==FALSE)) {
            header("Location: ".base_url()."index.php/Login");
        }
        // ------------- FIN VERIFICA SESION --------------- //

        // Funciones
        $id_compra              = $_GET['id_compra'];
        $data['id_compra']      = $id_compra;
        $data['categorias']     = $this->CategoriaModel->obtenerCategorias();
		$data['compra']         = $this->CompraModel->CompraDetalles($id_compra);
		$data['compra_detalle'] = $this->CompraModel->ProductosCompra($id_compra);
		$data['datospago']      = $this->CompraModel->DetallePagoWebPay($id_compra);

        // Vistas
        $this->load->view('/template/head',$data);
		$this->load->view('Cliente/DetallesCompra', $data);
		$this->load->view('/template/footer',$data);
    }


}
?>
