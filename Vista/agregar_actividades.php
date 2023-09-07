<?php
date_default_timezone_set('America/Mexico_City');
include_once '../Config/conexion.php';

if (isset($_POST['save'])) {
    $pregunta = $_POST['pregunta'];
    $opciones = $_POST['opciones'];
    $respuesta = $_POST['respuesta'];
    $descripcion = $_POST['descripcion'];
    $tipo = $_POST['tipo'];
    $id_recurso = $_POST['id_recurso'];

    // Verificar si el recurso existe en la tabla recurso
    $query = "SELECT id_recurso FROM recurso WHERE id_recurso = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_recurso);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        // El recurso existe, realizar la inserción en actividad
        $query = "INSERT INTO actividad (id_recurso, pregunta, opciones, respuesta, descripcion, tipo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "isssss", $id_recurso, $pregunta, $opciones, $respuesta, $descripcion, $tipo);
        mysqli_stmt_execute($stmt);

        // Verificar si la inserción fue exitosa
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // La inserción fue exitosa
            header("Location: panel.php?modulo=recursos&mensaje=Actividad guardada correctamente");
            exit();
        } else {
            // Ocurrió un error durante la inserción
            header("Location: panel.php?modulo=recursos&mensaje=Error al guardar la actividad");
            exit();
        }
    } else {
        // El recurso no existe en la tabla recurso
        header("Location: panel.php?modulo=recursos&mensaje=El recurso asociado no existe");
        exit();
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>