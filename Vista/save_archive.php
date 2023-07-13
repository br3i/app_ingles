<?php
date_default_timezone_set('America/Mexico_City');
include_once '../Config/conexion.php';

if (isset($_POST['save'])) {
	$archivo_name = $_FILES['archivo']['name'];
	$archivo_temp = $_FILES['archivo']['tmp_name'];
	$archivo_size = $_FILES['archivo']['size'];
	$descripcion = $_POST['descripcion'];
	$unidad = $_POST['unidad'];

	// Obtener extensión del archivo
	$archivo_extension = pathinfo($archivo_name, PATHINFO_EXTENSION);

	// Validación del archivo
	if ($archivo_size < 50000000) {
		$video_extensions = array('avi', 'flv', 'wmv', 'mov', 'mp4');
		$audio_extensions = array('mp3', 'wav');

		if (in_array($archivo_extension, $video_extensions)) {
			$tipo_archivo = 'video';
		} elseif (in_array($archivo_extension, $audio_extensions)) {
			$tipo_archivo = 'audio';
		} else {
			header("Location: panel.php?modulo=recursos&mensaje=Formato de archivo incorrecto");
			exit();
		}

		$name = mysqli_real_escape_string($con, $archivo_name);
		$archivo_location = '../Publico/archivos/' . $name;

		if (move_uploaded_file($archivo_temp, $archivo_location)) {
			$subtitulo_location = '';

			// Validación del archivo de subtítulos
			if (isset($_FILES['subtitulo']) && $_FILES['subtitulo']['error'] !== UPLOAD_ERR_NO_FILE) {
				$subtitulo_name = $_FILES['subtitulo']['name'];
				$subtitulo_temp = $_FILES['subtitulo']['tmp_name'];
				$subtitulo_size = $_FILES['subtitulo']['size'];

				$subtitulo_extension = pathinfo($subtitulo_name, PATHINFO_EXTENSION);

				if ($subtitulo_size < 50000000 && $subtitulo_extension === 'vtt') {
					$subtitulo_location = '../Publico/subtitulos/' . $name . '.' . $subtitulo_extension;
					if (!move_uploaded_file($subtitulo_temp, $subtitulo_location)) {
						header("Location: panel.php?modulo=recursos&mensaje=Error al cargar el archivo de subtítulos");
						exit();
					}
				} else {
					header("Location: panel.php?modulo=recursos&mensaje=Formato de subtítulos incorrecto");
					exit();
				}
			}

			// Insertar los datos en la base de datos
			mysqli_query($con, "INSERT INTO `recursos` (`unidad`, `recurso_name`, `tipo_archivo`, `location`, `vtt_location`, `descripcion`) VALUES ('$unidad', '$name', '$tipo_archivo', '$archivo_location', '$subtitulo_location', '$descripcion')") or die(mysqli_error($con));

			header("Location: panel.php?modulo=recursos&mensaje=Archivo cargado correctamente");
			exit();
		} else {
			header("Location: panel.php?modulo=recursos&mensaje=Error al cargar el archivo");
			exit();
		}
	} else {
		header("Location: panel.php?modulo=recursos&mensaje=Archivo demasiado grande");
		exit();
	}
}
?>