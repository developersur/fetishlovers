<script type="text/javascript">
   
    $(document).ready(function(){
       
        // Agrega reserva
        $(document).on("submit","#agregar", function(e) {
            e.preventDefault();
            
            var  form = $("#agregar");

            // Envia el formulario
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/Reserva/Registrar",
                data: form.serialize(),
                success:function(data){
                    switch(data) {
                        case "ok": 
                            location.reload();  
                            break;
                        default:
                            alert("Error");
                            break;
                    }
                }
            });                  
        })

        // Eliminar reserva 
        $(document).on("click",".EliminarReserva", function(e) {
            e.preventDefault();
            
            var  id_reserva = $(this).data("idreserva");

            // Envia el formulario
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/Reserva/Eliminar",
                data: {id_reserva:id_reserva},
                success:function(data){
                    switch(data) {
                        case "ok": 
                            location.reload();  
                            break;
                        default:
                            alert("Error");
                            break;
                    }
                }
            });                  
        })

        
    })
</script>


<div class="container" id="menuadmin">
    <div class="row">
        
        <!-- Menu Izquierdo Usuario -->
        <div class="col-sm-3 col-md-3">
            <?php $this->load->view('template/MenuAdmin'); ?>
        </div>
        
        <!-- Contenido Cliente -->
        <div class="col-sm-9 col-md-9">

          <fieldset>
          <legend class="text-center header">Reservar hora manualmente</legend>
            <form id="agregar" name="agregar" action="" method="POST">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="fecha_visita">Fecha <span class="obligatorio">*</span></label>
                            <input type="text" class="form-control" id="fecha_visita" name="fecha_visita" placeholder="Fecha" autocomplete="off" required="true">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="hora_visita">Hora <span class="obligatorio">*</span></label>
                            <input type="text" class="form-control" id="hora_visita" name="hora_visita" readonly="true" placeholder="Hora" style="visibility: hidden;" autocomplete="off" required="true">
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="observacion">Observación</label>
                            <input id="observacion" name="observacion" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="costo">Acción</label>
                            <input type="submit" id="enviar" name="enviar" class="form-control" value="Guardar">
                        </div>                      
                    </div>                      
                </div> 
            </form>                            
          </legend>       


          <fieldset>
          <legend class="text-center header">Listado de Reservas Manuales</legend>
              <table id="ltdo_compra" class="table table-bordered">
                <thead class="cabecera_dark">
                  <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Observación</th>
                    <th>ID Compra</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>

                <?php if($reservas) { ?>
                    <?php foreach ($reservas as $reserva) {?>
                    <tr>
                      <td><?php echo date('d-m-Y', strtotime($reserva['fecha'])); ?></td>
                      <td><?php echo $reserva['hora']; ?></td>
                      <td><?php echo $reserva['observacion']; ?></td>
                      <td><?php if($reserva['id_compra']>0) { ?><a class="btn-id" href="<?php echo base_url(); ?>index.php/Compra/Detalle?id_compra=<?php echo $reserva['id_compra']; ?>">#<?php echo $reserva['id_compra']; ?></a><?php } ?></td>
                      <td><?php if($reserva['id_compra']==0) { ?><a href="#" class="EliminarReserva btn-eliminar" data-idreserva="<?php echo $reserva['id_reserva']; ?>">Eliminar</a><?php } ?></td>
                    </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                      <td colspan="3">No se han encontrado reservas</td>
                    </tr>
                <?php } ?>
                </tbody>
              </table>
          </fieldset>

        </div>
    </div>
</div>


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
                        // Hora seleccionada
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

        
<!-- Selector de Region y Comuna -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/RegionesYcomunas.js"></script>