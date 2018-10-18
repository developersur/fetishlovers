<div class="container" id="form-contacto">
    <div class="row">
        <div class="col-md-9 col-md-offset-3">
            <fieldset>
            <legend class="text-center header">Ingresa tus datos</legend>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                           <form id="register-form" action="<?php echo base_url(); ?>index.php/Usuario/registrarUsuario" method="post" role="form">
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
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-info" value="Registrar">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
