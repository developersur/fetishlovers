<div class="container" id="contenedor_servicio">
    <div class="row">
        <div class="col-md-12">
        <fieldset>
            <legend class="text-center header">Nuestros servicios disponibles</legend>


            <?php
            if($servicios)
            {
                foreach ($servicios->result() as $servicio)
                {
                ?>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading"><?php echo $servicio->titulo; ?></div>
                                <div class="panel-body">
                                    <p>
                                    <?php
                                        echo $servicio->descripcion;
                                    ?>
                                    </p>
                                    <p><a href="#">Ver más</a></p>
                                </div>
                            </div>
                        </div>
                <?php
                }
            }?>
        </fieldset>
        </div>
    </div>
</div>
