<?php
	date_default_timezone_set('America/Mexico_City');
	include_once '../Config/conexion.php';
	
	if (isset($_POST['save'])) {
		$archivo_name = $_FILES['archivo']['name'];
		$archivo_temp = $_FILES['archivo']['tmp_name'];
		$archivo_size = $_FILES['archivo']['size'];
		$descripcion = $_POST['descripcion'];
		$tipo_archivo = $_POST['tipo_archivo'];

		// Validación del archivo
		if ($archivo_size < 50000000) {
			$archivo_file = explode('.', $archivo_name);
			$archivo_extension = end($archivo_file);
			$allowed_file_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4', 'mp3', 'wav');

			if (in_array($archivo_extension, $allowed_file_ext)) {
				$name = mysqli_real_escape_string($con, $archivo_name);
				// $name = date("Ymd") . time();
				$archivo_location = '../Publico/archivos/' . $name . "." . $archivo_extension;
				if (move_uploaded_file($archivo_temp, $archivo_location)) {
					$subtitulo_location = '';

					// Validación del archivo de subtítulos
					if (isset($_FILES['subtitulo']) && $_FILES['subtitulo']['error'] !== UPLOAD_ERR_NO_FILE) {
						$subtitulo_name = $_FILES['subtitulo']['name'];
						$subtitulo_temp = $_FILES['subtitulo']['tmp_name'];
						$subtitulo_size = $_FILES['subtitulo']['size'];

						if ($subtitulo_size < 50000000) {
							$subtitulo_file = explode('.', $subtitulo_name);
							$subtitulo_extension = end($subtitulo_file);
							$allowed_subtitulo_ext = array('vtt');

							if (in_array($subtitulo_extension, $allowed_subtitulo_ext)) {
								$subtitulo_location = '../Publico/subtitulos/' . $name . "." . $subtitulo_extension;
								if (!move_uploaded_file($subtitulo_temp, $subtitulo_location)) {
									echo "<script>alert('Error al cargar el archivo de subtítulos')</script>";
								}
							} else {
								echo "<script>alert('Formato de subtítulos incorrecto')</script>";
							}
						} else {
							echo "<script>alert('Archivo de subtítulos demasiado grande')</script>";
						}
					}

					// Insertar los datos en la base de datos
					mysqli_query($con, "INSERT INTO `recursos` (`recurso_name`, `tipo_archivo`, `location`, `vtt_location`, `descripcion`) VALUES ('$name', '$tipo_archivo', '$archivo_location', '$subtitulo_location', '$descripcion')") or die(mysqli_error($con));

					echo "<script>alert('Archivo cargado correctamente')</script>";
					// Redireccionar a panel.php con el parámetro modulo=recursos
					echo "<script>window.location.href = 'panel.php?modulo=recursos';</script>";
					exit();
				} else {
					echo "<script>alert('Error al cargar el archivo')</script>";
					echo "<script>window.location.href = 'panel.php?modulo=recursos';</script>";
					exit();
				}
			} else {
				echo "<script>alert('Formato de archivo incorrecto')</script>";
				echo "<script>window.location.href = 'panel.php?modulo=recursos';</script>";
				exit();
			}
		} else {
			echo "<script>alert('Archivo demasiado grande')</script>";
			echo "<script>window.location.href = 'panel.php?modulo=recursos';</script>";
			exit();
		}
	}
?>


