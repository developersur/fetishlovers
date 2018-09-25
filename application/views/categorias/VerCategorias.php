<script>
    $(document).ready( function () {
        $('#ltdo_categoria').DataTable({
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
        <div class="col-sm-3 col-md-3">
            <?php $this->load->view('template/MenuAdmin'); ?>
        </div>
        <div class="col-sm-9 col-md-9">
          <fieldset>
          <legend class="text-center header">Categorías</legend>
              <div class="table-responsive">
              <table id="ltdo_categoria" class="table table-bordered table-condensed">
                <thead class="cabecera_dark">
                  <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Habilitado</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($categorias)
                  {
                    foreach ($categorias->result() as $categoria)
                    {
                    ?>
                    <tr>
                      <td><?php echo $categoria->nombre; ?></td>
                      <td><?php echo $categoria->descripcion; ?></td>
                      <td><?php echo $categoria->habilitado; ?></td>
                    </tr>
                    <?php
                    }
                  } ?>
                </tbody>
              </table>
              </div>
          </fieldset>
        </div>
    </div>
</div>
