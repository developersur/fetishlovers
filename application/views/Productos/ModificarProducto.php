<script>
  function open_edit_prod(id, nombre, descripcion, precio){
    $('#nombre_prod_edit').val(nombre);
    $('#descripcion_prod_edit').val(descripcion);
    $('#precio_prod_edit').val(precio);
    $('#id_prod_edit').val(id);

    $('#modal_edit_prod').modal('show');
  }

  function habilita_prod(id, cod)
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
        url: "<?php echo base_url(); ?>index.php/Producto/updateHabilitado",
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

  function nuevo_prod(id, cod)
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
        url: "<?php echo base_url(); ?>index.php/Producto/updateNuevo",
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

  $(document).ready( function () {
      $('#mod_producto').DataTable({
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
          <legend class="text-center header">Modificar producto</legend>
              <div class="table-responsive">
              <table id="mod_producto" class="table table-bordeder">
                <thead class="cabecera_dark">
                  <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Habilitado</th>
                    <th>Nuevo</th>
                    <th>Imagen</th>
                    <th>Modificar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($productos)
                  {
                    foreach ($productos->result() as $producto)
                    {
                    ?>
                    <tr>
                      <td><?php echo $producto->nombre; ?></td>
                      <td><?php echo $producto->descripcion; ?></td>
                      <td><?php echo $producto->precio; ?></td>
                      <td>
                        <label class="switch">
                          <?php if($producto->habilitado == 'Si')
                          {
                          ?>
                            <input type="checkbox" id="h<?=$producto->id_producto?>" onchange="habilita_prod('<?php echo 'h'.$producto->id_producto;?>', '<?=$producto->id_producto;?>');" checked>
                          <?php
                          }else{?>
                            <input type="checkbox" id="h<?=$producto->id_producto?>" onchange="habilita_prod('<?php echo 'h'.$producto->id_producto;?>', '<?=$producto->id_producto;?>');">
                          <?php
                          }
                          ?>
                          <span class="slider round"></span>
                        </label>
                      </td>
                      <td>
                        <label class="switch">
                          <?php if($producto->nuevo == 'Si')
                          {
                          ?>
                            <input type="checkbox" id="n<?=$producto->id_producto?>" onchange="nuevo_prod('<?php echo 'n'.$producto->id_producto;?>', '<?=$producto->id_producto;?>');" checked>
                          <?php
                          }else{?>
                            <input type="checkbox" id="n<?=$producto->id_producto?>" onchange="nuevo_prod('<?php echo 'n'.$producto->id_producto;?>', '<?=$producto->id_producto;?>');">
                          <?php
                          }
                          ?>
                          <span class="slider round"></span>
                        </label>
                      </td>
                      <td><img src="<?php echo $producto->imagen; ?>" alt="" width="30" height="30"></td>
                      <td><button type="button" class="btn btn-info btn-xs" onclick="open_edit_prod('<?=$producto->id_producto?>','<?=$producto->nombre?>','<?=$producto->descripcion?>','<?=$producto->precio?>')">Modificar</button></td>
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
<div class="modal fade" id="modal_edit_prod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar producto</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/Producto/editarProducto">
          <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text"  minlength=2 maxlength=100 class="form-control" id="nombre_prod_edit" name="nombre" required>
            </div>
          </div>
          <div class="form-group">
            <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">
              <textarea minlength=2 maxlength=500 class="form-control" id="descripcion_prod_edit" name="descripcion" rows="3" required></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="precio" class="col-sm-2 control-label">Precio</label>
            <div class="col-sm-10">
              <input type="number" minlength=1 maxlength=100 class="form-control" id="precio_prod_edit" name="precio" required>
            </div>
          </div>
          <input type="hidden" name="id" id="id_prod_edit">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
