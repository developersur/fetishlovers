<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

	// Variables Globales
	// ----- Configuracion para SMTP ----- //
	$config['configSMTP'] = array(
		'protocol'    => 'smtp',
		'smtp_host'   => 'ssl://mail.redelect.cl',
		'smtp_port'   => 465,
		'smtp_user'   => 'notificador2@redelect.cl',
		'smtp_pass'   => 'NotRed*2020',
		'mailtype'    => 'html',
		'charset'     => 'utf-8',
		'newline'     => "\r\n",
		'wordwrap'    => TRUE,
		'validate'    => TRUE
	);

	$config['nombre_costo_visita']                = "COSTO DE VISITA A: ";
	$config['nombre_descuento_transferencia']     = "DESCUENTO POR TRANSFERENCIA";
	$config['porcentaje_descuento_transferencia'] = 5;

	// Correo Compra
	// Notificar compra a:
	$config['notificar_redelect'] = "compras@redelect";
	//$config['notificar_redelect'] = "alexi_evanescence@hotmail.com";
	
	// Mostrar en correo saliente a:
	//$config['from']     = "compras@redelect";
	$config['from']     = "notificador2@redelect.cl";

	// Con respuesta a:
	$config['reply_to'] = "compras@redelect";
	//$config['reply_to'] = "alexi_evanescence@hotmail.com";
	
	// Nombre del Sistema
	$config['sistema'] = "Redelect";


	// ----------------------------------- //




	// ----- DATOS BANCO TRANSFERENCIA ----- //
	$config['rut_cuenta']     = "10.721.974-9";
	$config['banco_cuenta']   = "SANTANDER BANEFE";
	$config['numero_cuenta']  = "1704940714";
	$config['titular_cuenta'] = "10.721.974-9";
	$config['tipo_cuenta']    = "Corriente";
	
	// Correo al que se deben notificar los pagos
	$config['notificar_pago'] = "pagos@redelect";

?>
