

<div class="container" id="menuadmin">
    <div class="row">
        <!-- Menu Izquierdo Cliente -->
        <div class="col-sm-3 col-md-3">
            <?php $this->load->view('template/MenuCliente'); ?>
        </div>
        
        <!-- Contenido Cliente -->
        <div class="col-sm-9 col-md-9">
          <fieldset>
          <legend class="text-center header">Listado Compras</legend>
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
