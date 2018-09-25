
<script type="text/javascript">

// Muestra campos para facturacion
$(document).ready(function () {
    $("#tipo").change(function(e){
        var tipo = $(this).val();
        if(tipo=="Factura"){
            $(".contenedor_facturacion").show();
        } else {
            $(".contenedor_facturacion").hide();
        }
    })
});


// Muestra regiones y comunas
$(document).ready(function () {
    
    jQuery('.comunas').change(function () {
        if (jQuery(this).val() == '') {
            $("#nombre_comuna").html('');
            $("#costo_visita").val('0');
        } else {
            var costo_visita = $(this).find(':selected').data('costo');
            $("#nombre_comuna").html(jQuery(this).val());
            $("#costo_visita").val(costo_visita);
        }
    });

    jQuery('.regiones').change(function () {
        if (jQuery(this).val() == '') {
        }
    });
});

    // Validad el Formulario por PHP
    $(document).ready(function () {
        

        $(document).on("click","#Enviar", function (e) {
            e.preventDefault();
            var  form = $("#Formulario");

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Carro/Validar_Paso_2",
                type: "POST",
                data: form.serialize(),
                success:function(data){
                    switch (data) {
                        // Todo bien, envia el formulario
                        case '1':
                            $(".mensaje_validacion").html("");
                            form.submit();
                            break;
                        // Existen errores, los muestra
                        default:
                            $(".mensaje_validacion").html(data);
                            break;
                    }
                }
            })
        });
    });

</script>
        <?php 
            $total_reservas = count($reservas);
            if($total_reservas>0) {
                $r = true;
                foreach ($reservas as $valor) {
                   $fechasarray[] = date('d-m-Y', strtotime($valor['fecha']));
                   $horasarray[]  = $valor['hora'];
                }
            } else {
                $r = false;
            }

            if($r==true) {
                $fechas = implode('","', $fechasarray);
                $horas  = implode('","', $horasarray);
            }

        ?>


        <script type="text/javascript">
             $(document).ready(function () {
                
                var hora_reservada = "";
                
				// Calendario con hora
                jQuery.datetimepicker.setLocale('es');
                $("#fecha_visita").datetimepicker({
                    timepicker:false,
                    format:'d-m-Y',
                    formatDate:'d-m-Y',
                    minDate:'+1970/01/02',
                    //disabledDates: [
                    //    "<?php echo $fechas; ?>"
                    //],
                    onSelectDate:function(){
                        var fecha_seleccionada = $("#fecha_visita").val();
                        $("#hora_visita").css("visibility","hidden")
                        $("#hora_visita").val("")
                        
                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/Reserva/HorasReservadas",
                            type: "POST",
                            dataType: 'json',
                            data: {fecha_seleccionada:fecha_seleccionada},
                            success:function(hora){
                                hora_reservada = hora;
                                $("#hora_visita").css("visibility","visible")

                            }
                        })
                    }
                });

                                    
                $("#hora_visita").datetimepicker({
                    datepicker:false,
                    format:'H:i',
                    allowTimes:[
                        '08:00', '10:00', '12:00', '14:00', '16:00', '18:00'
                    ],
                    onSelectTime:function(){
                        var hora_seleccionada = $("#hora_visita").val();
                        // Recorre las horas reservadas de la fecha en forma de ciclo pues puede ser mas de una
                        $.each(hora_reservada, function (ind, elem) { 
                            
                            // Asigna la hora y verifica que no sea la que el se selecciono
                            hora_reservada_ciclo = elem;
                            if(hora_seleccionada==hora_reservada_ciclo) {
                                $.alert({
                                    title: 'Disculpe',
                                    content: "La hora "+hora_reservada_ciclo+" para la fecha " +$("#fecha_visita").val()+" ya se encuentra reservada, seleccione una hora diferente"
                                });
                                $("#hora_visita").val("");
                            }
                        });
                    }
                });                   

    		});
        </script>         
    
    
<?php if(isset($_SESSION['datos_sesion'])) $datasesion = $_SESSION['datos_sesion']; ?>

<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function() {
            $(".regiones option[value='<?php echo $datasesion['region_dir']; ?>']").prop('selected', true);
                jQuery('.regiones').change();
                $(".comunas option[value='<?php echo $datasesion['comuna_dir']; ?>']").prop('selected', true);
                
                var costo_visita = $(".comunas").find(':selected').data('costo');
                $("#nombre_comuna").html('<?php echo $datasesion['comuna_dir']; ?>');
                $("#costo_visita").val(costo_visita);

        }, 500)
    });
</script>

                
        
<div class="container" id="contenedor_quienessomos">


<div id="resultados"></div>

<div class="row">
    <div class="col-md-12">
    <div class="pasos">
        <a href="<?php echo base_url(); ?>index.php/Carro/Paso1">Paso 1 - Complete su información</a>
        <span>Paso 2</span>
    </div>

    <fieldset>
    <legend class="text-center header titulo">Paso 2 - Datos de la Instalación</legend>
        
        <div class="mensaje_validacion"></div>  
        
        <div class="contenido_formulario">
            <form action="<?php echo base_url(); ?>index.php/Carro/Paso3" method="POST" id="Formulario">
                <div class="row">
                    <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="region_dir">Región <span class="obligatorio">*</span></label>
                                    <select id="region_dir" name="region_dir" class="form-control regiones"></select>
                                </div>
                                <div class="form-group">
                                    <label for="sector_dir">Sector <span class="obligatorio">*</span></label>
                                    <input type="text" class="form-control" id="sector_dir" name="sector_dir" value="<?php if(isset($datasesion)) echo $datasesion['sector_dir']; ?>" placeholder="Sector">
                                </div>
                                <div class="form-group">
                                    <label for="indicaciones_dir">Indicaciones</label>
                                    <input type="text" class="form-control" id="indicaciones_dir" name="indicaciones_dir" value="<?php if(isset($datasesion)) echo $datasesion['indicaciones_dir']; ?>" placeholder="Indicaciones">
                                </div>
                            </div>    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="comuna_dir">Comuna <span class="obligatorio">*</span></label>
                                    <select id="comuna_dir" name="comuna_dir" class="form-control comunas"></select>
                                </div>
                                <div class="form-group">
                                    <label for="calle_dir">Calle <span class="obligatorio">*</span></label>
                                    <input type="text" class="form-control" id="calle_dir" name="calle_dir" value="<?php if(isset($datasesion)) echo $datasesion['calle_dir']; ?>" placeholder="Calle">
                                </div>
                                <div class="form-group">
                                    <label for="fecha_visita">Fecha de visita</label>
                                    <input type="text" class="form-control" id="fecha_visita" name="fecha_visita" value="<?php if(isset($datasesion)) echo $datasesion['fecha_visita']; ?>" placeholder="Fecha">
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="costo_visita"><?php echo $this->config->item('nombre_costo_visita'); ?> <span id='nombre_comuna'></span> $</label>
                                    <input type="text" class="form-control" id="costo_visita" name="costo_visita" value="" placeholder="Costo visita" readonly="TRUE">
                                </div>
                                <div class="form-group">
                                    <label for="nro_calle_dir">Número <span class="obligatorio">*</span></label>
                                    <input type="text" class="form-control" id="nro_calle_dir" name="nro_calle_dir" value="<?php if(isset($datasesion)) echo $datasesion['nro_calle_dir']; ?>" placeholder="Nro Calle">
                                </div>
                                <div class="form-group">
                                    <label for="hora_visita">Hora de visita</label>
                                    <input type="text" readonly="true" autocomplete="off" class="form-control" id="hora_visita" name="hora_visita" value="<?php if(isset($datasesion)) echo $datasesion['hora_visita']; ?>" placeholder="Hora" style="visibility: hidden;">
                                </div>
                            </div>
                    </div>

                    <div class="col-md-12">
                        <legend class="text-center header titulo">Método de Pago <span class="obligatorio">*</span></legend>
                                <!-- WEBPAY -->
                                <div class="col-md-4">
                                    <div class="form-group boton_webpay_form">
                                        <label>WebPay</label><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="metodo_pago" id="metodo_pago" value="WEBPAY" <?php if(isset($datasesion) and ($datasesion['metodo_pago']=="WEBPAY")) echo "checked"; ?>> <img src="<?php echo base_url(); ?>/assets/img/icono_webpay.png" width="200px">
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- TRANSFERENCIAS -->
                                <div class="col-md-4">
                                    <div class="form-group boton_webpay_form">
                                        <label>Transferencias</label><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="metodo_pago" id="metodo_pago" value="TRANSFERENCIA" <?php if(isset($datasesion) and ($datasesion['metodo_pago']=="TRANSFERENCIA")) echo "checked"; ?>> 
                                            <img src="<?php echo base_url(); ?>/assets/img/icono_transferencia.png" width="120px">
                                            <b>5% de descuento</b>
                                        </label>
                                    </div>
                                </div>
                        </div>


                        <input type="hidden" name="tipo"          value="<?php if(isset($datasesion)) echo $datasesion['tipo']; ?>">
                        <input type="hidden" name="nombre_con"    value="<?php if(isset($datasesion)) echo $datasesion['nombre_con']; ?>">
                        <input type="hidden" name="rut_con"       value="<?php if(isset($datasesion)) echo $datasesion['rut_con']; ?>">
                        <input type="hidden" name="correo_con"    value="<?php if(isset($datasesion)) echo $datasesion['correo_con']; ?>">
                        <input type="hidden" name="telefono_con"  value="<?php if(isset($datasesion)) echo $datasesion['telefono_con']; ?>">
                        <input type="hidden" name="rut_fac"       value="<?php if(isset($datasesion)) echo $datasesion['rut_fac']; ?>">
                        <input type="hidden" name="razon_fac"     value="<?php if(isset($datasesion)) echo $datasesion['razon_fac']; ?>">
                        <input type="hidden" name="giro_fac"      value="<?php if(isset($datasesion)) echo $datasesion['giro_fac']; ?>">
                        <input type="hidden" name="telefono_fac"  value="<?php if(isset($datasesion)) echo $datasesion['telefono_fac']; ?>">
                        <input type="hidden" name="correo_fac"    value="<?php if(isset($datasesion)) echo $datasesion['correo_fac']; ?>">
                        <input type="hidden" name="region_fac"    value="<?php if(isset($datasesion)) echo $datasesion['region_fac']; ?>">
                        <input type="hidden" name="comuna_fac"    value="<?php if(isset($datasesion)) echo $datasesion['comuna_fac']; ?>">
                        <input type="hidden" name="sector_fac"    value="<?php if(isset($datasesion)) echo $datasesion['sector_fac']; ?>">
                        <input type="hidden" name="calle_fac"     value="<?php if(isset($datasesion)) echo $datasesion['calle_fac']; ?>">
                        <input type="hidden" name="nro_calle_fac" value="<?php if(isset($datasesion)) echo $datasesion['nro_calle_fac']; ?>">
                        


                        <div class="col-md-12">
                            <button type="submit" class="btn btn-default" id="Enviar">Continuar</button>
                        </div> 
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>



                </div>
            </form>
        </div>
    </fieldset>
    </div>
</div>
</div>


<!-- Selector de Region y Comuna -->
<?php require_once('assets/js/RegionesYcomunasBioBio.php'); ?>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/RegionesYcomunasBioBio.js"></script>  -->
