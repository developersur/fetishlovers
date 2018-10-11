 
    // Carga los datos del carrito de la cabecera
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "index.php/Carro/Mostrar",
            success:function(data){
                //alert(data);
                //$("#carrito_cabecera").html(data);
                //alert(data);
                //$("#carro_de_compras").html(data);
            }
        });
    });



    // Agrega el producto via Ajax
    $(document).ready(function() {

        // Al enviar el form "Agregar producto"
        $(document).on('submit','form.Form_Agregar',function(e){
            e.preventDefault();

            // Serializa los valores recibidos para enviarlos por Ajax
            var cadena = $(this).serialize();
            
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: cadena,
                success:function(data){
                    //alert(data);
                    $("#carrito_cabecera").html(data);
                    //alert(data);
                    //$("#carro_de_compras").html(data);
                }
            });
        });
    });

    // Actualiza la cantidad en la sesion del carrito
    $(document).ready(function() {
        $(".InputCantidad").change(function(e){
            e.preventDefault();

            // Recibe los datos
            var rowid             = $(this).attr("rowid");  // Identificador del producto en la sesion
            var action            = $(this).attr("action"); // URL que actualiza via AJAX
            var cantidad_producto = $(this).val();          // Cantidad nueva

            // Envia la Cantidad para actualizarla en la session del carrito
            $.ajax({
                type: "POST",
                url: action,
                data: { rowid:rowid, cantidad_producto:cantidad_producto},
                success:function(data){
                    //alert(data);
                    //$(".TotalCompraPrecio").html(data).formatCurrency({ region:'es-CL', roundToDecimalPlace:-1 });
                }
            })

        });
    });



    // Elimina un producto de la sesion del carrito
    $(document).ready(function() {
        $(document).on("click",".Quitar", function (e) {
            e.preventDefault();

            // Recibe los datos
            var rowid  = $(this).attr("rowid");  // Identificador del producto en la sesion
            var action = $(this).attr("action"); // URL que quita el producto via AJAX

            // Envia la Cantidad para actualizarla en la session del carrito
            $.ajax({
                type: "POST",
                url: action,
                data: { rowid:rowid},
                success:function(data){
                    location.reload();
                    //alert(data);
                    //$(".TotalCompraPrecio").html(data).formatCurrency({ region:'es-CL', roundToDecimalPlace:-1 });
                }
            })

        });
    });




    // Elimina un producto de la sesion del carrito desde la cabecera 
    $(document).ready(function() {
        $(document).on("click",".QuitarCabecera", function (e) {
            e.preventDefault();

            // Recibe los datos
            var rowid  = $(this).attr("rowid");  // Identificador del producto en la sesion
            var action = $(this).attr("action"); // URL que quita el producto via AJAX

            // Envia la Cantidad para actualizarla en la session del carrito
            $.ajax({
                type: "POST",
                url: action,
                data: { rowid:rowid},
                success:function(data){
                    $("#carrito_cabecera").html(data);
                    //location.reload();
                    //alert(data);
                    //$(".TotalCompraPrecio").html(data).formatCurrency({ region:'es-CL', roundToDecimalPlace:-1 });
                }
            })

        });
    });


    