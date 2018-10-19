

<div class="container" id="carrito_compra">

<?php //echo var_dump($this->cart->contents()); ?>
<div id="resultados"></div>

<div class="row">
    <div class="col-md-9 col-md-offset-3">
    <div class="pasos">
        <a href="<?php echo base_url(); ?>index.php/Carro/Paso1">Paso 1 - Complete su información</a> 
        <a href="<?php echo base_url(); ?>index.php/Carro/Paso2">Paso 2 - Datos de la Instalación</a>
        <span>Paso 3</span>
    </div>
    <fieldset>
    <legend class="text-center header titulo">Pago Proceso</legend>
            
        <?php if(isset($error) and $error!="") { ?>
            <h4>Atención</h4>
            <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i>
                <?php echo $error; ?>
            </div>
        <?php } ?>





        <?php if(isset($mensaje) and $mensaje!="") { ?>
            <h4>Resultado</h4>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i>
                <?php echo $mensaje; ?>
            </div>

            <?php if(isset($correo_ok) and $correo_ok==TRUE) { ?>
                <div class="alert alert-success"><i class="fa fa-check-circle"></i>
                    Su ha enviado un correo con los detalles de su compra
                </div>
            <?php } ?>

            <?php if(isset($correo_ok) and $correo_ok==FALSE) { ?>
                <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i>
                    Error al enviar el correo con los detalles de la compra
                </div>
            <?php } ?>

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