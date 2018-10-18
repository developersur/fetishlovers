<!-- FOOTER -->
<footer id="footer" class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<!-- footer logo -->
						<div class="footer-logo">
							<a class="logo" href="#">
		            			<!--<img src="<?php echo base_url(); ?>assets/img/logo.png" alt="">-->
								<h1>FetishLovers</h1>
		          			</a>
						</div>
						<!-- /footer logo -->

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>

						<!-- footer social -->
						<ul class="footer-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
						<!-- /footer social -->
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Categorias</h3>
						<ul class="list-links">
						<?php
							//$this->load->model('CategoriaModel');
							$categorias = $this->CategoriaModel->obtenerCategoriasActivas();

							if($categorias)
							{
									foreach ($categorias->result() as $categoria)
									{
										?>
										<li><a href="<?php echo base_url(); ?>index.php/Producto/Categoria?id_categoria=<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></a></li>
									<?php
								}
							}
						?>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<div class="clearfix visible-sm visible-xs"></div>

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Nosotros</h3>
						<ul class="list-links">
							<?php
							$datos = $this->DatosModel->obtenerDatos();
							foreach($datos->result() as $dato)
							{
								echo '<i class="fa fa-mobile"></i>&nbsp;+56'.$dato->celular.'<br>';
								echo '<i class="fa fa-phone"></i>&nbsp;'.$dato->telefono.'<br>';
								echo '<i class="fa fa-envelope"></i>&nbsp;'.$dato->correo.'<br>';
								echo '<i class="fa fa-home"></i>&nbsp;'.$dato->direccion.'<br>';
							} ?>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer subscribe -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Mantente conectado</h3>
						<p>Ingresa tu correo y enterate de todas nuestras ofertas y promociones</p>
						<form>
							<div class="form-group">
								<input class="input" placeholder="Ingresa tu email">
							</div>
							<button class="primary-btn">Únete a nosotros</button>
						</form>
					</div>
				</div>
				<!-- /footer subscribe -->
			</div>
			<!-- /row -->
			<hr>
			<!-- row -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<!-- footer copyright -->
					<div class="footer-copyright">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | Desarrollado por <i class="fa fa-heart-o" aria-hidden="true"></i> <a href="https://www.developersur.cl" target="_blank">Developersur</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</div>
					<!-- /footer copyright -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/slick.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/nouislider.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.zoom.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-confirm.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/Ajax_carrito.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.rut.chileno.js"></script>

	<!-- Funciones Carrito-->
	<?php $this->load->view('template/Ajax_carrito.php');  ?>

	<!-- jquery confirm -->
	<!--<script src="<?php echo base_url(); ?>assets/js/jquery-confirm.js"></script>-->

</body>

</html>
