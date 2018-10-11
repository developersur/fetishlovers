
<?php

    // Carga Modelo
    $cs = &get_instance();
    $cs->load->model("CostoComunaModel");

    $comunas        = $cs->CostoComunaModel->ListarComunasMostrar();
    $regiones       = $cs->CostoComunaModel->ListarRegionesMostrar();
        
    $total_comunas  = count($comunas);
    $total_regiones = count($regiones);
?>


<script type="text/javascript">

    var RegionesYcomunas = {
        "regiones": [
        <?php if($total_regiones>0) { ?>
            <?php $contador = -1; ?>
            <?php foreach ($regiones as $region) { ?>
                <?php $contador++; ?>
                {
                    "NombreRegion": "<?php echo $region['region']; ?>",
                    
                    <?php $i = 0; ?>
                    <?php if($total_comunas>0) {  ?>
                        "comunas": [
                            <?php foreach ($comunas as $comuna) { ?>
                                <?php if($comuna['region']==$region['region']) { ?>
                                    "<?php echo $comuna['comuna'] ?>",
                                    <?php $i++; ?>
                                <?php } ?>
                            <?php } ?>
                         ], 

                         <?php $i = 0; ?>
                         "costo": [
                            <?php foreach ($comunas as $costo) { ?>
                                <?php if($costo['region']==$region['region']) { ?>
                                    "<?php echo $costo['costo'] ?>",
                                    <?php $i++; ?>
                                <?php } ?>
                            <?php } ?>
                         ]
                    <?php } ?>
                } <?php if($contador<$total_regiones) echo ","; ?>
            
            <?php } ?>
        <?php } ?>
    ]
    }



    jQuery(document).ready(function () {

        var iRegion = 0;
        var htmlRegion = '<option value="">Seleccione región</option>';
        var htmlComunas = '<option value="">Seleccione comuna</option>';

        jQuery.each(RegionesYcomunas.regiones, function () {
            htmlRegion = htmlRegion + '<option value="' + RegionesYcomunas.regiones[iRegion].NombreRegion + '">' + RegionesYcomunas.regiones[iRegion].NombreRegion + '</option>';
            iRegion++;
        });

        jQuery('.regiones').html(htmlRegion);
        jQuery('.comunas').html(htmlComunas);

        jQuery('.regiones').change(function () {
            var iRegiones = 0;
            var valorRegion = jQuery(this).val();
            var htmlComuna = '<option value="">Seleccione comuna</option>';
            jQuery.each(RegionesYcomunas.regiones, function () {
                if (RegionesYcomunas.regiones[iRegiones].NombreRegion == valorRegion) {
                    var iComunas = 0;
                    jQuery.each(RegionesYcomunas.regiones[iRegiones].comunas.sort(), function () {
                        htmlComuna = htmlComuna + '<option value="' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '" data-costo="' + RegionesYcomunas.regiones[iRegiones].costo[iComunas] + '">' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '</option>';
                        iComunas++;
                    });
                }
                iRegiones++;
            });
            jQuery('.comunas').html(htmlComuna);
        });

    });

</script>