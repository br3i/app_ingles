<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sales</title>
	<link rel="stylesheet" href="../../Publico/css/normalize.css">
	<link rel="stylesheet" href="../../Publico/css/sweetalert2.css">
	<link rel="stylesheet" href="../../Publico/css/material.min.css">
	<link rel="stylesheet" href="../../Publico/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="../../Publico/css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="../../Publico/css/main.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="../../Publico/js/jquery-1.11.2.min.js"><\/script>')</script>
	<script src="../../Publico/js/material.min.js" ></script>
	<script src="../../Publico/js/sweetalert2.min.js" ></script>
	<script src="../../Publico/js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="../../Publico/js/main.js" ></script>
	<!-- Datos de ingreso y busqueda -->
	<link rel="stylesheet" type="text/css" href="../../Publico/css/bootstrap.css">
 	<link rel="stylesheet" type="text/css" href="../../Publico/css/cargando.css">
  	<link rel="stylesheet" type="text/css" href="../../Publico/css/maquinawrite.css">
	<!-- importante BUSQUEDA-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
	<!-- navBar -->
	<div class="full-width navBar">
		<div class="full-width navBar-options">
			<i class="zmdi zmdi-more-vert btn-menu" id="btn-menu"></i>	
			<div class="mdl-tooltip" for="btn-menu">Menu</div>
			<nav class="navBar-options-list">
				<ul class="list-unstyle">
					<li class="btn-exit" id="btn-exit">
						<i class="zmdi zmdi-power"></i>
						<div class="mdl-tooltip" for="btn-exit">Salir</div>
					</li>
					<li class="text-condensedLight noLink" ><small>Usuario</small></li>
					<li class="noLink">
						<figure>
							<img src="../../Publico/assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
						</figure>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<!-- navLateral -->
	<section class="full-width navLateral">
		<div class="full-width navLateral-bg btn-menu"></div>
		<div class="full-width navLateral-body">
			<div class="full-width navLateral-body-logo text-center tittles">
				<i class="zmdi zmdi-close btn-menu"></i> MENU
			</div>
			<figure class="full-width" style="height: 77px;">
				<div class="navLateral-body-cl">
					<img src="../../Publico/assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
				</div>
				<figcaption class="navLateral-body-cr hide-on-tablet">
					<span>
						Full Name Admin<br>
						<small>Admin</small>
					</span>
				</figcaption>
			</figure>
			<div class="full-width tittles navLateral-body-tittle-menu">
				<i class=""></i><span class="hide-on-tablet">&nbsp;</span>
			</div>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">
					<li class="full-width">
						<a href="../../home.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-view-dashboard"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								INICIO
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-case"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								ADMINISTRACIÓN
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
			
							<li class="full-width">
								<a href="../../Controlador/controladorCli.php?var1=1" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-truck"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										PROVEEDORRES
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="../../Controlador/controladorCli.php?var1=2" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-label"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										CATEGORÍAS
									</div>
								</a>
							</li>
						</ul>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="../../Controlador/controladorCli.php?var1=3" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-washing-machine"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								PRODUCTOS
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="../../Controlador/controladorCli.php?var1=4" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-accounts"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								CLIENTES 
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="../../Controlador/controladorCli.php?var1=5" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								VENTAS
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="../../Controlador/controladorCli.php?var1=6" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-store"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								INVENTARIO
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-wrench"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								ACERCA DE
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="#!" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-widgets"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										MANUAL DE USUARIO
									</div>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</section>
	<!-- pageContent -->
	<section class="full-width pageContent">
	
		<!-- nuevo ingreso -->
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="container mt-5 p-5">
				<?php
				include('../../Config/conexion.php');
				$sqlProducto   = ("SELECT * FROM producto ORDER BY ID_PRODUC DESC ");
				$queryProducto = mysqli_query($conexion, $sqlProducto);
				$cantidad     = mysqli_num_rows($queryProducto);
				?>
				<div class="row text-center" style="background-color: #2b7b32">
					<div class="col-md-6"> 
						<strong style="color: white">Registrar Nuevo Producto</strong>
					</div>
					<div class="col-md-6"> 
						<strong style="color: white">Lista de productos <span style="color: white">  ( <?php echo $cantidad; ?> )</span> </strong>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
						<div class="body">
							<div class="row clearfix">
								<div class="col-sm-5">
									<!--- Formulario para registrar Cliente --->
									<label for="">Cédula</label>

									<?php
										$Vr = $_GET['var1'];
										echo $Vr;
										echo $_POST["buscar"];
										echo $mostrar['cedula'];
									include('registrarVenta.php');  ?>
								</div>  

								<div class="col-sm-7">
									<div class="row">
										<div class="col-md-20 p-2">
											<form class="table-responsive">
												<?php include("../../Config/conexion.php"); ?>
												<div class="container mt-1">
													<div class="col-40">
														<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
															<label class="mdl-button mdl-js-button mdl-button--icon" for="searchProducto">
																<i class="zmdi zmdi-search"></i>
															</label>
															<div class="mdl-textfield__expandable-holder">
																<div class="mb-3">
																	<input onkeyup="buscarProd($('#searchProducto').val());" type="text" class="mdl-textfield__input" id="searchProducto" name="searchProducto" placeholder="Producto">
																	<label class="mdl-textfield__label"></label>
																</div>
															</div>
														</div>											
														<div class="card col-35 mt-0">
																<div class="card-body">
																	<div id="buscador" class="container pl-0 pr-0"></div>
																</div>
														</div>
													</div>
												</div>

												<script type="text/javascript">
													function buscarProd(buscarPd) {
													var parametros = {"buscarPd":buscarPd};
													var a=document.getElementById("searchProducto").value;
													if(a!=""){
														$.ajax({
														data:parametros,
														type: 'POST',
														url: 'buscadorPd.php',
														success: function(data) {
															document.getElementById("buscador").innerHTML = data;
														}
														});
														}}
												</script>
											</form> <br>
										<div class="table-responsive">
											<table class="table table-bordered table-striped table-hover">
												<thead>
													<tr>
														<th scope="col">ID</td>
														<th scope="col">Proveedor</th>
														<th scope="col">Producto</th>
														<th scope="col">Categoria</th>
														<th scope="col">Cantidad</th>
														<th scope="col">Precio Menor</th>
														<th scope="col">Precio Mayor</th>
														<th scope="col">Acción</th>
													</tr>
												</thead>
												<?php include("../../Modelo/producto/consultar.php");?>
											</table>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<script src="../../Publico/js/jquery.min.js"></script>
			<script src="../../Publicojs/popper.min.js"></script>
			<script src="../../Publico/js/bootstrap.min.js"></script>

			<script type="text/javascript">
				$(document).ready(function() {
				$(window).load(function() {
				$(".cargando").fadeOut(1000);
				});
				//Ocultar mensaje
				setTimeout(function () {
				$("#contenMsjs").fadeOut(1000);
				}, 3000);

				$('.btnBorrar').click(function(e){
					e.preventDefault();
					var id = $(this).attr("idPd");
					var dataString = 'idPd='+ id;
					url = "../../Modelo/producto/eliminar.php";
					$.ajax({
					type: "POST",
					url: url,
					data: dataString,
					success: function(data){
						window.location.href="products.php";
						$('#respuesta').html(data);	}
					});
					return false;
					});
				});
			</script>
		</div>
	</section>
</body>
</html>