<script type="text/javascript">
    
    $(document).ready(function () {
       
        // Cambia el status de la compra
        $(document).on("click","#CambiarStatusCompra", function(e) {
            e.preventDefault();

            var id_compra = $("#id_compra").val();

            $.confirm({
                title: 'Cambio de status',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Nuevo Status</label>' +
                '<select class="status_compra form-control" required>' +
                '<option value=""></option>' +
                '<option value="ANULADA">ANULADA</option>' +
                '<option value="PAGADA">PAGADA</option>' +
                '<option value="REGISTRADA">REGISTRADA</option>' +
                '<option value="GENERADA">GENERADA</option>' +
                '<option value="FINALIZADA">FINALIZADA</option>' +
                '</select>' +
                '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Guardar',
                        btnClass: 'btn-blue',
                        action: function () {
                            var status_compra = this.$content.find('.status_compra').val();
                            if(!status_compra){
                                $.alert('Debe indicar un estado para la compra');
                                return false;
                            } else {
                                // Cambia el Status por AJAX
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url(); ?>index.php/Compra/ActualizarStatusCompra",
                                    data: {id_compra:id_compra,status_compra:status_compra},
                                    success:function(data){
                                        switch(data) {
                                            case "ok": 
                                                location.reload();  
                                                break;
                                            default:
                                                alert("Error");
                                                break;
                                        }
                                    }
                                });
                            }
                        }
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        })



       // Cambia el status del pago
       $(document).on("click","#CambiarStatusPago", function(e) {
            e.preventDefault();

            var id_compra = $("#id_compra").val();
           
      
            $.confirm({
                title: 'Cambio de status',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Nuevo Status</label>' +
                '<select class="status_compra form-control" required>' +
                '<option value=""></option>' +
                '<option value="PAGO CONFIRMADO">PAGO CONFIRMADO</option>' +
                '<option value="PAGO RECHAZADO">PAGO RECHAZADO</option>' +
                '<option value="ERROR AL PROCESAR EL PAGO">ERROR AL PROCESAR EL PAGO</option>' +
                '<option value="SIN PROCESAR">SIN PROCESAR</option>' +
                '<option value="POR VERIFICAR">POR VERIFICAR</option>' +
                '</select>' +
                '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Guardar',
                        btnClass: 'btn-blue',
                        action: function () {
                            var status_compra = this.$content.find('.status_compra').val();
                            if(!status_compra){
                                $.alert('Debe indicar un estado para la compra');
                                return false;
                            } else {
                                // Cambia el Status por AJAX
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url(); ?>index.php/Compra/ActualizarStatusPago",
                                    data: {id_compra:id_compra,status_compra:status_compra},
                                    success:function(data){
                                        switch(data) {
                                            case "ok": 
                                                location.reload();  
                                                break;
                                            default:
                                                alert("Error");
                                                break;
                                        }
                                    }
                                });
                            }
                        }
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        })
    });

</script>



<div class="container" id="menuadmin">
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <?php $this->load->view('template/MenuAdmin'); ?>
        </div>
        <div class="col-sm-9 col-md-9">
          <fieldset>
          <legend class="text-center header">Detalle de la Compra #<?php echo $id_compra; ?></legend>
            
            <input type="hidden" id="id_compra" value="<?php echo $id_compra; ?>">

            <?php if(isset($compra) and count($compra)>0) { ?>
                <?php foreach ($compra as $data_post) { ?>
                   
                    <?php
                        // Color del Status de la Compra
                        $color_statuscompra = "";
                        switch ($data_post['status_compra']) {
                            case 'ANULADA'   : $color_statuscompra = "status_rojo";       break;
                            case 'REGISTRADA': $color_statuscompra = "status_naranja";    break;
                            case 'GENERADA'  : $color_statuscompra = "status_naranja";    break;
                            case 'PAGADA'    : $color_statuscompra = "status_verde";      break;
                            case 'FINALIZADA': $color_statuscompra = "status_negro";      break;
                            default:  break;
                        }

                        // Color del Status del Pago
                        $color_statuspago = "";
                        switch ($data_post['status_pago']) {
                            case 'PAGO CONFIRMADO'          : $color_statuspago = "status_verde";   break;
                            case 'PAGO RECHAZADO'           : $color_statuspago = "status_rojo";    break;
                            case 'ERROR AL PROCESAR EL PAGO': $color_statuspago = "status_rojo";    break;
                            case 'SIN PROCESAR'             : $color_statuspago = "status_naranja"; break;
                            case 'POR VERIFICAR'            : $color_statuspago = "status_naranja"; break;
                            default:  break;
                        }
                    ?>

                    <table class="table table-bordered" style="table-layout:fixed; word-wrap:break-word;">
                        <thead class="cabecera_dark">
                            <tr>
                                <th colspan="4">Status</th>
                            </tr>
                        </thead>
                        <tr>
                            <td align="right">Status Actual:</td>
                            <td class="<?php echo $color_statuscompra; ?>">
                                <b><?php echo $data_post['status_compra']; ?></b>
                                <a href='#' id='CambiarStatusCompra'><i class="fas fa-edit"></i></a>
                            </td>
                            <td align="right">Status Pago:</td>
                            <td class="<?php echo $color_statuspago; ?>">
                                <b><?php echo $data_post['status_pago']; ?></b>
                                <a href='#' id='CambiarStatusPago'><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    </table>
                    
                    <!-- Datos del Cliente-->
                    <table class="table table-bordered" style="table-layout:fixed; word-wrap:break-word;">
                        <thead class="cabecera_dark">
                        <tr>
                            <th colspan="6">Datos de Contacto</th>
                        </tr>
                        </thead>
                        <tr>
                            <td align="right">Tipo de comprobante:</td>
                            <td><?php echo $data_post['tipo']; ?></td>
                            <td align="right">RUT:</td>
                            <td><?php echo $data_post['rut_con']; ?></td>
                            <td align="right">Nombre:</td>
                            <td><?php echo $data_post['nombre_con']; ?></td>
                        </tr>
                        <tr>
                            <td align="right">Teléfono:</td>
                            <td><?php echo $data_post['telefono_con']; ?></td>
                            <td align="right">Correo:</td>
                            <td><?php echo $data_post['correo_con']; ?></td>
                            <td align="right"></td>
                            <td></td>
                        </tr>
                    </table>


                    <!-- Datos de Facturación-->
                    <?php if ($data_post['tipo']=="Factura") { ?>
                        <table class="table table-bordered" style="table-layout:fixed; word-wrap:break-word;">
                            <thead class="cabecera_dark">
                            <tr>
                                <th colspan="6">Datos de Facturación</th>
                            </tr>
                            </thead>
                            <tr>
                                <td align="right">RUT:</td>
                                <td><?php echo $data_post['rut_fac']; ?></td>
                                <td align="right">Razón Social:</td>
                                <td><?php echo $data_post['razon_fac']; ?></td>
                                <td align="right">Giro:</td>
                                <td><?php echo $data_post['giro_fac']; ?></td>
                            </tr>
                            <tr>
                                <td align="right">Teléfono:</td>
                                <td><?php echo $data_post['telefono_fac']; ?></td>
                                <td align="right">Correo:</td>
                                <td><?php echo $data_post['correo_fac']; ?></td>
                                <td align="right">Región:</td>
                                <td><?php echo $data_post['region_fac']; ?></td>
                            </tr>
                            <tr>
                                <td align="right">Comuna:</td>
                                <td><?php echo $data_post['comuna_fac']; ?></td>
                                <td align="right">Sector:</td>
                                <td><?php echo $data_post['sector_fac']; ?></td>
                                <td align="right">Calle:</td>
                                <td><?php echo $data_post['calle_fac']; ?></td>
                            </tr>
                            <tr>
                                <td align="right">Nro Calle:</td>
                                <td><?php echo $data_post['nro_calle_fac']; ?></td>
                                <td align="right"></td>
                                <td></td>
                                <td align="right"></td>
                                <td></td>
                            </tr>
                        </table>
                    <?php } ?>



                    <!-- Datos de Facturación-->
                    <table class="table table-bordered" style="table-layout:fixed; word-wrap:break-word;">
                        <thead class="cabecera_dark">
                        <tr>
                            <th colspan="6">Datos de Instalación/Visita</th>
                        </tr>
                        </thead>
                        <tr>
                            <td align="right">Región:</td>
                            <td><?php echo $data_post['region_dir']; ?></td>
                            <td align="right">Comuna:</td>
                            <td><?php echo $data_post['comuna_dir']; ?></td>
                            <td align="right">Sector:</td>
                            <td><?php echo $data_post['sector_dir']; ?></td>
                        </tr>
                        <tr>

                            <td align="right">Calle:</td>
                            <td><?php echo $data_post['calle_dir']; ?></td>
                            <td align="right">Nro Calle:</td>
                            <td><?php echo $data_post['nro_calle_dir']; ?></td>
                            <td align="right">Indicaciones:</td>
                            <td><?php echo $data_post['indicaciones_dir']; ?></td>
                        </tr>
                        <tr>
                            <td align="right">Fecha visita:</td>
                            <td><?php echo $data_post['fecha_visita']; ?></td>
                            <td align="right">Hora visita</td>
                            <td><?php echo $data_post['hora_visita']; ?></td>
                            <td align="right"></td>
                            <td></td>
                        </tr>
                    </table>


                    <!-- Metodo de Pago-->
                    <table class="table table-bordered" style="table-layout:fixed; word-wrap:break-word;">
                        <thead class="cabecera_dark">
                        <tr>
                            <th colspan="2">Datos del Pago</th>
                        </tr>
                        </thead>
                        <?php if ($data_post['metodo_pago']=="WEBPAY") { ?>
                        <tr>
                            <td align="right">Método de Pago:</td>
                            <td><?php echo $data_post['metodo_pago']; ?> <img src="<?php echo base_url(); ?>/assets/img/icono_webpay.png" width="50px"></td>
                        </tr>
                        <?php } ?>
                        <?php if ($data_post['metodo_pago']=="TRANSFERENCIA") { ?>
                        <tr>
                            <td align="right">Método de Pago:</td>
                            <td><?php echo $data_post['metodo_pago']; ?> <img src="<?php echo base_url(); ?>/assets/img/icono_transferencia.png" width="30px"></td>
                        </tr>
                        <?php } ?>
                    </table>





                    <!-- Detalles de la Transaccion Webpay-->
                    <?php if (($data_post['metodo_pago']=="WEBPAY") and (count($datospago)>0)) { ?>
                        <?php foreach ($datospago as $webpay) {  ?>
                            <table class="table table-bordered" style="table-layout:fixed; word-wrap:break-word;">
                                <thead class="cabecera_dark">
                                <tr>
                                    <th colspan="6">Detalles de la Transacción WebPay</th>
                                </tr>
                                </thead>
                                <tr>
                                    <td align="right">ID Webpay:</td>
                                    <td><?php echo $webpay['id_pago_webpay']; ?></td>
                                    <td align="right">ID Compra:</td>
                                    <td><?php echo $webpay['buyOrder']; ?></td>
                                    <td align="right">Nro de Tarjeta:</td>
                                    <td><?php if($webpay['responseCode']=="0") echo "XXXX-XXXX-XXXX-" . $webpay['cardNumber']; ?></td>
                                </tr>
                                <tr>
                                    <td align="right">Tarjeta Expiración:</td>
                                    <td><?php echo $webpay['cardExpirationDate']; ?></td>
                                    <td align="right">Código de autorización:</td>
                                    <td><?php echo $webpay['authorizationCode']; ?></td>
                                    <td align="right">Nro de cuotas:</td>
                                    <td><?php echo $webpay['sharesNumber']; ?></td>
                                </tr>
                                <tr>
                                <td align="right">Tipo de pago:</td>
                                    <td><?php echo $webpay['paymentTypeCodeDes'] . "(" . $webpay['paymentTypeCode'] .")"; ?></td>
                                    <td align="right">Respuesta:</td>
                                    <td><?php echo $webpay['responseDescription'] . "(" . $webpay['responseCode'] .")"; ?></td>
                                    <td align="right">Total:</td>
                                    <td>$<?php echo number_format($webpay['amount'],'0',',','.'); ?></td>
                                </tr>
                                <td align="right">Codigo comercio:</td>
                                    <td><?php echo $webpay['commerceCode']; ?></td>
                                    <td align="right">Fecha transacción:</td>
                                    <td><?php echo date("d-m-Y H:i", strtotime($webpay['transactionDate'])); ?></td>
                                    <td align="right">Más información:</td>
                                    <td><?php echo $webpay['VCIDescription'] . "(" . $webpay['VCI'] .")"; ?></td>
                                </tr>
                            </table>
                        <?php } ?>
                    <?php } ?>



                    <!-- Detalles de los Productos-->
                    <?php if (count($compra_detalle)>0) { ?>
                        <table class="table table-bordered">
                            <thead class="cabecera_dark">
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <?php foreach ($compra_detalle as $p) {  ?>
                                <tr>
                                    <td><?php echo $p['codigo_producto']; ?></td>
                                    <td><?php echo $p['nombre_producto']; ?></td>
                                    <td><?php echo $p['descripcion_producto']; ?></td>
                                    <td align="right">$ <?php echo number_format($p['precio'],'0',',','.'); ?></td>
                                    <td align="right"><?php echo $p['cantidad']; ?></td>
                                    <td align="right">$ <?php echo number_format($p['cantidad']*$p['precio'],'0',',','.'); ?></td>
                                </tr>
                            <?php } ?>
                                <tr>
                                    <td colspan='5' align="right">Total:</td>
                                    <td align="right"><b>$ <?php echo number_format($data_post['total'],'0',',','.'); ?></b></td>
                                </tr>
                        </table>
                    <?php } ?>

                <?php } ?>
            <?php } else { ?>
                <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> No se han encontrado resultados</div>
            <?php }  ?>


          </fieldset>
        </div>
    </div>
</div>
