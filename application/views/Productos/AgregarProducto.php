<div class="container" id="menuadmin">
    <div class="row">
        <div class="">
            <?php $this->load->view('template/MenuAdmin'); ?>
        </div>
        <div class="col-sm-9 col-md-9 col-md-offset-3">
          <fieldset>
          <legend class="text-center header">Agregar producto</legend>
              <div class="panel panel-default">
                  <div class="panel-body">
                        <?php
                        if(isset($error))
                        {
                            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                        }
                        if(isset($exito))
                        {
                            echo '<div class="alert alert-success" role="alert">'.$exito.'</div>';
                        }
                        ?>
                      <form method="post" action="<?php echo base_url(); ?>index.php/Producto/AgregarProducto" enctype="multipart/form-data">
                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="codigo">Código<font color="red">*</font></label>
                                  <input id="codigo" name="codigo" type="text" placeholder="Código" class="form-control" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="codigo">Nombre<font color="red">*</font></label>
                                  <input id="nombre" name="nombre" type="text" placeholder="Nombre" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="codigo">Descripción</label>
                                  <input id="descripcion" name="descripcion" type="text" placeholder="Descripción" class="form-control">
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="codigo">Precio<font color="red">*</font></label>
                                  <input id="precio" name="precio" type="number" placeholder="Precio" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="descuento">% Descuento</label>
                                  <input id="descuento" name="descuento" type="number" placeholder="% Descuento" class="form-control">
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="marca">Marca</label>
                                  <input id="marca" name="marca" type="text" placeholder="Marca" class="form-control">
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="cantidad">Cantidad</label>
                                  <input id="cantidad" name="cantidad" type="text" placeholder="Cantidad" class="form-control">
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="habilitado">Habilitado<font color="red">*</font></label>
                                  <select name="habilitado" id="habilitado" class="form-control" required>
                                      <option value="Si">Si</option>
                                      <option value="No">No</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="nuevo">Nuevo<font color="red">*</font></label>
                                  <select name="nuevo" id="nuevo" class="form-control" required>
                                      <option value="Si">Si</option>
                                      <option value="No">No</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="categoria">Categoria<font color="red">*</font></label>
                                  <select name="categoria" id="categoria" class="form-control" required>
                                      <?php
                                      if(isset($categorias)){
                                        foreach($categorias->result() as $categoria)
                                        {
                                        ?>
                                        <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
                                        <?php
                                        }
                                    }?>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6">
                                  <label class="control-label" for="imagen">Imagen<font color="red">*</font></label>
                                  <input id="imagen" name="imagen[]" type="file" class="form-control" multiple required/>
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
