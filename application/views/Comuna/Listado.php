
<script type="text/javascript">


    $(document).ready(function(){

        // Habilita o no mostrar una comuna
        $(document).on("change",".cambiar_mostrar",function(e){

            var mostrar;
            var id_comuna = $(this).data('idcomuna');

            if($(this).prop('checked')) {
                mostrar = 'Si';
            } else {
                mostrar = 'No';
            }

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Comuna/Actualizar",
                type: "POST",
                data: { mostrar: mostrar, id_comuna: id_comuna },
                success:function(data){
                    //alert(data);
                }
            })
        })




        // Cambia elm costo de la comuna
        $(document).on("click",".cambiar_costo", function(e) {
            e.preventDefault();

            var id_comuna     = $(this).data("idcomuna");
            var costoanterior = $(this).data("costoanterior");

            $.confirm({
                title: 'Costo de visita a la comuna',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Costo</label>' +
                '<input class="costo form-control" value="'+costoanterior+'" required>' +
                '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Guardar',
                        btnClass: 'btn-blue',
                        action: function () {
                            var costo = this.$content.find('.costo').val();
                            if(!costo){
                                $.alert('Debe introducir el costo');
                                return false;
                            } else {
                                // Cambia el Status por AJAX
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url(); ?>index.php/Comuna/ActualizarCosto",
                                    data: {id_comuna:id_comuna,costo:costo},
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
                            }
                        }
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        })



        // Agrega nueva comuna
        $(document).on("submit","#agregar", function(e) {
            e.preventDefault();

            var  form = $("#agregar");

            // Envia el formulario
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/Comuna/Registrar",
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
          <legend class="text-center header">Registrar nueva comuna</legend>
            <form id="agregar" name="agregar" action="" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="region">Región <span class="obligatorio">*</span></label>
                            <select id="region" name="region" class="form-control regiones"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="comuna">Comuna <span class="obligatorio">*</span></label>
                            <select id="comuna" name="comuna" class="form-control comunas"></select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="costo">Comuna <span class="obligatorio">*</span></label>
                            <input id="costo" name="costo" class="form-control">
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
          <legend class="text-center header">Listado de Costo de Visita por Comuna</legend>
              <div class="table-responsive">
              <table id="ltdo_compra" class="table table-bordered">
                <thead class="cabecera_dark">
                  <tr>
                    <th>Región</th>
                    <th>Comuna</th>
                    <th>Costo</th>
                    <th>Acción</th>
                    <th>Mostrar</th>
                  </tr>
                </thead>
                <tbody>

                <?php if($comunas) { ?>
                    <?php foreach ($comunas as $comuna) {?>
                    <tr>
                      <td><?php echo $comuna['region']; ?></td>
                      <td><?php echo $comuna['comuna']; ?></td>
                      <td>$<?php echo number_format($comuna['costo'],'0',',','.'); ?></td>
                      <td><a href="#" class="cambiar_costo" data-idcomuna="<?php echo $comuna['id_comuna']; ?>" data-costoanterior="<?php echo $comuna['costo']; ?>">Cambiar</a></td>
                      <td>
                      <label class="switch">
                        <input type="checkbox" class="cambiar_mostrar" data-idcomuna="<?php echo $comuna['id_comuna']; ?>"
                            <?php if($comuna['mostrar'] == 'Si') echo "checked"; ?>
                        >
                        <span class="slider round"></span>
                      </label>
                      </td>
                    </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                      <td colspan="4">No se han encontrado comunas</td>
                    </tr>
                <?php } ?>
                </tbody>
              </table>
              </div>
          </fieldset>
        </div>
    </div>
</div>

<!-- Selector de Region y Comuna -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/RegionesYcomunas.js"></script>
