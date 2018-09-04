

<div class="container" id="menuadmin">
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <?php $this->load->view('template/MenuCliente'); ?>
        </div>
        <div class="col-sm-9 col-md-9">
          <fieldset>
          <legend class="text-center header">Detalle de la Compra #<?php echo $id_compra; ?></legend>

            <?php if(isset($compra) and count($compra)>0) { ?>
                <?php foreach ($compra as $data_post) { ?>
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
