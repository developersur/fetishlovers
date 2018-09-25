<script>
    $(document).ready( function () {
        $('#ltdo_compra').DataTable({
            "language":{
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    } );
</script>

<div class="container" id="menuadmin">
    <div class="row">

        <!-- Menu Izquierdo Usuario -->
        <div class="col-sm-3 col-md-3">
            <?php $this->load->view('template/MenuAdmin'); ?>
        </div>

        <!-- Contenido Cliente -->
        <div class="col-sm-9 col-md-9">
          <fieldset>
          <legend class="text-center header">Listado Compras</legend>
              <div class="table-responsive">
              <table id="ltdo_compra" class="table table-bordered">
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
                        // Color del Status de la Compra
                        $color_statuscompra = "";
                        switch ($compra['status_compra']) {
                            case 'ANULADA'   : $color_statuscompra = "status_rojo";       break;
                            case 'REGISTRADA': $color_statuscompra = "status_naranja";    break;
                            case 'GENERADA'  : $color_statuscompra = "status_naranja";    break;
                            case 'PAGADA'    : $color_statuscompra = "status_verde";      break;
                            case 'FINALIZADA': $color_statuscompra = "status_negro";      break;
                            default:  break;
                        }

                    ?>

                    <tr>
                      <td><a class="btn-id" href="<?php echo base_url(); ?>index.php/Compra/Detalle?id_compra=<?php echo $compra['id_compra'] ?>">#<?php echo $compra['id_compra']; ?></a></td>
                      <td><?php echo $compra['tipo']; ?></td>
                      <td><?php echo $compra['nombre_con']; ?></td>
                      <td>$<?php echo number_format($compra['total'],'0',',','.'); ?></td>
                      <td><?php if($compra['metodo_pago']=="TRANSFERENCIA") echo "TRANSFE"; else echo $compra['metodo_pago']; ?></td>
                      <td><?php echo date("d-m-Y", strtotime($compra['fecha_creacion']));  ?></td>
                      <td class="<?php echo $color_statuscompra; ?>"><b><?php echo $compra['status_compra']; ?></b></td>
                    </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                      <td colspan="7">No se han encontrado compras</td>
                    </tr>
                <?php } ?>
                </tbody>
              </table>
              </div>
          </fieldset>
        </div>
    </div>
</div>
