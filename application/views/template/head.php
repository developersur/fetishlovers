<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="develpersur">
	<meta name="description" content="Venta de lencería erótica. Vibradores. Consoladores. Juguetes sexuales"/>
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>FetishLovers. Lencería, Consoladores, Vibradores, Accesorios. Concepción. Chile</title>

	<link rel="shortcut icon" href="https://www.fetishlovers.cl/assets/img/logos/logo1.png">

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">


	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slick-theme.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nouislider.min.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/contacto.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/menuadmin.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/vista-producto.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/porcategoria.css" />

	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

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

		 /**
		 * Array con las imagenes y enlaces que se iran mostrando en la web
		 */

		var imagenes=new Array(
				//['<?php echo base_url(); ?>assets/img/logos/logo1.png','<?php echo base_url(); ?>'],
				['<?php echo base_url(); ?>assets/img/logos/logo2.png','<?php echo base_url(); ?>'],
				//['<?php echo base_url(); ?>assets/img/logos/logo3.png','<?php echo base_url(); ?>'],
				['<?php echo base_url(); ?>assets/img/logos/logo4.png','<?php echo base_url(); ?>']
		);

		/**
		 * Funcion para cambiar la imagen y link
		 */

		function rotarImagenes()
		{
				// obtenemos un numero aleatorio entre 0 y la cantidad de imagenes que hay
				var index=Math.floor((Math.random()*imagenes.length));
				// cambiamos la imagen y la url
				document.getElementById("imagen").src=imagenes[index][0];
				document.getElementById("link").href=imagenes[index][1];
		}

		/**
		 * Función que se ejecuta una vez cargada la página
		 */
		onload=function()
		{
				// Cargamos una imagen aleatoria
				rotarImagenes();
				// Indicamos que cada 5 segundos cambie la imagen
				setInterval(rotarImagenes,5000);
		}
	</script>

</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="">
					<div class="col-md-12">
						<?php
						$datos = $this->DatosModel->obtenerDatos();
						foreach($datos->result() as $dato)
						{
							echo '<div class="col-md-3"><i class="fa fa-mobile"></i>+56'.$dato->celular.'</div>';
							echo '<div class="col-md-3"><i class="fa fa-phone"></i>'.$dato->telefono.'</div>';
							echo '<div class="col-md-3"><i class="fa fa-envelope"></i>'.$dato->correo.'</div>';
							echo '<div class="col-md-3"><i class="fa fa-home"></i>'.$dato->direccion.'</div>';
						} ?>
					</div>
				</div>
			</div>
		</div>
		<!-- /top Header -->

		<!-- header -->
		<div id="header" class="section section-grey">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="" id="link">
							<img id="imagen" src="" width="300" height="200" alt="">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">
						<form method="post" action="<?php echo base_url(); ?>index.php/Producto/buscaProducto">
							<input class="input search-input" type="text" name="texto_buscar" placeholder="¿Qué estas buscando?" min="2" max="200">
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
									<li><a href="<?php echo base_url(); ?>index.php/Cliente/CrearCuenta"><i class="fa fa-user-plus"></i>Crear cuenta</a></li>
								<?php } ?>
							</ul>
						</li>
						<!-- /Account -->

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<div id="carrito_cabecera" class="dropdown"></div>
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
