	<!-- section -->
	<div class="section" id="section_busqueda">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section-title -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">Resultados de la búsqueda</h3>
						<div class="pull-right">
							<div class="product-slick-dots-1 custom-dots"></div>
						</div>
					</div>
				</div>
				<!-- /section-title -->

				<?php if(isset($productos)) { ?>
					<?php foreach ($productos as $p) { ?>
						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="product product-single product-hot">
								<div class="product-thumb">
									<div class="product-label">
										<?php if($p['nuevo']=="Si") { ?>
												<span class="new">NUEVO</span>
										<?php } ?>
										<?php if($p['descuento']!=0) { ?>
												<span class="sale"><?php echo $p['descuento']; ?>%</span>
										<?php } ?>
									</div>
									<a href="<?php echo base_url(); ?>index.php/Producto/vistaProducto/<?php echo $p["codigo"];?>"><button class="main-btn quick-view"><i class="fa fa-search-plus"></i>Ver más</button></a>
									<img src="<?php echo $p["imagen"]; ?>" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-price"><?php echo number_format($p["precio"],'0',',','.'); ?>
										<?php if($p['descuento']!=0) { ?>
											<del class="product-old-price">
												<?php echo number_format($p['precio']+(($p['precio']*$p['descuento'])/100),'0',',','.'); ?>
											</del>
										<?php } ?>
									</h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<h2 class="product-name"><a href="#"><?php echo $p['nombre']; ?></a></h2>
									<div class="product-btns">
										<form action="<?php echo base_url(); ?>index.php/Carro/Agregar" method="POST" class="Form_Agregar">
												<input type="hidden" name="id_producto" id="codigo_producto" value="<?php echo $p['id_producto']; ?>">
												<input type="hidden" name="codigo_producto" id="codigo_producto" value="<?php echo $p['id_producto']; ?>">
												<input type="hidden" name="nombre_producto" id="nombre_producto" value="<?php echo $p['nombre']; ?>">
												<input type="hidden" name="descripcion_producto" id="descripcion_producto" value="<?php echo $p['descripcion']; ?>">
												<input type="hidden" name="precio_producto" id="precio_producto" value="<?php echo $p['precio']; ?>">
												<input type="hidden" name="imagen_producto" id="imagen_producto" value="<?php echo $p['imagen']; ?>">
												<b>Cantidad:</b><br>
												<input type="number" name="cantidad_producto" class="cantidad" id="cantidad_producto" value="1">
												<button type="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carro</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				<?php }else{ echo '<h4>No hay resultados para la búsqueda</h4><br><br><br><br>'; } ?>
			<!-- /row -->
		 </div>
		<!-- /container -->
	</div>
	<!-- /section -->
