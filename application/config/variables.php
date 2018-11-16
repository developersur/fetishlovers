<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

	// Variables Globales
	// ----- Configuracion para SMTP ----- //
	$config['configSMTP'] = array(
		'protocol'    => 'smtp',
		'smtp_host'   => 'ssl://mail.fetishlovers.cl',
		'smtp_port'   => 465,
		'smtp_user'   => 'notificador@fetishlovers.cl',
		'smtp_pass'   => '#notificadorfl2333*',
		'mailtype'    => 'html',
		'charset'     => 'utf-8',
		'newline'     => "\r\n",
		'wordwrap'    => TRUE,
		'validate'    => TRUE
	);

	$config['nombre_costo_visita']                = "COSTO DE ENVIO A: ";
	$config['nombre_descuento_transferencia']     = "DESCUENTO POR TRANSFERENCIA";
	$config['porcentaje_descuento_transferencia'] = 5;

	// Correo Compra
	// Notificar compra a:
	$config['notificar_redelect'] = "compras@fetishlovers.cl";
	//$config['notificar_redelect'] = "alexi_evanescence@hotmail.com";
	
	// Mostrar en correo saliente a:
	//$config['from']     = "compras@redelect";
	$config['from']     = "notificador@fetishlovers.cl";

	// Con respuesta a:
	$config['reply_to'] = "compras@fetishlovers.cl";
	//$config['reply_to'] = "alexi_evanescence@hotmail.com";
	
	// Nombre del Sistema
	$config['sistema'] = "Fetishlovers";


	// ----------------------------------- //




	// ----- DATOS BANCO TRANSFERENCIA ----- //
	$config['rut_cuenta']     = "10.721.974-9";
	$config['banco_cuenta']   = "SANTANDER BANEFE";
	$config['numero_cuenta']  = "1704940714";
	$config['titular_cuenta'] = "10.721.974-9";
	$config['tipo_cuenta']    = "Corriente";
	
	// Correo al que se deben notificar los pagos
	$config['notificar_pago'] = "pagos@fetishlovers.cl";

?>
