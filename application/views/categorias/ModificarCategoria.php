<script>
  function open_edit_cat(id, nombre, descripcion)
  {
    $('#nombre_cat').val(nombre);
    $('#descripcion_cat').val(descripcion);
    $('#id_cat').val(id);

    $('#modal_edit_cat').modal('show');
  }

  $(document).ready( function () {
      $('#mod_categoria').DataTable({
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

   function habilita_cat(id, cod)
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
        url: "<?php echo base_url(); ?>index.php/Categoria/updateHabilitado",
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
          <legend class="text-center header">Modificar categorías</legend>
              <div class="table-responsive">
              <table id="mod_categoria" class="table table-bordered table-condensed">
                <thead class="cabecera_dark">
                  <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Habilitado</th>
                    <th>Modificar</th>
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
                      <td>
                        <label class="switch">
                            <?php if($categoria->habilitado == 'Si')
                            {
                            ?>
                              <input type="checkbox" id="h<?=$categoria->id?>" onchange="habilita_cat('<?php echo 'h'.$categoria->id;?>', '<?=$categoria->id;?>');" checked>
                            <?php
                            }else{?>
                              <input type="checkbox" id="h<?=$categoria->id?>" onchange="habilita_cat('<?php echo 'h'.$categoria->id;?>', '<?=$categoria->id;?>');">
                            <?php
                            }
                            ?>
                            <span class="slider round"></span>
                        </label>
                      </td>
                      <td><button type="button" class="btn btn-info btn-xs" onclick="open_edit_cat('<?=$categoria->id?>','<?=$categoria->nombre?>','<?=$categoria->descripcion?>')">Modificar</button></td>
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
<div class="modal fade" id="modal_edit_cat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar categoria</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/Categoria/editarCategoria">
          <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nombre_cat" name="nombre">
            </div>
          </div>
          <div class="form-group">
            <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control" id="descripcion_cat" name="descripcion" rows="3"></textarea>
            </div>
          </div>
          <input type="hidden" name="id" id="id_cat">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
