<div class="container" id="form-contacto">
    <div class="row">
        <div class="col-md-9 col-md-offset-3">
            <fieldset>
            <legend class="text-center header">Contactanos</legend>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                          <?php
                            echo validation_errors();
                            $attributes = array('id' => 'contacto-form', 'class' => 'form-horizontal');
                            echo form_open('Contacto/enviar_correo', $attributes);
                          ?>
                            <!--<form class="form-horizontal" method="post">-->
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-user bigicon"></i></span>
                                        <div class="col-md-9">
                                            <input id="name" name="name" type="text" placeholder="Nombre" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-user bigicon"></i></span>
                                        <div class="col-md-9">
                                            <input id="apellido" name="apellido" type="text" placeholder="Apellidos" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-envelope bigicon"></i></span>
                                        <div class="col-md-9">
                                            <input id="email" name="email" type="email" placeholder="Email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                                        <div class="col-md-9">
                                            <input id="phone" name="phone" type="text" placeholder="Celular" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-comment bigicon"></i></span>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="message" name="message" placeholder="Ingresa tu mensaje y te contactaremos." rows="7"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-2 ">
                                            <button id="btn_enviar" type="submit" class="btn btn-primary btn-lg form-control">Enviar</button>
                                        </div>
                                    </div>
                            <?php
                            echo $this->session->mensaje_email;
                            echo form_close();
                            ?>
                            <!--</form>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="list-links">
                                <?php
                                $datos = $this->DatosModel->obtenerDatos();
                                foreach($datos->result() as $dato)
                                {
                                    echo '<i class="fa fa-mobile"></i>&nbsp;+56'.$dato->celular.'<br>';
                                    echo '<i class="fa fa-phone"></i>&nbsp;'.$dato->telefono.'<br>';
                                    echo '<i class="fa fa-envelope"></i>&nbsp;'.$dato->correo.'<br>';
                                    echo '<i class="fa fa-home"></i>&nbsp;'.$dato->direccion.'<br>';
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
