<?php

	// Parametros WebPay
	$configuration = new Configuration();
	$configuration->setEnvironment($certificate['environment']);
	$configuration->setCommerceCode($certificate['commerce_code']);
	$configuration->setPrivateKey($certificate['private_key']);
	$configuration->setPublicCert($certificate['public_cert']);
    $configuration->setWebpayCert($certificate['webpay_cert']);
    
	// -- Creacion Objeto Webpay -- //
    $webpay = new Webpay($configuration);

    // -- Descripcion Tipo de Pago -- //
    function DescripcionTipoPago($TipoPagoCodigo)
    {
        switch ($TipoPagoCodigo) {
            case 'VD': $paymentTypeCodeDes = "Venta Debito"; break;
            case 'VN': $paymentTypeCodeDes = "Venta Normal"; break;
            case 'VC': $paymentTypeCodeDes = "Venta en cuotas"; break;
            case 'SI': $paymentTypeCodeDes = "3 cuotas sin interés"; break;
            case 'S2': $paymentTypeCodeDes = "2 cuotas sin interés"; break;
            case 'NC': $paymentTypeCodeDes = "N Cuotas sin interés"; break;
            default: $paymentTypeCodeDes = "No se obtuvo ninguna coincidencia"; break;
        }
        return $paymentTypeCodeDes;
    }

    // -- Descripcion Respuesta de la Transaccion -- //
    function DescripcionRespuesta($RespuestaCodigo)
    {
        switch ($RespuestaCodigo) {
            case 0:  $responseDescription = "Transacción aprobada"; break;
            case -1: $responseDescription = "Rechazo de transacción"; break;
            case -2: $responseDescription = "Transacción debe reintentarse"; break;
            case -3: $responseDescription = "Error en transacción"; break;
            case -4: $responseDescription = "Rechazo de transacción"; break;
            case -5: $responseDescription = "Rechazo por error de tasa"; break;
            case -6: $responseDescription = "Excede cupo máximo mensual";  break;
            case -7: $responseDescription = "Excede límite diario por transacción"; break;
            case -8: $responseDescription = "Rubro no autorizado"; break;
            default: $responseDescription = "No se recibió ningún código de respuesta"; break;
        }
        return $responseDescription;
    }

    // -- Descripcion VCI de Respuesta -- //
    function DescripcionVCI($CodigoVCI)
    {
        switch ($CodigoVCI) {
            case 'TSY': $VCIDescription = "Autenticación exitosa"; break;
            case 'TSN': $VCIDescription = "Autenticación fallida"; break;
            case 'TO':  $VCIDescription = "Tiempo máximo excedido para autenticación"; break;
            case 'ABO': $VCIDescription = "Autenticación abortada por tarjetahabiente"; break;
            case 'U3':  $VCIDescription = "Error interno en la autenticación"; break;
            default:    $VCIDescription = "La transacción no se autentico"; break;
        }
        return $VCIDescription;
    }

?>