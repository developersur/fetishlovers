<div class="col-md-9 col-md-offset-3">
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Compras
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="#">Listado de compras</a></li>
                <li><a href="#">Costos de envío</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Productos
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>index.php/Producto/viewProductos">Listar</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/Producto/formProducto">Agregar</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/Producto/modProducto">Modificar</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categorías
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="#">Listar</a></li>
                <li><a href="#">Agregar</a></li>
                <li><a href="#">Modificar</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Otros
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="#">Nosotros</a></li>
                <li><a href="#">Mis datos</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </nav>
</div>
<!--<div class="panel-group" id="accordion">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven"><span class="">
                            </span>Compras</a>
                        </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/Compra/Listar">Listado de compras</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/Comuna/Listar">Costo por Comuna</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/Reserva/Listar">Reserva de Horas</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="">
                            </span>Productos</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/Producto/viewProductos">Listar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/Producto/formProducto">Agregar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/Producto/modProducto">Modificar</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="">
                            </span>Categorías</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/Categoria/viewCategorias">Listar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/Categoria/addCategoria">Agregar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/Categoria/modCategoria">Modificar</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="">
                            </span>Servicios</a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/Servicio/viewServicios">Listar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/Servicio/addServicio">Agregar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/Servicio/modServicio">Modificar</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix"><span class="">
                            </span>Otros</a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class=""></span><a href="">Ventas</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/QuienesSomos/viewQuienesSomos">Quienes somos</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=""></span><a href="<?php echo base_url(); ?>index.php/MisDatos/viewDatos">Mis datos</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
-->
