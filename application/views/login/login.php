<script>
$(document).ready(function(){
    // Valida el Rut
    $('#rut_con').rut();
    $('#rt').rut();
});

function recuperar_pass(){
    $('.modal').modal('show')
    //$('#myModal').modal('hide')
}

function valida_rut(){
    $.ajax({
        method: "POST",
        url: "<?php echo base_url(); ?>index.php/Usuario/validaRut",
        data: $('#form_rut').serialize()
    })
    .done(function( msg ) {
        alert(msg);
    });
}
</script>

<div class="container" id="login">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Iniciar Sesión</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Registrate</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if(isset($error)){
                              echo $error;
                            }
                            ?>
                            <form id="login-form" action="<?php echo base_url(); ?>index.php/Login/login" method="post" role="form" style="display: block;">
                                <div class="form-group">
                                    <input type="email" name="username" id="username" tabindex="1" class="form-control" placeholder="Correo">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Contraseña" min="4">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Ingresar">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <!--<a href="javascript:recuperar_pass();" tabindex="5" class="forgot-password">¿Olvidaste tu contraseña?</a>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="<?php echo base_url(); ?>index.php/Admin/login" tabindex="5" class="forgot-password">Acceso administrador</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <form id="register-form" action="<?php echo base_url(); ?>index.php/Usuario/registrarUsuario" method="post" role="form" style="display: none;">
                                <div class="form-group">
                                    <input type="text" name="nombre_con" id="nombre_con" class="form-control" placeholder="Nombre completo *" class="form-control" minlength="5" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="rut_con" id="rut_con" class="form-control" placeholder="RUT" minlength="6">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono o celular" minlength="6">
                                </div>

                                <div class="form-group">
                                    <input type="email" name="correo" id="correo" class="form-control" placeholder="Email *" required>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="pass1" id="pass1" class="form-control" placeholder="Contraseña *" minlength="4" required>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Repite contraseña *" minlength="4" required>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrar">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="ModalLabel">Ingresa tu rut</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
              <form id="form_rut" class="form form-horizontal" action="javascript:valida_rut();">
                <label class="control-label" for="rt">Rut</label>
                <input class="form-control" type="text" id="rt" name="rt"><br>
                <button class="btn btn-default" type="submit">Aceptar</button>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
