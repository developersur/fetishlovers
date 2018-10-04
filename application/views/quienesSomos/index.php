<div class="container" id="menuadmin">
    <div class="row">
        <div class="col-sm-9 col-md-9 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">¿Quiénes somos?</div>
                <div class="panel-body">
                <?php
                  if($quienesSomos)
                  {
                    foreach ($quienesSomos as $quien)
                    {
                    ?>
                      <?php echo $quien->descripcion; ?>
                    <?php
                    }
                  } ?>
                </div>
            </div>
        </div>
    </div>
</div>