

<div class="container" id="contenedor_quienessomos">

<?php //echo var_dump($this->cart->contents()); ?>
<div id="resultados"></div>

<div class="row">
    <div class="col-md-12">
    <div class="pasos">
        <a href="<?php echo base_url(); ?>index.php/Carro/">Volver al Carrito</a> 
    </div>
    
    <fieldset>
    <legend class="text-center header titulo">Pago Proceso</legend>
            
        <?php if(isset($error) and $error!="") { ?>
            <h4>Atención</h4>
            <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i>
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <?php if(isset($mensaje) and $mensaje!="") { ?>
            <h4>Resultado</h4>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i>
                <?php echo $mensaje; ?>
            </div>
            <?php if(isset($voucher) and $voucher==TRUE) { ?>
                <form action="<?php echo $url; ?>" method="POST">
                    <input type="hidden" name="token_ws" value="<?php echo $token_ws; ?>">
                    <input type="submit" class="btn btn-primary" value="Ver Voucher">
                </form>
            <?php } ?>


        <?php } ?>

    </fieldset>
    </div>
</div>
</div>