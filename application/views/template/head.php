<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>FetishLovers. Venta de juguetes eróticos, Concepción</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />

	<!-- mis estilos -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/contacto.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/menuadmin.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/vista-producto.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/porcategoria.css" />

	<!--Jquery confirm-->
	<!--<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-confirm.css"/>-->

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126693551-1"></script>
	<script>
	  	window.dataLayer = window.dataLayer || [];
	  	function gtag(){dataLayer.push(arguments);}
	  	gtag('js', new Date());
	  	gtag('config', 'UA-126693551-1');


		function mostrar_qsomos()
		{
			$.confirm({
				columnClass: 'col-md-8 col-md-offset-2',
				content: function () {
					var self = this;
					return $.ajax({
						url: "<?php echo base_url(); ?>index.php/QuienesSomos/obtenerQS",
						method: 'post',
					}).done(function (response) {
						var val = [];
						var newData = JSON.parse(response);

						newData.forEach(function(value, index) {
							val[index] = value;
						});

						self.setContent(val[1]);
						self.setTitle(val[0]);
					}).fail(function(){
						self.setContent('Error al cargar datos');
					});
				},
				buttons: {
					Cerrar: function () {
					}
				},
				type: 'dark',
			});
		}

	</script>

</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<?php
					$datos = $this->DatosModel->obtenerDatos();
					foreach($datos->result() as $dato)
					{
						echo '&nbsp;&nbsp;<i class="fa fa-mobile"></i>&nbsp;+56'.$dato->celular;
						echo '&nbsp;&nbsp;<i class="fa fa-phone"></i>&nbsp;'.$dato->telefono;
						echo '&nbsp;&nbsp;<i class="fa fa-envelope"></i>&nbsp;'.$dato->correo;
						echo '&nbsp;&nbsp;<i class="fa fa-home"></i>&nbsp;'.$dato->direccion;
					} ?>
				</div>
			</div>
		</div>
		<!-- /top Header -->

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="#">
							<!--<img src="./img/logo.png" alt="">-->
							<h1><label><a href="<?php echo base_url(); ?>">FetishLovers</a></label></h1>
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">
						<form method="post" action="<?php echo base_url(); ?>index.php/Producto/buscaProducto">
							<input class="input search-input" type="text" name="texto_buscar" placeholder="¿Qué estas buscando?">
							<button class="search-btn"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<!-- /Search -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong class="text-uppercase">Mi cuenta <i class="fa fa-caret-down"></i></strong>
							</div>
							<ul class="custom-menu">
							<?php
								if($this->session->logged_in)
								{
								?>
									<li class="block"><a href="<?php echo base_url(); ?>index.php/Admin">Administrar</a></li>
									<li class="block"><a href="<?php echo base_url(); ?>index.php/Login/salir">Salir</a></li>
									<?php
								}else if($this->session->logged_in_user){?>
									<li class="block"><a href="<?php echo base_url(); ?>index.php/Cliente/">Mi Cuenta</a></li>
									<li class="block"><a href="<?php echo base_url(); ?>index.php/Login/salir">Salir</a></li>
								<?php
								}else{?>
									<li><a href="<?php echo base_url(); ?>index.php/Login"><i class="fa fa-unlock-alt"></i>Login</a></li>
									<li><a href="#"><i class="fa fa-user-plus"></i>Crear cuenta</a></li>
								<?php } ?>
							</ul>
						</li>
						<!-- /Account -->

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span class="qty">3</span>
								</div>
								<strong class="text-uppercase">Mi carro</strong>
								<br>
								<!--<span>35.20$</span>-->
							</a>
							<div class="custom-menu" id="mi-carrito">
								<div id="shopping-cart">
									<div class="shopping-cart-list">
										<div class="product product-widget">
											<div class="product-thumb">
												<img src="" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-price">$32.50 <span class="qty">x3</span></h3>
												<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
											</div>
											<button class="cancel-btn"><i class="fa fa-trash"></i></button>
										</div>
										<div class="product product-widget">
											<div class="product-thumb">
												<img src="" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-price">$32.50 <span class="qty">x3</span></h3>
												<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
											</div>
											<button class="cancel-btn"><i class="fa fa-trash"></i></button>
										</div>
									</div>
									<div class="shopping-cart-btns">
										<button class="main-btn">Ver carrito</button>
										<button class="primary-btn">Comprar <i class="fa fa-arrow-circle-right"></i></button>
									</div>
								</div>
							</div>
						</li>
						<!-- /Cart -->

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>
			<!-- header -->
		</div>
		<!-- container -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav">
					<span class="category-header">Categorías <i class="fa fa-list"></i></span>
					<ul class="category-list">
					<?php
						//$this->load->model('CategoriaModel');
						$categorias = $this->CategoriaModel->obtenerCategoriasActivas();
						foreach($categorias->result() as $categoria) { ?>
							<li><a href="<?php echo base_url(); ?>index.php/Producto/Categoria?id_categoria=<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></a></li>
						<?php }
					?>
					</ul>
				</div>
				<!-- /category nav -->

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
						<li><a href="<?php echo base_url(); ?>">Inicio</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/QuienesSomos">Quienes somos</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/Contacto">Contactanos</a></li>
					</ul>
				</div>
				<!-- menu nav -->
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->
