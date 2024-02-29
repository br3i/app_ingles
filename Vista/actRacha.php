<?php
include_once '../Config/conexion.php';

// Obtener el ID del usuario desde la solicitud POST
$userId = $_POST['userId'];

$now = time();
$hoy = date('Y-m-d', $now);

$sql_fecha_actividad = "SELECT end_date, first_activity_date FROM racha WHERE id_usuario = $userId";
$resultado_fecha = mysqli_query($con, $sql_fecha_actividad);

if (mysqli_num_rows($resultado_fecha) > 0) {
    $row = mysqli_fetch_assoc($resultado_fecha);
    $end_date = strtotime($row['end_date']);
    $first_activity_date = strtotime($row['first_activity_date']);

    // Si la última actividad fue hoy, solo actualizar end_date
    if (date('Y-m-d', $end_date) === $hoy) {
        $sql_update = "UPDATE racha SET end_date = NOW() WHERE id_usuario = $userId";
    } else {
        // Si es la primera actividad del día, incrementar num_racha y actualizar first_activity_date
        $sql_update = "UPDATE racha SET num_racha = CASE WHEN TIMESTAMPDIFF(SECOND, end_date, NOW()) > 86400 THEN 0 ELSE num_racha + 1 END, end_date = NOW(), first_activity_date = FROM_UNIXTIME($now) WHERE id_usuario = $userId";

    }

    if (mysqli_query($con, $sql_update)) {
        //echo "La fecha de última actividad y num_racha se han actualizado correctamente.";
    } else {
        //echo "Error al actualizar la fecha de última actividad y num_racha: " . mysqli_error($con);
        $error = mysqli_error($con);
        $response['status'] = 'error';
        $response['message'] = 'Error al actualizar la tabla racha';
        $response['error'] = $error;

        // Imprimir mensaje en la consola del navegador
        echo json_encode($response);  // Devolver respuesta JSON incluso en error
        error_log('Error al actualizar la tabla racha: ' . $error); // Agregar mensaje al log de errores

        exit;
    }
} else {
    // Si no hay un registro para el usuario, insertar uno nuevo con las fechas correspondientes
    $sql_insert = "INSERT INTO racha (id_usuario, end_date, num_racha, start_date, first_activity_date) VALUES ($userId, NOW(), 0, NOW(), FROM_UNIXTIME($now))";

    if (!mysqli_query($con, $sql_insert)) {
        $error = mysqli_error($con);
        $response['status'] = 'error';
        $response['message'] = 'Error al insertar en la tabla racha';
        $response['error'] = $error;

        // Imprimir mensaje en la consola del navegador
        echo json_encode($response);  // Devolver respuesta JSON incluso en error
        error_log('Error al insertar en la tabla racha: ' . $error); // Agregar mensaje al log de errores

        exit;
    }
}
// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
