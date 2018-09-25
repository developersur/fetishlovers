<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carro extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('CategoriaModel');
		$this->load->model('ServicioModel');
		// carga los datos
		$this->load->model('DatosModel');
		date_default_timezone_set('America/Santiago');

	}

	// Muestra el contenido del carrito
	public function index()
	{
		$this->load->view('/template/head');
		$this->load->view('Carro/index');
		$this->load->view('/template/footer');
	}



	// Validar Paso 1
	function Validar_Paso_1(){

		// Validacion
		$this->form_validation->set_error_delimiters('<i class="fas fa-exclamation-triangle"></i> ', '<br>');
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('rut_con', 'RUT', 'required|min_length[8]|max_length[13]');
		$this->form_validation->set_rules('nombre_con', 'Nombre contacto', 'required|min_length[4]');
		$this->form_validation->set_rules('telefono_con', 'Teléfono/Celular contacto', 'required|min_length[9]|max_length[20]|numeric');
		$this->form_validation->set_rules('correo_con', 'Correo contacto', 'required|valid_email');

		if ($this->input->post('tipo')=="Factura") {
			$this->form_validation->set_rules('rut_fac', 'RUT facturación', 'required|min_length[8]|max_length[13]');
			$this->form_validation->set_rules('razon_fac', 'Razón Social facturación', 'required');
			$this->form_validation->set_rules('giro_fac', 'Giro facturación', 'required');
			$this->form_validation->set_rules('telefono_fac', 'Teléfono facturación', 'required');
			$this->form_validation->set_rules('correo_fac', 'Correo facturación', 'required');
			$this->form_validation->set_rules('region_fac', 'Región facturación', 'required');
			$this->form_validation->set_rules('comuna_fac', 'Comuna facturación', 'required');
			$this->form_validation->set_rules('sector_fac', 'Sector facturación', 'required');
			$this->form_validation->set_rules('calle_fac', 'Calle facturación', 'required');
			$this->form_validation->set_rules('nro_calle_fac', 'Nro calle facturación', 'required');
		}

		// Si no se introducen los datos conrrectamente
	    if ($this->form_validation->run() == FALSE){
			echo '<div class="alert alert-danger">';
			echo validation_errors();
			echo '</div>';

	    // Si estan correctos
	    } else {
	    	echo "1";
	    }
	}




	// Validar Paso 2
	function Validar_Paso_2(){

		// Validacion
		$this->form_validation->set_error_delimiters('<i class="fas fa-exclamation-triangle"></i> ', '<br>');

		$this->form_validation->set_rules('region_dir', 'Región', 'required');
		$this->form_validation->set_rules('comuna_dir', 'Comuna', 'required');
		$this->form_validation->set_rules('sector_dir', 'Sector', 'required');
		$this->form_validation->set_rules('calle_dir', 'Calle', 'required');
		$this->form_validation->set_rules('nro_calle_dir', 'Nro calle', 'required');
		if ($this->input->post('fecha_visita')!="") {
			$this->form_validation->set_rules('hora_visita', 'Hora de visita', 'required', array("required" => "Al seleccionar una fecha debe indicar la hora"));
		}

		// Si no se introducen los datos conrrectamente
	    if ($this->form_validation->run() == FALSE){
			echo '<div class="alert alert-danger">';
			echo validation_errors();
			echo '</div>';

	    // Si estan correctos
	    } else {
	    	echo "1";
	    }
	}

	// Paso 1 para la compra
	public function Paso1()
	{
		// Si no hay productos en el carrito lo devuelve
		$productosC = $this->cart->contents();
		if(count($productosC)<=0) {
			header("Location: ".base_url()."index.php/Carro/");
		}
		if(isset($_SESSION['datos_sesion'])) {
			//echo var_dump($_SESSION['datos_sesion']);
		}

		//unset($_SESSION['datos_sesion']);

		// Paso 1 - Inicializa variables
		$tipo          = "";
		$nombre_con    = "";
		$rut_con       = "";
		$correo_con    = "";
		$telefono_con  = "";
		$rut_fac       = "";
		$razon_fac     = "";
		$giro_fac      = "";
		$telefono_fac  = "";
		$correo_fac    = "";
		$region_fac    = "";
		$comuna_fac    = "";
		$sector_fac    = "";
		$calle_fac     = "";
		$nro_calle_fac = "";

		// Si se reciben datos por POST da valor a las variables
		if(isset($_SESSION['datos_sesion'])) {
			$tipo          = $_SESSION['datos_sesion']['tipo'];
            $nombre_con    = $_SESSION['datos_sesion']['nombre_con'];
            $rut_con       = $_SESSION['datos_sesion']['rut_con'];
            $correo_con    = $_SESSION['datos_sesion']['correo_con'];
            $telefono_con  = $_SESSION['datos_sesion']['telefono_con'];
            $rut_fac       = $_SESSION['datos_sesion']['rut_fac'];
            $razon_fac     = $_SESSION['datos_sesion']['razon_fac'];
            $giro_fac      = $_SESSION['datos_sesion']['giro_fac'];
            $telefono_fac  = $_SESSION['datos_sesion']['telefono_fac'];
            $correo_fac    = $_SESSION['datos_sesion']['correo_fac'];
            $region_fac    = $_SESSION['datos_sesion']['region_fac'];
            $comuna_fac    = $_SESSION['datos_sesion']['comuna_fac'];
            $sector_fac    = $_SESSION['datos_sesion']['sector_fac'];
            $calle_fac     = $_SESSION['datos_sesion']['calle_fac'];
            $nro_calle_fac = $_SESSION['datos_sesion']['nro_calle_fac'];
		}
		// Fin Paso 1 - Inicializa variables

		// Paso 2 - Inicializa variables
		$region_dir       ="";
		$comuna_dir       ="";
		$sector_dir       ="";
		$calle_dir        ="";
		$nro_calle_dir    ="";
		$indicaciones_dir ="";
		$fecha_visita     ="";
		$hora_visita      ="";
		$metodo_pago      ="";
		$costo_visita     = 0;
		$descuento        = 0;

		// Si existe la sesion da asiga valor a las variables
		if(isset($_SESSION['datos_sesion'])) {
			$region_dir       = $_SESSION['datos_sesion']['region_dir'];
			$comuna_dir       = $_SESSION['datos_sesion']['comuna_dir'];
			$sector_dir       = $_SESSION['datos_sesion']['sector_dir'];
			$calle_dir        = $_SESSION['datos_sesion']['calle_dir'];
			$nro_calle_dir    = $_SESSION['datos_sesion']['nro_calle_dir'];
			$indicaciones_dir = $_SESSION['datos_sesion']['indicaciones_dir'];
			$fecha_visita     = $_SESSION['datos_sesion']['fecha_visita'];
			$hora_visita      = $_SESSION['datos_sesion']['hora_visita'];
			$metodo_pago      = $_SESSION['datos_sesion']['metodo_pago'];
			$costo_visita     = $_SESSION['datos_sesion']['costo_visita'];
			$descuento        = $_SESSION['datos_sesion']['descuento'];
		}
		// Fin Paso 2 - Inicializa variables


		// Datos para la sesion
		$data_sesion = array(
			// Paso 1
			'tipo'             => $tipo,
			'nombre_con'       => $nombre_con,
			'rut_con'          => $rut_con,
			'correo_con'       => $correo_con,
			'telefono_con'     => $telefono_con,
			'rut_fac'          => $rut_fac,
			'razon_fac'        => $razon_fac,
			'giro_fac'         => $giro_fac,
			'telefono_fac'     => $telefono_fac,
			'correo_fac'       => $correo_fac,
			'region_fac'       => $region_fac,
			'comuna_fac'       => $comuna_fac,
			'sector_fac'       => $sector_fac,
			'calle_fac'        => $calle_fac,
			'nro_calle_fac'    => $nro_calle_fac,

			// Paso 2
			'region_dir'       => $region_dir,
			'comuna_dir'       => $comuna_dir,
			'sector_dir'       => $sector_dir,
			'calle_dir'        => $calle_dir,
			'nro_calle_dir'    => $nro_calle_dir,
			'indicaciones_dir' => $indicaciones_dir,
			'fecha_visita'     => $fecha_visita,
			'hora_visita'      => $hora_visita,
			'metodo_pago'      => $metodo_pago,
			'costo_visita'     => $costo_visita,
			'descuento'        => $descuento
		);

		$_SESSION['datos_sesion'] = $data_sesion;

		if(isset($_SESSION['datos_sesion'])) {
			//echo var_dump($_SESSION['datos_sesion']);
		}

		$this->load->view('/template/head');
		$this->load->view('Carro/Paso1');
		$this->load->view('/template/footer');
	}


	// Paso 2 para la compra
	public function Paso2()
	{
		// Si no hay productos en el carrito lo devuelve
		$productosC = $this->cart->contents();
		if(count($productosC)<=0) {
			header("Location: ".base_url()."index.php/Carro/");
		}

		// Carga Modelo
		$this->load->model('ReservaModel');

		// Paso 1 - Inicializa variables
		$tipo          = "";
		$nombre_con    = "";
		$rut_con       = "";
		$correo_con    = "";
		$telefono_con  = "";
		$rut_fac       = "";
		$razon_fac     = "";
		$giro_fac      = "";
		$telefono_fac  = "";
		$correo_fac    = "";
		$region_fac    = "";
		$comuna_fac    = "";
		$sector_fac    = "";
		$calle_fac     = "";
		$nro_calle_fac = "";

		// Si se reciben datos por POST da valor a las variables
		if(isset($_POST['tipo'])) {
			$tipo          = $_POST['tipo'];
			$nombre_con    = $_POST['nombre_con'];
			$rut_con       = $_POST['rut_con'];
			$correo_con    = $_POST['correo_con'];
			$telefono_con  = $_POST['telefono_con'];
			$rut_fac       = $_POST['rut_fac'];
			$razon_fac     = $_POST['razon_fac'];
			$giro_fac      = $_POST['giro_fac'];
			$telefono_fac  = $_POST['telefono_fac'];
			$correo_fac    = $_POST['correo_fac'];
			$region_fac    = $_POST['region_fac'];
			$comuna_fac    = $_POST['comuna_fac'];
			$sector_fac    = $_POST['sector_fac'];
			$calle_fac     = $_POST['calle_fac'];
			$nro_calle_fac = $_POST['nro_calle_fac'];
		}

		// Si no se recibe por POST pero existe la SESION
		if((!isset($_POST['tipo'])) and (isset($_SESSION['datos_sesion']))) {
			$tipo          = $_SESSION['datos_sesion']['tipo'];
			$nombre_con    = $_SESSION['datos_sesion']['nombre_con'];
			$rut_con       = $_SESSION['datos_sesion']['rut_con'];
			$correo_con    = $_SESSION['datos_sesion']['correo_con'];
			$telefono_con  = $_SESSION['datos_sesion']['telefono_con'];
			$rut_fac       = $_SESSION['datos_sesion']['rut_fac'];
			$razon_fac     = $_SESSION['datos_sesion']['razon_fac'];
			$giro_fac      = $_SESSION['datos_sesion']['giro_fac'];
			$telefono_fac  = $_SESSION['datos_sesion']['telefono_fac'];
			$correo_fac    = $_SESSION['datos_sesion']['correo_fac'];
			$region_fac    = $_SESSION['datos_sesion']['region_fac'];
			$comuna_fac    = $_SESSION['datos_sesion']['comuna_fac'];
			$sector_fac    = $_SESSION['datos_sesion']['sector_fac'];
			$calle_fac     = $_SESSION['datos_sesion']['calle_fac'];
			$nro_calle_fac = $_SESSION['datos_sesion']['nro_calle_fac'];
		}
		// Fin Paso 1 - Inicializa variables

		// Paso 2 - Inicializa variables
		$region_dir       ="";
		$comuna_dir       ="";
		$sector_dir       ="";
		$calle_dir        ="";
		$nro_calle_dir    ="";
		$indicaciones_dir ="";
		$fecha_visita     ="";
		$hora_visita      ="";
		$metodo_pago      ="";
		$costo_visita     = 0;
		$descuento        = 0;

		// Si existe la sesion da asiga valor a las variables
		if(isset($_SESSION['datos_sesion'])) {
			$region_dir       = $_SESSION['datos_sesion']['region_dir'];
			$comuna_dir       = $_SESSION['datos_sesion']['comuna_dir'];
			$sector_dir       = $_SESSION['datos_sesion']['sector_dir'];
			$calle_dir        = $_SESSION['datos_sesion']['calle_dir'];
			$nro_calle_dir    = $_SESSION['datos_sesion']['nro_calle_dir'];
			$indicaciones_dir = $_SESSION['datos_sesion']['indicaciones_dir'];
			$fecha_visita     = $_SESSION['datos_sesion']['fecha_visita'];
			$hora_visita      = $_SESSION['datos_sesion']['hora_visita'];
			$metodo_pago      = $_SESSION['datos_sesion']['metodo_pago'];
			$costo_visita     = $_SESSION['datos_sesion']['costo_visita'];
			$descuento        = $_SESSION['datos_sesion']['descuento'];
		}
		// Fin Paso 2 - Inicializa variables


		// Datos para la sesion
		$data_sesion = array(
			// Paso 1
			'tipo'             => $tipo,
			'nombre_con'       => $nombre_con,
			'rut_con'          => $rut_con,
			'correo_con'       => $correo_con,
			'telefono_con'     => $telefono_con,
			'rut_fac'          => $rut_fac,
			'razon_fac'        => $razon_fac,
			'giro_fac'         => $giro_fac,
			'telefono_fac'     => $telefono_fac,
			'correo_fac'       => $correo_fac,
			'region_fac'       => $region_fac,
			'comuna_fac'       => $comuna_fac,
			'sector_fac'       => $sector_fac,
			'calle_fac'        => $calle_fac,
			'nro_calle_fac'    => $nro_calle_fac,

			// Paso 2
			'region_dir'       => $region_dir,
			'comuna_dir'       => $comuna_dir,
			'sector_dir'       => $sector_dir,
			'calle_dir'        => $calle_dir,
			'nro_calle_dir'    => $nro_calle_dir,
			'indicaciones_dir' => $indicaciones_dir,
			'fecha_visita'     => $fecha_visita,
			'hora_visita'      => $hora_visita,
			'metodo_pago'      => $metodo_pago,
			'costo_visita'     => $costo_visita,
			'descuento'        => $descuento
		);

		$_SESSION['datos_sesion'] = $data_sesion;
		//echo var_dump($_SESSION['datos_sesion']);

		$data1['reservas'] = $this->ReservaModel->Reservas();
		
		$this->load->view('/template/head');
		$this->load->view('Carro/Paso2',$data1);
		$this->load->view('/template/footer');
	}



	// Paso 3 para la compra - Confirmacion
	public function Paso3()
	{
		//echo var_dump($_POST);

		// Si no hay productos en el carrito lo devuelve
		$productosC = $this->cart->contents();
		if(count($productosC)<=0) {
			header("Location: ".base_url()."index.php/Carro/");
		}

		// Si no existe POST del paso 2, lo devuelve al paso 1
		if(!isset($_POST['tipo'])) {
			header("Location: ".base_url()."index.php/Carro/Paso1");
		}

		// Si no existe la sesion con los datos de la compra, lo devuelve al paso 1
		if(!isset($_SESSION['datos_sesion'])) {
			header("Location: ".base_url()."index.php/Carro/Paso1");
		}

		// Carga Modelo
		$this->load->model('CompraModel');

		// Paso 1 - Asigna valor
		$tipo          = $_POST['tipo'];
		$nombre_con    = $_POST['nombre_con'];
		$rut_con       = $_POST['rut_con'];
		$correo_con    = $_POST['correo_con'];
		$telefono_con  = $_POST['telefono_con'];
		$rut_fac       = $_POST['rut_fac'];
		$razon_fac     = $_POST['razon_fac'];
		$giro_fac      = $_POST['giro_fac'];
		$telefono_fac  = $_POST['telefono_fac'];
		$correo_fac    = $_POST['correo_fac'];
		$region_fac    = $_POST['region_fac'];
		$comuna_fac    = $_POST['comuna_fac'];
		$sector_fac    = $_POST['sector_fac'];
		$calle_fac     = $_POST['calle_fac'];
		$nro_calle_fac = $_POST['nro_calle_fac'];
		// Fin Paso 1 -  Asigna valor

		// Paso 2 - Asigna valor
		$region_dir       = $_POST['region_dir'];
		$comuna_dir       = $_POST['comuna_dir'];
		$sector_dir       = $_POST['sector_dir'];
		$calle_dir        = $_POST['calle_dir'];
		$nro_calle_dir    = $_POST['nro_calle_dir'];
		$indicaciones_dir = $_POST['indicaciones_dir'];
		$fecha_visita     = $_POST['fecha_visita'];
		$hora_visita      = $_POST['hora_visita'];
		$metodo_pago      = $_POST['metodo_pago'];
		$costo_visita     = $_POST['costo_visita'];
		// Fin Paso 2 - Asigna valor Inicializa variables

		// Calcula el descuento si el pago es por transferencia
		$descuento  = 0;
		if($metodo_pago=="TRANSFERENCIA") {
			$porcen_des = $this->config->item('porcentaje_descuento_transferencia');
			$descuento  = round((($this->cart->total()+$costo_visita)*$porcen_des)/100);
		}
		// El monto final la suma del costo de visita a la comuna mas el descuento por transferencia
        $monto_final = ($this->cart->total()+$costo_visita)-$descuento;

		// Datos para la sesion
		$data['data_post'] = array(
			// Paso 1
			'tipo'             => $tipo,
			'nombre_con'       => $nombre_con,
			'rut_con'          => $rut_con,
			'correo_con'       => $correo_con,
			'telefono_con'     => $telefono_con,
			'rut_fac'          => $rut_fac,
			'razon_fac'        => $razon_fac,
			'giro_fac'         => $giro_fac,
			'telefono_fac'     => $telefono_fac,
			'correo_fac'       => $correo_fac,
			'region_fac'       => $region_fac,
			'comuna_fac'       => $comuna_fac,
			'sector_fac'       => $sector_fac,
			'calle_fac'        => $calle_fac,
			'nro_calle_fac'    => $nro_calle_fac,

			// Paso 2
			'region_dir'       => $region_dir,
			'comuna_dir'       => $comuna_dir,
			'sector_dir'       => $sector_dir,
			'calle_dir'        => $calle_dir,
			'nro_calle_dir'    => $nro_calle_dir,
			'indicaciones_dir' => $indicaciones_dir,
			'fecha_visita'     => $fecha_visita,
			'hora_visita'      => $hora_visita,
			'metodo_pago'      => $metodo_pago,
			'costo_visita'     => $costo_visita,
			'descuento'        => $descuento
		);

		// Incluye los datos en la sesion por si se devuelve a un paso anterior
		$_SESSION['datos_sesion'] = $data['data_post'];

		// Datos Compra
		$_SESSION['datos']   = $data['data_post'];

		// Datos Productos
		$_SESSION['carrito'] = $this->cart->contents();

		// Datos Productos
		$_SESSION['total']   = $monto_final;

		// ------- WEBPAY ------- //
		require_once('assets/webpay/libwebpay/webpay.php');
		require_once('assets/webpay/certificates/cert-normal.php');
		require_once('assets/webpay/iniciar.php');



		// Ultimo ID Compra
		$NroCompra    = 0;
		$UltimaCompra = $this->CompraModel->UltimoIDCompra();
		if(count($UltimaCompra)>0){
			foreach ($UltimaCompra as $UCompra) {
				$NroCompra = $UCompra['id_compra']+1;
			}
		}

		// -- Inicio Datos para la transaccion --//
		$base_url       = base_url();
		$total          = round($this->cart->total());    // Monto de la transacción
		$NroCompra      = $NroCompra; // Orden de compra de la tienda
		$SesionID       = uniqid();   //ID para la sesion
		$urlProcesar    = $base_url."index.php/Carro/ProcesarPago/"; // URL de retorno
		$urlComprobante = $base_url."index.php/Carro/Finalizado/";   // URL Final

		// -- Inicio de la Transaccion para obtener Token -- //
		$data['WebPayResultado'] = $webpay->getNormalTransaction()->initTransaction($total, $NroCompra, $SesionID, $urlProcesar, $urlComprobante);

		$this->load->view('/template/head');
		$this->load->view('Carro/Paso3', $data);
		$this->load->view('/template/footer');
	}



	// Procesa el Pago ya sea por Webpay o Transferencia
	public function ProcesarPago()
	{
		date_default_timezone_set('America/Santiago');

		// Si no existe la sesion con los datos de la compra
		if(!isset($_SESSION['datos'])) {
			header("Location: ".base_url()."index.php/Carro/Paso1");
			exit;
		}
		if(isset($_SESSION['datos']) and $_SESSION['datos']==null) {
			header("Location: ".base_url()."index.php/Carro/Paso1");
			exit;
		}
		// Si no existe la sesion con los datos de la compra
		if(!isset($_SESSION['total'])) {
			header("Location: ".base_url()."index.php/Carro/Paso1");
			exit;
		}
		if(isset($_SESSION['total']) and $_SESSION['total']==null) {
			header("Location: ".base_url()."index.php/Carro/Paso1");
			exit;
		}
		// Si no existe la sesion con los datos de los productos
		if(!isset($_SESSION['carrito'])) {
			header("Location: ".base_url()."index.php/Carro/Paso1");
			exit;
		}
		if(isset($_SESSION['carrito']) and $_SESSION['carrito']==null) {
			header("Location: ".base_url()."index.php/Carro/Paso1");
			exit;
		}

		// Carga Modelo
		$this->load->model('WebpayModel');
		$this->load->model('CompraModel');
		$this->load->model('ReservaModel');
		$this->load->model('CategoriaModel');

		// categorias para la pagina principal
		$datac['categorias'] = $this->CategoriaModel->obtenerCategorias();

		$data['mensaje'] = "";
		$data['error']   = "";
		$todo_bien       = FALSE;

		// Si se recibe token o transferencia la compra va bien
		if(((isset($_POST["token_ws"]) and $_POST["token_ws"]!="")) or ((isset($_POST["transferencia"])) and ($_POST['transferencia']))) {


			// Recibe los datos de las sesiones de la compra
			if($_SESSION['datos']!==null and $_SESSION['carrito']!==null and $_SESSION['total']!==null) {
				$dcompra   = $_SESSION['datos'];
				$dproducto = $_SESSION['carrito'];
				$total     = $_SESSION['total'];
			}

			// Recibe los datos en variable para registrarlos y ocuparlos para el correo
			$tipo             = $dcompra['tipo'];
			$rut_con          = $dcompra['rut_con'];
			$nombre_con       = $dcompra['nombre_con'];
			$telefono_con     = $dcompra['telefono_con'];
			$correo_con       = $dcompra['correo_con'];
			$rut_fac          = $dcompra['rut_fac'];
			$razon_fac        = $dcompra['razon_fac'];
			$telefono_fac     = $dcompra['telefono_fac'];
			$correo_fac       = $dcompra['correo_fac'];
			$giro_fac         = $dcompra['giro_fac'];
			$region_fac       = $dcompra['region_fac'];
			$comuna_fac       = $dcompra['comuna_fac'];
			$sector_fac       = $dcompra['sector_fac'];
			$calle_fac        = $dcompra['calle_fac'];
			$nro_calle_fac    = $dcompra['nro_calle_fac'];
			$region_dir       = $dcompra['region_dir'];
			$comuna_dir       = $dcompra['comuna_dir'];
			$sector_dir       = $dcompra['sector_dir'];
			$calle_dir        = $dcompra['calle_dir'];
			$nro_calle_dir    = $dcompra['nro_calle_dir'];
			$indicaciones_dir = $dcompra['indicaciones_dir'];
			$fecha_visita     = $dcompra['fecha_visita'];
			$hora_visita      = $dcompra['hora_visita'];
			$metodo_pago      = $dcompra['metodo_pago'];
			$costo_visita     = $dcompra['costo_visita'];
			$descuento        = $dcompra['descuento'];



			// ---------------------------------------------- //
			// Verifica la ID del cliente
			// ---------------------------------------------- //

			$id_cliente       = 0;
			$registrado       = FALSE;
			$clave_automatica = "";

			// Si el cliente ya esta logeado no se debe registrar y se toma la id de su sesion
			if(isset($_SESSION['login']) and ($_SESSION['login']==TRUE)) {
				$id_cliente = $_SESSION['id_cliente'];
			} else {

				// Si no esta logeado se verifica su rut en la BD para saber si se debe registrar o no
				if(count($resultado = $this->CompraModel->VerificarRutCorreo($rut_con,$correo_con))>0) {

					// Selecciona la ID del cliente existente
					foreach ($resultado as $r) {
						$id_cliente  = $r['id_cliente'];
					}

				} else {

					$clave_automatica = rand(00001, 99999);
					$clave_hash       = password_hash($clave_automatica,PASSWORD_DEFAULT);

					// Se registra el cliente si no esta logeado y no existe el rut en la BD
					$datac = array(
						'rut_con'    => $rut_con,
						'nombre_con' => $nombre_con,
						'telefono'   => $telefono_con,
						'correo'     => $correo_con,
						'clave'      => $clave_hash,
						'status'     => "REGISTRADO DESDE CARRITO"
					);
					// Si se registra correctamente el cliente se toma su ID para la compra
					if($id_cliente=$this->CompraModel->RegistrarCliente($datac)){
						$registrado = TRUE;
						$id_cliente = $id_cliente;
					}
				}
			}
			// ----------------------- //
			// ------ FIN CLIENTE ---- //
			// ----------------------- //


			// -- Inicialmente registra la compra sin los datos del pago -- //
			$data = array(
				"id_cliente"       => $id_cliente,
				"id_webpay"        => 0,
				"token"            => "0",
				"nro_transferencia"=> "",
				"tipo"             => $tipo,
				"rut_con"          => $rut_con,
				"nombre_con"       => $nombre_con,
				"telefono_con"     => $telefono_con,
				"correo_con"       => $correo_con,
				"rut_fac"          => $rut_fac,
				"razon_fac"        => $razon_fac,
				"telefono_fac"     => $telefono_fac,
				"correo_fac"       => $correo_fac,
				"giro_fac"         => $giro_fac,
				"region_fac"       => $region_fac,
				"comuna_fac"       => $comuna_fac,
				"sector_fac"       => $sector_fac,
				"calle_fac"        => $calle_fac,
				"nro_calle_fac"    => $nro_calle_fac,
				"region_dir"       => $region_dir,
				"comuna_dir"       => $comuna_dir,
				"sector_dir"       => $sector_dir,
				"calle_dir"        => $calle_dir,
				"nro_calle_dir"    => $nro_calle_dir,
				"indicaciones_dir" => $indicaciones_dir,
				"fecha_visita"     => $fecha_visita,
				"hora_visita"      => $hora_visita,
				"metodo_pago"      => $metodo_pago,
				'status_compra'    => "REGISTRADA",
				'status_pago'      => "SIN PROCESAR",
				"costo_visita"     => $costo_visita,
				'descuento'        => $descuento,
				'total'      	   => $total
			);
 
			
			if($id_compra=$this->CompraModel->RegistrarCompra($data)) {

				// Si los datos de la compra se registran correctamente se le asigna un numero de compra mayor a a cero
				if($id_compra>0) {

					// -- WEBPAY -- //
					// Si se recibe el token es Webpay
					if((isset($_POST["token_ws"]) and $_POST["token_ws"]!="")) {

						// ------- WEBPAY ------- //
						require_once('assets/webpay/libwebpay/webpay.php');
						require_once('assets/webpay/certificates/cert-normal.php');
						require_once('assets/webpay/iniciar.php');

						$token = filter_input(INPUT_POST, 'token_ws');

						// Rescatamos resultado y datos de la transaccion
						$WebPayResultado = $webpay->getNormalTransaction()->getTransactionResult($token);

						// Se verificamos el resultado de la transacción
						if(isset($WebPayResultado->detailOutput->responseCode))  {

							// Este o no aprobado se registran los datos de la transaccion
							$TipoPagoDescripcion  = DescripcionTipoPago($WebPayResultado->detailOutput->paymentTypeCode);
							$RespuestaDescripcion = DescripcionRespuesta($WebPayResultado->detailOutput->responseCode);
							$VCIDescripcion       = DescripcionVCI($WebPayResultado->VCI);

							// --- REGISTRA LOS DETALLES DEL PAGO DE WEBPAY --- //
							$data_pago = array(
								'id_compra'           => $id_compra,
								'token'               => $token,
								'accountingDate'      => $WebPayResultado->accountingDate,
								'buyOrder'            => $WebPayResultado->buyOrder,
								'cardNumber'          => $WebPayResultado->cardDetail->cardNumber,
								'cardExpirationDate'  => $WebPayResultado->cardDetail->cardExpirationDate,
								'authorizationCode'   => $WebPayResultado->detailOutput->authorizationCode,
								'paymentTypeCode'     => $WebPayResultado->detailOutput->paymentTypeCode,
								'paymentTypeCodeDes'  => $TipoPagoDescripcion,
								'responseCode'        => $WebPayResultado->detailOutput->responseCode,
								'sharesNumber'        => $WebPayResultado->detailOutput->sharesNumber,
								'amount'              => $WebPayResultado->detailOutput->amount,
								'commerceCode'        => $WebPayResultado->detailOutput->commerceCode,
								'buyOrder'            => $WebPayResultado->detailOutput->buyOrder,
								'responseDescription' => $RespuestaDescripcion,
								'sessionId'           => $WebPayResultado->sessionId,
								'transactionDate'     => $WebPayResultado->transactionDate,
								'urlRedirection'      => $WebPayResultado->urlRedirection,
								'VCI'                 => $WebPayResultado->VCI,
								'VCIDescription'      => $VCIDescripcion,
								'id_cliente'          => 1,
								'rut_contacto'        => $rut_con,
								'rut_facturacion'     => $rut_fac
							);

							// Registra los datos del pago
							$id_pago_webpay = $this->WebpayModel->RegistrarPago($data_pago);

							// PAGO ACEPTADO
							if ($WebPayResultado->detailOutput->responseCode === 0) {

								// -- Actualiza compra con la informacion -- //
								$datos_compra = array(
									'id_webpay'             => $id_pago_webpay,
									'token'                 => $token,
									'status_compra'         => "PAGADA",
									'status_pago'           => "PAGO CONFIRMADO"
								);
								if($this->CompraModel->ActualizarCompra($datos_compra,$id_compra)) {
									$data['mensaje']  = "Pago confirmado, su compra ha sido registrada con el nro: #$id_compra";
									$todo_bien        = TRUE;

									// Crea 3 variables que seran utilizadas para mostrar el voucher webpay
									$data['voucher']  = TRUE;
									$data['url']      = $WebPayResultado->urlRedirection;
									$data['token_ws'] = $token;
								}


							// PAGO RECHAZADO
							} else {

								// -- Actualiza compra con la informacion -- //
								$datos_compra = array(
									'id_webpay'             => $id_pago_webpay,
									'token'                 => $token,
									'status_compra'         => "ANULADA",
									'status_pago'           => "PAGO RECHAZADO",
									'informacion_adicional' => $RespuestaDescripcion
								);
								if($this->CompraModel->ActualizarCompra($datos_compra,$id_compra)) {
									$data['error'] = "La compra fue registrada pero el pago fue rechazado por Webpay, motivo: <b>" . $RespuestaDescripcion . "</b>";
								}
							}

						} else {

							// -- Actualiza compra con la informacion -- //
							$datos_compra = array(
								'status_compra'         => "ANULADA",
								'status_pago'           => "ERROR AL PROCESAR EL PAGO",
								'informacion_adicional' => "Se recibio el Token pero ocurrio un error, probablemente la sesion cadudo o se recargo la pagina"
							);
							if($this->CompraModel->ActualizarCompra($datos_compra,$id_compra)) {
								$data['error'] = "Se recibio el Token pero ocurrio un error, probablemente la sesion cadudo o se recargo la pagina";
							}
							// ---------------------------------------- //

						}
					}
					// -- FIN WEBPAY -- //



					// -- TRANSFERENCIA -- //
					// Si se transferencia
					if((isset($_POST["transferencia"])) and ($_POST['transferencia'])) {

						// Si es por transferencia actualiza el status del pago "Por Verificar"
						$datos_compra = array(
							'status_compra'    => "GENERADA",
							'status_pago'      => "POR VERIFICAR"
						);
						// Termina el proceso por Transferencia
						if($this->CompraModel->ActualizarCompra($datos_compra,$id_compra)) {
							$data['mensaje'] = "Su compra ha sido registrada correctamente con el nro: #$id_compra";
							$todo_bien       = TRUE;
						} else {
							$data['error'] = "Error al actualizar los datos de la compra por Transferencia";
						}
					}
					// -- FIN TRANSFERENCIA -- //



				// Si no se registro la compra o sus detalles iniciales
				} else {

					// No se registro el encabezado
					if($id_compra>0) {
						$data['error'] = "Error al registrar los datos de la compra";
					}
					// No se registraron los detalles de los productos
					if($error==FALSE) {
						$data['error'] = "Error al registrar los detalles de la compra";
					}

				}
			}



			// ----------------------------------------------- //
			// ------------ Notifica por correo -------------- //
			// ----------------------------------------------- //

			if($todo_bien==TRUE) {
				
				// Inicio Registra la reserva
				if($fecha_visita!="" and $hora_visita!="") {
					
					$fecha_visita_formateada = date('Y-m-d', strtotime($fecha_visita));
					
					$datos_reserva = array(
						'fecha'     => $fecha_visita_formateada,
						'hora'      => $hora_visita,
						'id_compra' => $id_compra
					);
					$this->ReservaModel->Registrar($datos_reserva);
				}
				// Fin Registra la reserva

				$compra_detalle = $this->CompraModel->ProductosCompra($id_compra);
				$datospago      = $this->CompraModel->DetallePagoWebPay($id_compra);

				// Para Administrador de Redelect
				$notificar_redelect = $this->config->item('notificar_redelect');

				// Para el cliente
				$correos_para[] = $correo_con;
				$correos_para[] = $correo_fac;

				// Elimina correos duplicados
				$correos_para = array_unique($correos_para);

				// Elimina los campos vacios
				$correos_para = array_filter($correos_para);

				// Fecha
			 	//$fecha = date("d-m-Y");

		     	// Libreria Email
	 			$this->load->library("email");

				// Datos
				$configSMTP = $this->config->item('configSMTP');
				$from       = $this->config->item('from');
				$sistema    = $this->config->item('sistema');

				// Si tiene razon social la muestra en el asunto
				$razon_factura = "";
				if($razon_fac!=""){
					$razon_factura = " (" . $razon_fac . ")";
				}

				// Asunto
				$asunto = $sistema . " - Compra #" . $id_compra . " - " . $nombre_con . "" . $razon_factura;

				// Base URL
				$base_url = base_url();


				// Si se registra el cliente en el proceso de compra se envian sus datos de acceso
				$html_cliente_clave = "";
				$enlace_iniciar = base_url() . "index.php/Login";
				if($registrado==TRUE){
					$html_cliente_clave = "
					<br><br>
					Para ingresar a su cuenta puede acceder haciendo
					<a href='$enlace_iniciar' target='_blank'>Click aquí</a>.
					<br>Usuario: <b>$correo_con</b>
					<br>Clave: <b>$clave_automatica</b>
					<br><br>
					";
				}


				// Contenido Contacto
				$html_datos_contacto = "
				<br><br>
				<table style='width: 100%; border: 1px solid #999; table-layout:fixed; word-wrap:break-word;' cellspacing='0'>
				<tr>
					<td style='padding: 8px; background-color: #333; color: #fff;' colspan='6'>Datos de Contacto</td>
				</tr>
				<tr>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Tipo de comprobante:</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$tipo</b></td>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>RUT:</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$rut_con</b></td>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Nombre:</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$nombre_con</b></td>
				</tr>
				<tr>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Teléfono:</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$telefono_con</b></td>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Correo:</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$correo_con</b></td>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'></td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b></b></td>
				</tr>
				</table>";


				// Contenido Factura
				if($tipo=="Factura") {

					// Contenido Factura
					$html_datos_factura = "
					<br><br>
					<table style='width: 100%; border: 1px solid #999; table-layout:fixed; word-wrap:break-word;' cellspacing='0'>
					<tr>
						<td style='padding: 8px; background-color: #333; color: #fff;' colspan='6'>Datos de Facturación</td>
					</tr>
					<tr>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>RUT:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$rut_fac</b></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Razón Social:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$razon_fac</b></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Giro:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$giro_fac</b></td>
					</tr>
					<tr>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Teléfono:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$telefono_fac</b></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Correo:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$correo_fac</b></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Región</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$region_fac</b></td>
					</tr>
					<tr>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Comuna:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$comuna_fac</b></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Sector:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$sector_fac</b></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Calle</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$calle_fac</b></td>
					</tr>
					<tr>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Nro calle:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$nro_calle_fac</b></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'></td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b></b></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'></td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b></b></td>
					</tr>
					</table>";
				} else { $html_datos_factura = ""; }


				// Contenido Instalación
				$html_datos_instalacion = "
				<br><br>
				<table style='width: 100%; border: 1px solid #999; table-layout:fixed; word-wrap:break-word;' cellspacing='0'>
				<tr>
					<td style='padding: 8px; background-color: #333; color: #fff;' colspan='6'>Datos de Instalación/Visita</td>
				</tr>
				<tr>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Región:</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$region_dir</b></td>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Comuna:</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$comuna_dir</b></td>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Sector:</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$sector_dir</b></td>
				</tr>
				<tr>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Calle:</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$calle_dir</b></td>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Nro Calle:</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$nro_calle_dir</b></td>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Indicaciones</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$indicaciones_dir</b></td>
				</tr>
				<tr>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Fecha visita:</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$fecha_visita</b></td>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Hora visita:</td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$hora_visita</b></td>
					<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'></td>
					<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b></b></td>
				</tr>
				</table>";


			    // Detalles de la Transaccion Webpay
				if (($metodo_pago=="WEBPAY") and (count($datospago)>0)) {
					foreach ($datospago as $webpay) {

						$buyOrder            = $webpay['buyOrder'];

						if($webpay['responseCode']=="0") $numero_tarjeta = "XXXX-XXXX-XXXX-" . $webpay['cardNumber'];
						else                             $numero_tarjeta = "";

						$cardNumber          = $webpay['cardNumber'];
						$cardExpirationDate  = $webpay['cardExpirationDate'];
						$authorizationCode   = $webpay['authorizationCode'];
						$sharesNumber        = $webpay['sharesNumber'];
						$paymentTypeCodeDes  = $webpay['paymentTypeCodeDes'];
						$paymentTypeCode     = $webpay['paymentTypeCode'];
						$responseCode        = $webpay['responseCode'];
						$responseDescription = $webpay['responseDescription'];
						$amount              = number_format($webpay['amount'],'0',',','.');
						$commerceCode        = $webpay['commerceCode'];
						$transactionDate     = date("d-m-Y H:i", strtotime($webpay['transactionDate']));
						$VCIDescription      = $webpay['VCIDescription'];
						$VCI                 = $webpay['VCI'];

						// Contenido WebPay
						$html_datos_webpay = "
							<br><br>
							<table style='width: 100%; border: 1px solid #999; table-layout:fixed; word-wrap:break-word;' cellspacing='0'>
							<tr>
								<td style='padding: 8px; background-color: #333; color: #fff;' colspan='6'>Detalles de la Transaccion Webpay </td>
							</tr>
							<tr>
								<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>ID Webpay:</td>
								<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$id_pago_webpay</b></td>
								<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>ID Compra:</td>
								<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$buyOrder</b></td>
								<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Nro de Tarjeta:</td>
								<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$numero_tarjeta</b></td>
							</tr>
							<tr>
								<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Tarjeta Expiración:</td>
								<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$cardExpirationDate</b></td>
								<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Código de autorización:</td>
								<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$authorizationCode</b></td>
								<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Nro de cuotas:</td>
								<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$sharesNumber</b></td>
							</tr>
							<tr>
								<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Tipo de pago:</td>
								<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$paymentTypeCodeDes ($paymentTypeCode)</b></td>
								<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Respuesta:</td>
								<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$responseDescription ($responseCode)</b></td>
								<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Total:</td>
								<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$amount</b></td>
							</tr>
							<tr>
								<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Fecha transacción:</td>
								<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$transactionDate</b></td>
								<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Más información::</td>
								<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$VCIDescription ($VCI)</b></td>
								<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'></td>
								<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b></b></td>
							</tr>
							</table>";
					}
				} else $html_datos_webpay = "";


			    // Detalles de la Transferencia
				if ($metodo_pago=="TRANSFERENCIA") {

					// Contenido Transferencia
					$banco_cuenta   = $this->config->item('banco_cuenta');
					$titular_cuenta = $this->config->item('titular_cuenta');
					$rut_cuenta     = $this->config->item('rut_cuenta');
					$tipo_cuenta    = $this->config->item('tipo_cuenta');
					$numero_cuenta  = $this->config->item('numero_cuenta');
					$notificar_pago = $this->config->item('notificar_pago');

					$html_datos_transferencia = "
					<br><br>
					<table style='width: 100%; border: 1px solid #999; table-layout:fixed; word-wrap:break-word;' cellspacing='0'>
					<tr>
						<td style='padding: 8px; background-color: #333; color: #fff;' colspan='6'>Datos para Realizar el Pago por Transferencia</td>
					</tr>
					<tr>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Banco:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$banco_cuenta</b></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Titular:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$titular_cuenta</b></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>RUT:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$rut_cuenta</b></td>
					</tr>
					<tr>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Tipo de cuenta:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$tipo_cuenta</b></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Número de cuenta:</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$numero_cuenta</b></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>Debe enviar el comprobante de pago a</td>
						<td style='padding: 8px; border-top: 1px solid #999; min-width: 200px'><b>$notificar_pago</b></td>
					</tr>
					</table>";

				} else $html_datos_transferencia = "";


				// Detalles de los productos
				if (isset($compra_detalle) and count($compra_detalle)>0) {

					// Contenido Transferencia
					$banco_cuenta   = $this->config->item('banco_cuenta');
					$titular_cuenta = $this->config->item('titular_cuenta');
					$rut_cuenta     = $this->config->item('rut_cuenta');
					$tipo_cuenta    = $this->config->item('tipo_cuenta');
					$numero_cuenta  = $this->config->item('numero_cuenta');
					$notificar_pago = $this->config->item('notificar_pago');

					$html_datos_productos = "
					<br><br>
					<table style='width: 100%; border: 1px solid #999; table-layout:fixed; word-wrap:break-word;' cellspacing='0'>
					<tr>
						<td style='padding: 8px; background-color: #333; color: #fff;'>Código</td>
						<td style='padding: 8px; background-color: #333; color: #fff;'>Nombre</td>
						<td style='padding: 8px; background-color: #333; color: #fff;'>Descripción</td>
						<td style='padding: 8px; background-color: #333; color: #fff;'>Precio</td>
						<td style='padding: 8px; background-color: #333; color: #fff;'>Cantidad</td>
						<td style='padding: 8px; background-color: #333; color: #fff;'>Subtotal</td>
					</tr>";
					$total_compra = 0;
					foreach ($compra_detalle as $p) {
						$producto_codigo      = $p['codigo_producto'];
						$producto_nombre      = $p['nombre_producto'];
						$producto_descripcion = $p['descripcion_producto'];
						$producto_cantidad    = $p['cantidad'];
						$producto_precio      = $p['precio'];
						$precio_formato       = number_format($p['precio'],'0',',','.');
						$subtotal             = round($producto_cantidad*$producto_precio);
						$total_compra         = $total_compra+$subtotal;

						$html_datos_productos .= "
						<tr>
							<td style='padding: 8px; border-top: 1px solid #999;'>$producto_codigo</td>
							<td style='padding: 8px; border-top: 1px solid #999;'>$producto_nombre</td>
							<td style='padding: 8px; border-top: 1px solid #999;'>$producto_descripcion</td>
							<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>$producto_cantidad</td>
							<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>$ $precio_formato</td>
							<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'>$ $subtotal</td>
						</tr>";
					}

					$total_formato         = number_format($total_compra,'0',',','.');
					$html_datos_productos .= "
					<tr>
						<td style='padding: 8px; border-top: 1px solid #999;' colspan='5'></td>
						<td style='padding: 8px; border-top: 1px solid #999; text-align: right;'><b>$ $total_formato</b></td>
					</tr>";
					$html_datos_productos .= "</table>";

				} else $html_datos_productos = "";



				// Contenido Final Correo
				$htmlContent = "
				<div>
					Estimado(a) $nombre_con su compra número #$id_compra se ha registrado correctamente.

					$html_cliente_clave

					Detalles de su compra:

					$html_datos_contacto

					$html_datos_factura

					$html_datos_instalacion

					$html_datos_webpay

					$html_datos_transferencia

					$html_datos_productos

				</div>";

				//echo var_dump($correos_para);
				//exit;
				// Correo a soporte
				$this->email->initialize($configSMTP);
				$this->email->from($from,$sistema);
				$this->email->to("alexi_evanescence@hotmail.com");
				//$this->email->to($correos_para);
				//$this->email->cc($notificar_redelect);
				$this->email->subject($asunto);
				$this->email->reply_to($notificar_redelect);
				$this->email->message($htmlContent);

				// Si se envia correctamente
				if($this->email->send()) {
					//echo $this->email->print_debugger();
					$data['correo_ok'] = TRUE;
				} else {
					//echo $this->email->print_debugger();
					$data['correo_ok'] = FALSE;
				}
			}

			// ----------------------------------------------- //
			// ---------- Fin Notifica por correo ------------ //
			// ----------------------------------------------- //




			// Borra los datos de la sesion para que no pueda recargar y volver a guardar
			//unset($_SESSION['datos']);
			//unset($_SESSION['carrito']);



		} else {
			$data['error'] = "No existe información que procesar";
		}

		$this->load->view('/template/head');
		$this->load->view('Carro/ProcesarPago',$data);
		$this->load->view('/template/footer',$datac);
	}






	// Procesa el Pago ya sea por Webpay o Transferencia
	public function Finalizado()
	{
		date_default_timezone_set('America/Santiago');

		// Si se recibe el Token por POST el proceso de pago culmino correctamente
		if(isset($_POST['token_ws'])) {
			$data['mensaje'] = "Compra finalizada correctamente";
		}

		// El Cliente presiono el boton "Anular"
		if(isset($_POST['TBK_TOKEN']) and isset($_POST['TBK_ID_SESION']) and isset($_POST['TBK_ORDEN_COMPRA'])) {
			
			// Carga Modelo
			$this->load->model('WebpayModel');
			$this->load->model('CompraModel');

			// Recibe el token del pago webpay
        	$token_anulado = $_POST['TBK_TOKEN'];
			
			// Verifica si el pago ya esta registrado (en caso de que se recargue la pagina)
			$verificatoken = $this->WebpayModel->VerficarPagoToken($token_anulado);

			// Si no esta registrado es la primera vez que cancela el pago por lo tanto se guarda
			if (count($verificatoken)<=0) {

				// --- REGISTRA EL PAGO CANCELADO POR EL USUARIO --- //
				// Calculo la fecha actual con el formato de la BD ya que al ser anulada no me devuelve la fecha webpay
				$now      = DateTime::createFromFormat('U.u', number_format(microtime(true), 3, '.', ''));
				$php_date = $now->format("Y-m-d H:i:s.u");

				$data_pago = array(
					'token'           => $_POST['TBK_TOKEN'],
					'buyOrder'        => $_POST['TBK_ORDEN_COMPRA'],
					'sessionId'       => $_POST['TBK_ID_SESION'],
					'id_compra'       => $_POST['TBK_ORDEN_COMPRA'],
					'transactionDate' => $php_date
				);
				
				// Registra el pago 
				$id_pago_webpay = $this->WebpayModel->RegistrarPago($data_pago);
				
			    // Si registra el pago correctamente (a pesar de que haya sido cancelado) registra la compra
				if ($id_pago_webpay>0) {
					
					
					// Recibe los datos de las sesiones de la compra
					if($_SESSION['datos']!==null and $_SESSION['carrito']!==null and $_SESSION['total']!==null) {
						$dcompra   = $_SESSION['datos'];
						$dproducto = $_SESSION['carrito'];
						$total     = $_SESSION['total'];

						// Recibe los datos en variable para registrarlos y ocuparlos para el correo
						$tipo             = $dcompra['tipo'];
						$rut_con          = $dcompra['rut_con'];
						$nombre_con       = $dcompra['nombre_con'];
						$telefono_con     = $dcompra['telefono_con'];
						$correo_con       = $dcompra['correo_con'];
						$rut_fac          = $dcompra['rut_fac'];
						$razon_fac        = $dcompra['razon_fac'];
						$telefono_fac     = $dcompra['telefono_fac'];
						$correo_fac       = $dcompra['correo_fac'];
						$giro_fac         = $dcompra['giro_fac'];
						$region_fac       = $dcompra['region_fac'];
						$comuna_fac       = $dcompra['comuna_fac'];
						$sector_fac       = $dcompra['sector_fac'];
						$calle_fac        = $dcompra['calle_fac'];
						$nro_calle_fac    = $dcompra['nro_calle_fac'];
						$region_dir       = $dcompra['region_dir'];
						$comuna_dir       = $dcompra['comuna_dir'];
						$sector_dir       = $dcompra['sector_dir'];
						$calle_dir        = $dcompra['calle_dir'];
						$nro_calle_dir    = $dcompra['nro_calle_dir'];
						$indicaciones_dir = $dcompra['indicaciones_dir'];
						$fecha_visita     = $dcompra['fecha_visita'];
						$hora_visita      = $dcompra['hora_visita'];
						$metodo_pago      = $dcompra['metodo_pago'];
						$costo_visita     = $dcompra['costo_visita'];
						$descuento        = $dcompra['descuento'];



						// ---------------------------------------------- //
						// Verifica la ID del cliente
						// ---------------------------------------------- //
						$id_cliente       = 0;
						$registrado       = FALSE;
						$clave_automatica = "";

						// Si el cliente ya esta logeado no se debe registrar y se toma la id de su sesion
						if(isset($_SESSION['login']) and ($_SESSION['login']==TRUE)) {
							$id_cliente = $_SESSION['id_cliente'];
						} else {

							// Si no esta logeado se verifica su rut en la BD para saber si se debe registrar o no
							if(count($resultado = $this->CompraModel->VerificarRutCorreo($rut_con,$correo_con))>0) {

								// Selecciona la ID del cliente existente
								foreach ($resultado as $r) {
									$id_cliente  = $r['id_cliente'];
								}

							} else {

								$clave_automatica = rand(00001, 99999);
								$clave_hash       = password_hash($clave_automatica,PASSWORD_DEFAULT);

								// Se registra el cliente si no esta logeado y no existe el rut en la BD
								$datac = array(
									'rut_con'    => $rut_con,
									'nombre_con' => $nombre_con,
									'telefono'   => $telefono_con,
									'correo'     => $correo_con,
									'clave'      => $clave_hash,
									'status'     => "REGISTRADO DESDE CARRITO"
								);
								// Si se registra correctamente el cliente se toma su ID para la compra
								if($id_cliente=$this->CompraModel->RegistrarCliente($datac)){
									$registrado = TRUE;
									$id_cliente = $id_cliente;
								}
							}
						}
						// ----------------------- //
						// ------ FIN CLIENTE ---- //
						// ----------------------- //


						// -- Registra la compra con los datos del pago abortado -- //
						$data = array(
							"id_cliente"       => $id_cliente,
							"id_webpay"        => $id_pago_webpay,
							"token"            => $token_anulado,
							"nro_transferencia"=> "",
							"tipo"             => $tipo,
							"rut_con"          => $rut_con,
							"nombre_con"       => $nombre_con,
							"telefono_con"     => $telefono_con,
							"correo_con"       => $correo_con,
							"rut_fac"          => $rut_fac,
							"razon_fac"        => $razon_fac,
							"telefono_fac"     => $telefono_fac,
							"correo_fac"       => $correo_fac,
							"giro_fac"         => $giro_fac,
							"region_fac"       => $region_fac,
							"comuna_fac"       => $comuna_fac,
							"sector_fac"       => $sector_fac,
							"calle_fac"        => $calle_fac,
							"nro_calle_fac"    => $nro_calle_fac,
							"region_dir"       => $region_dir,
							"comuna_dir"       => $comuna_dir,
							"sector_dir"       => $sector_dir,
							"calle_dir"        => $calle_dir,
							"nro_calle_dir"    => $nro_calle_dir,
							"indicaciones_dir" => $indicaciones_dir,
							"fecha_visita"     => $fecha_visita,
							"hora_visita"      => $hora_visita,
							"metodo_pago"      => $metodo_pago,
							'status_compra'    => "ANULADA",
							'status_pago'      => "PAGO ABORTADO",
							"costo_visita"     => $costo_visita,
							'descuento'        => $descuento,
							'total'      	   => $total
						);

						// Registra el encabezado de la compra
						if($id_compra = $this->CompraModel->RegistrarCompra($data)) {

							
							// ------------------------------- //
							// - Datos a actualizar del pago - //
							// ------------------------------- //
							$data_pago_update = array(
								'amount'          => $total,
								'id_cliente'      => $id_cliente,
								'id_compra'       => $id_compra,
								'rut_contacto'    => $rut_con,
								'rut_facturacion' => $rut_fac,
								'respuestaPago'   => "Pago abortado por el usuario"
							);

							// Registra los detalles de los productos
							if($this->WebpayModel->ActualizarPago($data_pago_update,$id_pago_webpay)) {
							}
							// ------------------------------- //


							// Recorre los productos del carrito para guardarlo en los detalles
							foreach ($dproducto as $item) {

								// Array con los datos del carrito
								$data_productos = array(
									'id_compra'            => $id_compra,
									'id_producto'          => $item['id'],
									'codigo_producto'      => $item['codigo'],
									'nombre_producto'      => $item['name'],
									'descripcion_producto' => $item['descripcion'],
									'cantidad'             => $item['qty'],
									'precio'               => $item['price'],
									'imagen'               => $item['imagen']
								);

								// Registra los detalles de los productos
								if($this->CompraModel->RegistrarDetalles($data_productos)) {
									$error = FALSE; // No hubo error al registrar los detalles
								} else {
									$error = TRUE; // Hubo error al registrar los detalles
								}
							}


							// -------------------------------------------------- //
							// Registra el Costo de la comuna si es diferente de 0
							// -------------------------------------------------- //
							if($costo_visita!=0) {
								$nombre_costo_visita = $this->config->item('nombre_costo_visita') . " " . $comuna_dir;
								$data_productos = array(
									'id_compra'            => $id_compra,
									'id_producto'          => 0,
									'codigo_producto'      => 0,
									'nombre_producto'      => $nombre_costo_visita,
									'descripcion_producto' => '',
									'cantidad'             => 1,
									'precio'               => $costo_visita,
									'imagen'               => ''
								);

								if($this->CompraModel->RegistrarDetalles($data_productos)) {
									$error = FALSE; // No hubo error al registrar los detalles
								} else {
									$error = TRUE; // Hubo error al registrar los detalles
								}
							}
							// -------------------------------------- //

						} 
							
						$data['error'] = "El pago ha sido abortado por el usuario";
						
						// ---------------------- //

					} else {
						$data['error'] = "La sesiones con los datos ya no existen";
					}

				} else {
					$data['error'] = "Error al registrar el pago anulado";
				}
			} else {
				$data['error'] = "El pago anulado ya se encuentra registrado";
			}
		}

		$this->load->view('/template/head');
		$this->load->view('Carro/Finalizar',$data);
		$this->load->view('/template/footer');
	}


	// Muestra contenido del carrito en la cabecera
	public function Mostrar() {
		$this->load->view('/Carro/Carrito_cabecera');
	}


	// Agrega producto al carrito
	public function Agregar() {

		// Recibe los datos
		$id_producto         = $this->input->post('id_producto');
		$codigo_producto     = $this->input->post('codigo_producto');
		$nombre_producto     = $this->input->post('nombre_producto');
		$descripcion_producto= $this->input->post('descripcion_producto');
		$cantidad_producto   = $this->input->post('cantidad_producto');
		$precio_producto     = $this->input->post('precio_producto');
		$imagen_producto     = $this->input->post('imagen_producto');

		// Array con los datos
		$insert = array(
			'id'         => $id_producto,
			'codigo'     => $codigo_producto,
			'qty'        => $cantidad_producto,
			'price'      => $precio_producto,
			'name'       => $nombre_producto,
			'descripcion'=> $descripcion_producto,
			'imagen'     => $imagen_producto
		);
		//echo var_dump($insert);
		/*
		echo $id_producto;
		echo $codigo_producto;
		echo $cantidad_producto;
		echo $precio_producto;
		echo $descripcion_producto;
		echo $imagen_producto;
		*/

		// Guarda los datos en la sesion del carrito
		if($this->cart->insert($insert)) {
			//echo "Holaaaaa";
			$this->load->view('/Carro/Carrito_cabecera');
		} else {
			echo "mal";
		};
	}



	// Actualiza la cantidad del producto
	public function Actualizar() {

		// Recibe los datos
		$rowid             = $this->input->post('rowid');
		$cantidad_producto = $this->input->post('cantidad_producto');

		// Array con los datos
		$data = array(
			'rowid' => $rowid,
			'qty'   => $cantidad_producto
		);

		// Actualiza los datos en la sesion del carrito
		if($this->cart->update($data)) echo "ok"; else echo "mal";
	}


	// Elimina el producto
	public function Quitar() {

		// Recibe los datos
		$rowid = $this->input->post('rowid');

		// Array con los datos, si la cantidad en cero se elimina el producto del carrito
		$data = array(
			'rowid' => $rowid,
			'qty'   =>0
		);

		// Actualiza los datos en la sesion del carrito
		if($this->cart->update($data)) echo "ok"; else echo "mal";
	}



	// Elimina el producto desde el carrito de la cabecera
	public function QuitarCabecera() {

		// Recibe los datos
		$rowid = $this->input->post('rowid');

		// Array con los datos, si la cantidad en cero se elimina el producto del carrito
		$data = array(
			'rowid' => $rowid,
			'qty'   =>0
		);

		// Actualiza los datos en la sesion del carrito
		if($this->cart->update($data)) {
			$this->load->view('/Carro/Carrito_cabecera');
		} else {
			echo "mal";
		}
	}

}
