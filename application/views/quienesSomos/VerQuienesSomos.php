<script>
  function open_edit_qs(id, titulo, descripcion)
  {
    $('#titulo_qs').val(titulo);
    $('#descripcion_qs').val(descripcion);
    $('#id_qs').val(id);

    $('#modal_edit_qs').modal('show');
  }
</script>

<div class="container" id="menuadmin">
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <?php $this->load->view('template/MenuAdmin'); ?>
        </div>
        <div class="col-sm-9 col-md-9">
          <fieldset>
          <legend class="text-center header">Quienes Somos</legend>
              <div class="table-responsive">
              <table class="table table-bordered table-condensed">
                <thead class="cabecera_dark">
                  <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Editar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($quienesSomos)
                  {
                    foreach ($quienesSomos as $quien)
                    {
                    ?>
                    <tr>
                      <td><?php echo $quien->titulo; ?></td>
                      <td><?php echo $quien->descripcion; ?></td>
                      <td><button type="button" class="btn btn-info btn-xs" onclick="open_edit_qs('<?=$quien->id?>','<?=$quien->titulo?>','<?=$quien->descripcion?>')">Modificar</button></td>
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
<div class="modal fade" id="modal_edit_qs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Quienes Somos</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/QuienesSomos/editarQuienesSomos">
          <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="titulo_qs" name="titulo">
            </div>
          </div>
          <div class="form-group">
            <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control" id="descripcion_qs" name="descripcion" rows="5"></textarea>
            </div>
          </div>
          <input type="hidden" id="id_qs" name="id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
