
	<!-- section -->
	<div class="section" id="vista-producto">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">
						<div id="product-main-view">
							<?php if(count($producto)>0) { ?>
								<?php foreach ($producto as $p) { ?>
									<div class="product-view">
										<img src="<?php echo $p["imagen"]; ?>" height="400" alt="">
									</div>
									<?php
									$nuevo = $p['nuevo'];
									$descuento = $p['descuento'];
									$nombre = $p['nombre'];
									$precio = $p['precio'];
									?>
								<?php } ?>
							<?php } ?>
						</div>
						<div id="product-view">
							<?php if(count($producto)>0) { ?>
								<?php foreach ($producto as $p) { ?>
									<div class="product-view">
										<img src="<?php echo $p["imagen"]; ?>" height="100" alt="">
									</div>
								<?php } ?>
							<?php } ?>
							<!--<div class="product-view">
								<img src="./img/thumb-product01.jpg" alt="">
							</div>
							<div class="product-view">
								<img src="./img/thumb-product02.jpg" alt="">
							</div>
							<div class="product-view">
								<img src="./img/thumb-product03.jpg" alt="">
							</div>
							<div class="product-view">
								<img src="./img/thumb-product04.jpg" alt="">
							</div>-->
						</div>
					</div>
					<div class="col-md-6">
						<div class="product-body">
							<div class="product-label">
								<?php if($nuevo=="Si") { ?>
										<span class="new">NUEVO</span>
								<?php } ?>
								<?php if($descuento!=0) { ?>
										<span class="sale"><?php echo $p['descuento']; ?>%</span>
								<?php } ?>
							</div>
							<h2 class="product-name"><?php echo $nombre; ?></h2>
							<h3 class="product-price">$<?php echo number_format($precio,0,',','.'); ?>
								<?php if($descuento!=0) { ?>
									<del class="product-old-price">
										$<?php echo number_format($precio+(($precio*$descuento)/100),'0',',','.'); ?>
									</del>
								<?php } ?>
							</h3>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
								<!--<a href="#">3 Review(s) / Add Review</a>-->
							</div>
							<p><strong>Disponibilidad:</strong> En Stock</p>
							<!--<p><strong>Brand:</strong> E-SHOP</p>-->
						</div>
					</div>
				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
