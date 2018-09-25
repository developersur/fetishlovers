<div class="container" id="contenedor_quienessomos">
    <div class="row">
        <div class="col-md-12">
        <fieldset>
            <legend class="text-center header">¿Quiénes somos?</legend>

             <?php
            if($quienessomos)
            {
                foreach ($quienessomos->result() as $quienes)
                {
                    if($quienes->id == 1)
                    {
                    ?>
                        <div class="col-md-12">
                    <?php
                    }else{
                    ?>
                        <div class="col-md-6">
                    <?php
                    }
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo $quienes->titulo; ?></div>
                        <div class="panel-body">
                            <p>
                            <?php echo $quienes->descripcion; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                }
            } ?>
        </fieldset>
        </div>
    </div>
</div>
