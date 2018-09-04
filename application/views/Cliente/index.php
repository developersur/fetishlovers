

<div class="container" id="menuadmin">
    <div class="row">
        
    <div class="col-sm-3 col-md-3">
            <?php $this->load->view('template/MenuCliente'); ?>
        </div>

        <!-- Contenido -->
        <div class="col-sm-9 col-md-9">
          <fieldset>
          <legend class="text-center header">Mi Cuenta</legend>

            <?php if(isset($datoscliente) and count($datoscliente)>0) { ?>
                <?php foreach ($datoscliente as $datos) { ?>
                   
                    <!-- Datos del Cliente-->
                    <table class="table table-bordered" style="table-layout:fixed; word-wrap:break-word;">
                        <thead class="cabecera_dark">
                            <tr>
                                <th colspan="4">Datos del Cliente</th>
                            </tr>
                        </thead>
                        <tr>
                            <td align="right">RUT:</td>
                            <td><?php echo $datos['rut_con']; ?></td>
                            <td align="right">Nombre:</td>
                            <td><?php echo $datos['nombre_con']; ?></td>
                        </tr>
                        <tr>
                            <td align="right">Teléfono:</td>
                            <td><?php echo $datos['telefono']; ?></td>
                            <td align="right">Correo:</td>
                            <td><?php echo $datos['correo']; ?></td>
                        </tr>
                    </table>

                <?php } ?>
            <?php } else { ?>
                <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> No se han encontrado resultados</div>
            <?php }  ?>

            <br>
            <legend class="text-center header">Últimas 5 Compras</legend>
            <table class="table table-bordered">
                <thead class="cabecera_dark">
                  <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Pago</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>

                <?php if($compras) { ?>
                    <?php foreach ($compras as $compra) {?>
                    <?php
                        $color_status = "";
                        switch ($compra['status_compra']) {
                            case 'ANULADA':
                                $color_status = "status_rojo";
                                break;

                            case 'REGISTRADA':
                                $color_status = "status_verde";
                                break;

                            case 'PAGADA':
                                $color_status = "status_verde";
                                break;

                            default:
                                break;
                        }
                    ?>

                    <tr>
                      <td><a class="btn-id" href="<?php echo base_url(); ?>index.php/Cliente/DetalleCompra?id_compra=<?php echo $compra['id_compra'] ?>">#<?php echo $compra['id_compra']; ?></a></td>
                      <td><?php echo $compra['tipo']; ?></td>
                      <td><?php echo $compra['nombre_con']; ?></td>
                      <td>$<?php echo number_format($compra['total'],'0',',','.'); ?></td>
                      <td><?php if($compra['metodo_pago']=="TRANSFERENCIA") echo "TRANSFE"; else echo $compra['metodo_pago']; ?></td>
                      <td><?php echo date("d-m-Y", strtotime($compra['fecha_creacion']));  ?></td>
                      <td class="<?php echo $color_status; ?>"><b><?php echo $compra['status_compra']; ?></b></td>
                    </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                      <td colspan="7">No se han encontrado compras</td>
                    </tr>
                <?php } ?>
                </tbody>
              </table>

          </fieldset>

        </div>
    </div>
</div>
