<?php
if (isset($_REQUEST['mensaje'])) {
	?>
	<div class="alert alert-primary alert-dismissible fade show float-right" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
		<?php echo $_REQUEST['mensaje']; ?>
	</div>
	<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Aplicación Ingles</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="Publico/css/fontawesome-free/css/all.min.css" />
	<!-- Theme style -->
	<link rel="stylesheet" href="Publico/css/adminlte.min.css">

	<!-- Mi css -->
	<link rel="stylesheet" href="Publico/css/style.css">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href=""><b>Welcome</b>!!</a>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Enter your credentials</p>

				<?php
				if (isset($_GET['error'])) {
					echo '<div class="alert alert-danger" role="alert">
					Incorrect username or password
					</div>';
				}
				if (isset($_GET['registrarse'])) {
					echo '<div class="alert alert-success" role="alert">
					Here is a modal window to create a new user
					</div>';
				}
				if (isset($_REQUEST['login'])) {
					session_start();
					$username = $_REQUEST['username'] ?? '';
					$password = $_REQUEST['passw'] ?? '';
					$hash = password_hash($password, PASSWORD_DEFAULT);
					include_once "Config/conexion.php";
					$query = "SELECT id_usuario, username, nombre, passw, rol, foto_perfil, fecha_creacion, numero_racha FROM usuario WHERE username='" . $username . "';";
					$res = mysqli_query($con, $query);
					$row = mysqli_fetch_assoc($res);

					if ($row && password_verify($password, $row['passw'])) {
						$_SESSION['id_usuario'] = $row['id_usuario'];
						$_SESSION['username'] = $row['username'];
						$_SESSION['nombre'] = $row['nombre'];
						$_SESSION['foto_perfil'] = $row['foto_perfil'];
						$_SESSION['rol'] = $row['rol'];
						$_SESSION['fecha_creacion'] = $row['fecha_creacion'];
						$_SESSION['numero_racha'] = $row['numero_racha'];

						header("Location: Vista/panel.php");
						exit;

					} else {
						?>
						<div class="alert alert-danger" role="alert">
							Incorrect username or password
						</div>
						<?php
					}
				}
				?>


				<form method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Username" name="username">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" placeholder="Password" name="passw">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="centrado">
						<div>
							<button type="submit" class="btn btn-primary btn-block" name="login">Start session</button>
						</div>
						<div>
							<a href="Controlador/controlador.php?var=1"
								class="btn btn-primary btn-block">Create an account</a>
						</div>
					</div>
				</form>

				<!-- /.login-card-body -->
			</div>
		</div>
		<!-- /.login-box -->

		<!-- jQuery -->
		<script src="Publico/js/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="Publico/ext/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App
		<script src="dist/js/adminlte.min.js"></script> -->
</body>

</html>