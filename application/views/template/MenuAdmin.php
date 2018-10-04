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
                <li><a href="<?php echo base_url(); ?>index.php/Categoria/viewCategorias">Listar</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/Categoria/addCategoria">Agregar</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/Categoria/modCategoria">Modificar</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Banner
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
                <li><a href="<?php echo base_url(); ?>index.php/QuienesSomos/viewQuienesSomos">Quienes somos</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/MisDatos/viewDatos">Mis datos</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </nav>
</div>
