<?php
include_once '../Modelo/zona_horaria.php';
include_once '../Config/conexion.php';

date_default_timezone_set($user_timezone);

// Obtener la zona horaria actualmente configurada
$current_timezone = date_default_timezone_get();

// Imprimir la zona horaria
echo "<script>console.log('La zona horaria actual es: " . $current_timezone . "');</script>";

// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Asignar valores a variables
$id_usuario = $data['id_usuario'];
$id_unidad = $data['id_unidad'];
$nota = $data['nota'];
$tipo = $data['tipo'];
$actividadIds = $data['actividadIds'];

// Mensajes de depuración
error_log('id_usuario: ' . $id_usuario);
error_log('id_unidad: ' . $id_unidad);
error_log('nota: ' . $nota);
error_log('tipo: ' . $tipo);
error_log('actividadIds: ' . json_encode($actividadIds));

// Inicializar el array de respuesta
$response = array('status' => 'success', 'message' => 'Nota guardada exitosamente', 'error' => '');

// Insertar la nota en la tabla nota
$query = "INSERT INTO nota (id_usuario, id_unidad, nota, tipo) VALUES ('$id_usuario', '$id_unidad', '$nota', '$tipo')";
$result = mysqli_query($con, $query);

if (!$result) {
    $error = mysqli_error($con);
    $response['status'] = 'error';
    $response['message'] = 'Error al insertar en la tabla nota';
    $response['error'] = $error;

    // Imprimir mensaje en la consola del navegador
    echo json_encode($response);  // Devolver respuesta JSON incluso en error
    error_log('Error al insertar en la tabla nota: ' . $error); // Agregar mensaje al log de errores

    exit;
}

// Obtener el ID de la última nota insertada
$id_nota = mysqli_insert_id($con);

// Insertar las relaciones en la tabla nota_actividad
foreach ($actividadIds as $actividadId) {
    $query = "INSERT INTO nota_actividad (id_nota, id_actividad) VALUES ('$id_nota', '$actividadId')";
    $result = mysqli_query($con, $query);

    if (!$result) {
        $error = mysqli_error($con);
        $response['status'] = 'error';
        $response['message'] = 'Error al insertar en la tabla nota_actividad';
        $response['error'] = $error;

        // Imprimir mensaje en la consola del navegador
        echo json_encode($response);  // Devolver respuesta JSON incluso en error
        error_log('Error al insertar en la tabla nota_actividad: ' . $error); // Agregar mensaje al log de errores

        exit;
    }
}


// Actualizar la tabla racha si es necesario
$now = time();
$hoy = date('Y-m-d', $now);

$sql_fecha_actividad = "SELECT end_date, first_activity_date FROM racha WHERE id_usuario = $id_usuario";
$resultado_fecha = mysqli_query($con, $sql_fecha_actividad);

if (mysqli_num_rows($resultado_fecha) > 0) {
    $row = mysqli_fetch_assoc($resultado_fecha);
    $end_date = strtotime($row['end_date']);
    $first_activity_date = strtotime($row['first_activity_date']);

    // Si la última actividad fue hoy, solo actualizar end_date
    if (date('Y-m-d', $end_date) === $hoy) {
        $sql_update = "UPDATE racha SET end_date = NOW() WHERE id_usuario = $id_usuario";
    } else {
        // Si es la primera actividad del día, incrementar num_racha y actualizar first_activity_date
        $sql_update = "UPDATE racha 
                   SET num_racha = CASE WHEN TIMESTAMPDIFF(SECOND, end_date, NOW()) > 93600 THEN 0 ELSE num_racha + 1 END, 
                       end_date = NOW(), 
                       first_activity_date = NOW() 
                   WHERE id_usuario = $userId";
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
    $sql_insert = "INSERT INTO racha (id_usuario, end_date, num_racha, start_date, first_activity_date) VALUES ($id_usuario, NOW(), 0, NOW(), FROM_UNIXTIME($now))";

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


// Cerrar la conexión
mysqli_close($con);

// Enviar respuesta al cliente
echo json_encode($response);
?>