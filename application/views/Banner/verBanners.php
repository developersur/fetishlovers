<script>
    $(document).ready( function () {
        $('#ltdo_banner').DataTable({
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
        <div class="">
            <?php $this->load->view('template/MenuAdmin'); ?>
        </div>
        <div class="col-sm-5 col-md-5 col-md-offset-3">
          <fieldset>
          <legend class="text-center header">Imagenes de banner</legend>
              <div class="table-responsive">
              <table id="ltdo_banner" class="table table-bordered">
                <thead class="cabecera_dark">
                  <tr>
                    <th>id</th>
                    <th>Habilitado</th>
                    <th>Imagen</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($banners)
                  {
                    foreach ($banners->result() as $banner)
                    {
                    ?>
                    <tr>
                      <td><?php echo $banner->id; ?></td>
                      <?php if($banner->estado){
                        echo '<td>Si</td>';
                      }else {
                        echo '<td>No</td>';
                      }
                      ?>
                      <td><img src="<?php echo $banner->url; ?>" alt="" width="30" height="30"></td>
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
