
<div class="container" id="menuadmin">
    <div class="row">
        <div class="">
            <?php $this->load->view('template/MenuAdmin'); ?>
        </div>
        <div class="col-sm-9 col-md-9 col-md-offset-3">
          <fieldset>
          <legend class="text-center header">Agregar banner</legend>
              <div class="panel panel-default">
                  <div class="panel-body">
                        <?php
                        if(isset($error))
                        {
                            echo '<div class="alert alert-danger" role="alert">'.$error['error'].'</div>';
                        }
                        if(isset($exito))
                        {
                            echo '<div class="alert alert-success" role="alert">'.$exito['exito'].'</div>';
                        }
                        ?>
                      <form method="post" action="<?php echo base_url(); ?>index.php/Banner/AgregarBanner" enctype="multipart/form-data">
                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="habilitado">Habilitado<font color="red">*</font></label>
                                  <select name="habilitado" id="habilitado" class="form-control" required>
                                      <option value="1">Si</option>
                                      <option value="0">No</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="imagen">Imagen<font color="red">*</font></label>
                                  <input id="imagen" name="imagen" type="file" class="form-control"required/>
                              </div>
                          </div>

                          <div class="">
                              <div class="col-md-12">
                                  <input type="submit" class="btn btn-primary" value="Enviar">
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </fieldset>
        </div>
    </div>
</div>
