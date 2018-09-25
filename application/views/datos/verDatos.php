<script>
  function open_edit_datos(id, telefono, correo, direccion)
  {
    $('#telefono_dt').val(telefono);
    $('#correo_dt').val(correo);
    $('#direccion_dt').val(direccion);
    $('#id_dt').val(id);

    $('#modal_edit_dt').modal('show');
  }
</script>

<div class="container" id="menuadmin">
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <?php $this->load->view('template/MenuAdmin'); ?>
        </div>
        <div class="col-sm-9 col-md-9">
          <fieldset>
          <legend class="text-center header">Mis datos</legend>
              <div class="table-responsive">
              <table id="ltdo_categoria" class="table table-bordered table-condensed">
                <thead class="cabecera_dark">
                  <tr>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Editar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($datos)
                  {
                    foreach ($datos->result() as $dato)
                    {
                    ?>
                    <tr>
                      <td><?php echo $dato->telefono; ?></td>
                      <td><?php echo $dato->correo; ?></td>
                      <td><?php echo $dato->direccion; ?></td>
                      <td><button type="button" class="btn btn-info btn-xs" onclick="open_edit_datos('<?=$dato->id?>','<?=$dato->telefono?>','<?=$dato->correo?>','<?=$dato->direccion?>')">Modificar</button></td>
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
<div class="modal fade" id="modal_edit_dt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/MisDatos/editarDatos">
          <div class="form-group">
            <label for="telefono" class="col-sm-2 control-label">Telefono</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="telefono_dt" name="telefono">
            </div>
          </div>
          <div class="form-group">
            <label for="correo" class="col-sm-2 control-label">Correo</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="correo_dt" name="correo">
            </div>
          </div>
          <div class="form-group">
            <label for="direccion" class="col-sm-2 control-label">Dirección</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="direccion_dt" name="direccion">
            </div>
          </div>
          <input type="hidden" id="id_dt" name="id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
