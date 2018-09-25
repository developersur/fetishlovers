
<script type="text/javascript">
   
    // Validador de RUT
    $(document).ready(function(){
        // Valida el Rut del Logeo
        $('.input_rut').rut();
        
        /*
        $('.input_rut').rut({
             fn_error : function(input){
                //$("#Mostrar_mensajes").html('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Rut incorrecto</div>')
                //$("#Ir_Paso_2").attr("disabled",true);
                //$("#Ir_Paso_2").addClass("Btn_Con_disabled");
                $(".ocultar_obli").show();

            },
             fn_validado : function(input){
                //$("#Mostrar_mensajes").html('');
                //$("#Ir_Paso_2").attr("disabled",false);
                $("#Ir_Paso_2").removeClass("Btn_Con_disabled");
                $(".ocultar_obli").show();
            },
            placeholder: false
        });
        */
        
    });



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
                //alert('selecciones Región');
            } else if (jQuery(this).val() == '') {
                //alert('selecciones Comuna');
            }
        });

        jQuery('.regiones').change(function () {
            //alert(jQuery(this).val());
            if (jQuery(this).val() == '') {
                //alert('selecciones Región');
            }
        });
    });

    // Validad el Formulario por PHP
    $(document).ready(function () {
        $(document).on("click","#Enviar", function (e) {
            e.preventDefault();
            var  form = $("#Formulario");

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Carro/Validar_Paso_1",
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

<?php if(isset($_SESSION['datos_sesion'])) $datasesion = $_SESSION['datos_sesion']; ?>

<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function() {
            $(".regiones option[value='<?php echo $datasesion['region_fac']; ?>']").prop('selected', true);
            jQuery('.regiones').change();
            $(".comunas option[value='<?php echo $datasesion['comuna_fac']; ?>']").prop('selected', true);
            $("#tipo option[value='<?php echo $datasesion['tipo']; ?>']").prop('selected', true);
            jQuery('#tipo').change();
        }, 500)
    });
</script>
            
<div class="container" id="contenedor_quienessomos">
    <div id="resultados"></div>

    <div class="row">
        <div class="col-md-12">
        <div class="pasos">
            <span>Paso 1</span>
        </div>      
        <fieldset>
        <legend class="text-center header titulo">Paso 1 - Complete su información</legend>
            
            <div class="mensaje_validacion"></div>  
            
            <div class="contenido_formulario">
                <form action="<?php echo base_url(); ?>index.php/Carro/Paso2" method="POST" id="Formulario">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rut">Tipo de comprobante <span class="obligatorio">*</span></label>
                                    <select name="tipo" id="tipo" class="form-control">
                                        <option value="Boleta">Boleta</option>
                                        <option value="Factura">Factura</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="telefono_con">Teléfono <span class="obligatorio">*</span></label>
                                    <input type="text" class="form-control" id="telefono_con" name="telefono_con" value="<?php if(isset($datasesion)) echo $datasesion['telefono_con']; ?>" placeholder="Teléfono">
                                </div>
                            </div>    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rut_con">RUT <span class="obligatorio">*</span></label>
                                    <input type="text" class="form-control input_rut" id="rut_con" name="rut_con" value="<?php if(isset($datasesion)) echo $datasesion['rut_con']; ?>" placeholder="RUT">
                                </div>
                                <div class="form-group">
                                    <label for="correo_con">Correo <span class="obligatorio">*</span></label>
                                    <input type="text" class="form-control" id="correo_con" name="correo_con" value="<?php if(isset($datasesion)) echo $datasesion['correo_con']; ?>" placeholder="Correo">
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre_con">Nombre <span class="obligatorio">*</span></label>
                                    <input type="text" class="form-control" id="nombre_con" name="nombre_con" value="<?php if(isset($datasesion)) echo $datasesion['nombre_con']; ?>" placeholder="Nombre">
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 contenedor_facturacion" style="display:none">

                                <legend class="text-center header titulo">Datos de Facturación</legend>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="rut_fac">RUT <span class="obligatorio">*</span></label>
                                        <input type="text" class="form-control input_rut" id="rut_fac" name="rut_fac" placeholder="RUT" value="<?php if(isset($datasesion)) echo $datasesion['rut_fac']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono_fac">Teléfono <span class="obligatorio">*</span></label>
                                        <input type="text" class="form-control" id="telefono_fac" name="telefono_fac" placeholder="Teléfono" value="<?php if(isset($datasesion)) echo $datasesion['telefono_fac']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="comuna_fac">Comuna <span class="obligatorio">*</span></label>
                                        <select id="comuna_fac" name="comuna_fac" class="form-control comunas"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nro_calle_fac">Número <span class="obligatorio">*</span></label>
                                        <input type="text" class="form-control" id="nro_calle_fac" name="nro_calle_fac" placeholder="Nro Calle" value="<?php if(isset($datasesion)) echo $datasesion['nro_calle_fac']; ?>">
                                    </div>
                                </div>    
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="razon_fac">Razon Social <span class="obligatorio">*</span></label>
                                        <input type="text" class="form-control" id="razon_fac" name="razon_fac" placeholder="Razon Social" value="<?php if(isset($datasesion)) echo $datasesion['razon_fac']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="cocorreo_facrreo">Correo <span class="obligatorio">*</span></label>
                                        <input type="text" class="form-control" id="correo_fac" name="correo_fac" placeholder="Correo" value="<?php if(isset($datasesion)) echo $datasesion['correo_fac']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="sector_fac">Sector <span class="obligatorio">*</span></label>
                                        <input type="text" class="form-control" id="sector_fac" name="sector_fac" placeholder="Sector" value="<?php if(isset($datasesion)) echo $datasesion['sector_fac']; ?>">
                                    </div>
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="giro_fac">Giro <span class="obligatorio">*</span></label>
                                        <input type="text" class="form-control" id="giro_fac" name="giro_fac" placeholder="Giro" value="<?php if(isset($datasesion)) echo $datasesion['giro_fac']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="region_fac">Región <span class="obligatorio">*</span></label>
                                        <select id="region_fac" name="region_fac" class="form-control regiones"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="calle_fac">Calle <span class="obligatorio">*</span></label>
                                        <input type="text" class="form-control" id="calle_fac" name="calle_fac" placeholder="Calle" value="<?php if(isset($datasesion)) echo $datasesion['calle_fac']; ?>">
                                    </div>
                                </div> 
                                <div class="clearfix visible-xs"></div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <button type="submit" id="Enviar" class="btn btn-default">Continuar</button>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/RegionesYcomunas.js"></script>