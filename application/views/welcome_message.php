<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>RedElect</title>

	<link href="<?php echo base_url(); ?>assets/css/bootstrap.4.1.css" rel="stylesheet" type="text/css" media="all" />

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.3.3.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/popper.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.4.1.js"></script>
</head>
<body>

<div id="container-fluid">
	<nav class="navbar navbar-expand-lg navbar-dark  bg-dark ">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
		<a class="navbar-brand" href="#">Hidden brand</a>
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		<li class="nav-item active">
			<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Link</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" href="#">Disabled</a>
		</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
		<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>
	</div>
	</nav>
</div>

</body>
</html>