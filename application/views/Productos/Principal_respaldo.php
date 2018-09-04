
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Productos</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Fuerza</a></li>
                            <li><a data-toggle="tab" href="#tab1">Alumbrado</a></li>
                            <li><a data-toggle="tab" href="#tab2">Punto de red</a></li>
                            <li><a data-toggle="tab" href="#tab1">Empalme</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->

            <?php if(count($ProductosPrincipal)>0) { ?>
                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <!--<div id="tab2" class="tab-pane active">-->
                                <!--<div class="products-slick" data-nav="#slick-nav-1">-->

                                    <?php foreach ($ProductosPrincipal as $p) { ?>

                                    <!-- Productos -->
                                    <div class="col-md-3">
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="<?php echo $p["imagen"]; ?>" alt="">
                                            <div class="product-label">
                                                <?php if($p['descuento']!=0) { ?>
                                                    <span class="sale"><?php echo $p['descuento']; ?>%</span>
                                                <?php } ?>
                                                <?php if($p['nuevo']=="Si") { ?>
                                                    <span class="new">NUEVO</span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category"><?php echo $p['categoria']; ?></p>
                                            <h3 class="product-name"><a href="#"><?php echo $p['nombre']; ?></a></h3>
                                            <h4 class="product-price"><?php echo number_format($p["precio"],'0',',','.'); ?>
                                                <?php if($p['descuento']!=0) { ?>
                                                    <del class="product-old-price"><?php echo number_format($p['precio']+(($p['precio']*$p['descuento'])/100),'0',',','.'); ?></del>
                                                <?php } ?>
                                            </h4>
                                            <div class="product-rating">
                                            <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="product-btns">
                                                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Vista rápida</span></button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <form action="<?php echo base_url(); ?>index.php/Carro/Agregar" method="POST" class="Form_Agregar">
                                                <input type="hidden" name="codigo_producto" id="codigo_producto" value="<?php echo $p['id_producto']; ?>">
                                                <input type="hidden" name="codigo_producto" id="codigo_producto" value="<?php echo $p['id_producto']; ?>">
                                                <input type="hidden" name="nombre_producto" id="nomre_producto" value="<?php echo $p['nombre']; ?>">
                                                <input type="hidden" name="precio_producto" id="precio_producto" value="<?php echo $p['precio']; ?>">
                                                <input type="hidden" name="imagen_producto" id="imagen_producto" value="<?php echo $p['imagen']; ?>">
                                                <b>Cantidad:</b><br>
                                                <input type="number" name="cantidad_producto" class="cantidad" id="cantidad_producto" value="1">
                                                <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Agregar al carro</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- /product -->
                                    <?php } ?>

                                <!--</div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>-->
                            <!--</div>-->
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            <?php } ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
