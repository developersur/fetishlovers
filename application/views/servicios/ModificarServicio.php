<script>
  function open_edit_ser(id, titulo, descripcion)
  {
    $('#titulo_ser').val(titulo);
    $('#descripcion_ser').val(descripcion);
    $('#id_ser').val(id);

    $('#modal_edit_ser').modal('show');
  }

  $(document).ready( function () {
      $('#mod_servicio').DataTable({
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

  function habilita_ser(id, cod)
  {
    var estado;
    if( $('#'+id).prop('checked') )
    {
      estado = 'Si';
    }else{
      estado = 'No';
    }
    //alert(estado);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url(); ?>index.php/Servicio/updateHabilitado",
        data: {
          estado: estado,
          codigo: cod
        }
    })
    .done(function( msg ) {
      if(msg){
        location.reload();
      }else{
        alert('Ocurrio un error');
      }
    });
  }

</script>

<div class="container" id="menuadmin">
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <?php $this->load->view('template/MenuAdmin'); ?>
        </div>
        <div class="col-sm-9 col-md-9">
          <fieldset>
          <legend class="text-center header">Modificar servicios</legend>
              <div class="table-responsive">
              <table id="mod_servicio" class="table table-bordered table-condensed">
                <thead class="cabecera_dark">
                  <tr>
                    <th>Código</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Habilitado</th>
                    <th>Modificar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($servicios)
                  {
                    foreach ($servicios->result() as $servicio)
                    {
                    ?>
                    <tr>
                      <td><?php echo $servicio->codigo; ?></td>
                      <td><?php echo $servicio->titulo; ?></td>
                      <td><?php echo $servicio->descripcion; ?></td>
                      <td>
                      <label class="switch">
                          <?php if($servicio->habilitado == 'Si')
                          {
                          ?>
                            <input type="checkbox" id="h<?=$servicio->id?>" onchange="habilita_ser('<?php echo 'h'.$servicio->id;?>', '<?=$servicio->id;?>');" checked>
                          <?php
                          }else{?>
                            <input type="checkbox" id="h<?=$servicio->id?>" onchange="habilita_ser('<?php echo 'h'.$servicio->id;?>', '<?=$servicio->id;?>');">
                          <?php
                          }
                          ?>
                          <span class="slider round"></span>
                        </label>
                      </td>
                      <td><button type="button" class="btn btn-info btn-xs" onclick="open_edit_ser('<?=$servicio->id?>','<?=$servicio->titulo?>','<?=$servicio->descripcion?>')">Modificar</button></td>
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

<!-- Modal -->
<div class="modal fade" id="modal_edit_ser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar servicio</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/Servicio/editarServicio">
          <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="titulo_ser" name="titulo">
            </div>
          </div>
          <div class="form-group">
            <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control" id="descripcion_ser" name="descripcion" rows="5"></textarea>
            </div>
          </div>
          <input type="hidden" id="id_ser" name="id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
