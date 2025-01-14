<?php
include_once '../Modelo/zona_horaria.php';
include_once '../Config/conexion.php';

session_start();

date_default_timezone_set($user_timezone);

// Obtener la zona horaria actualmente configurada
$current_timezone = date_default_timezone_get();

// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Asignar valores a variables
$id_usuario = $data['id_usuario'];
$id_unidad = $data['id_unidad'];
$nota = $data['nota'];
$tipo = $data['tipo'];
$actividadIds = $data['actividadIds'];
$puntosGanados = $data['puntosGanados'];

// Mensajes de depuración
error_log('id_usuario: ' . $id_usuario);
error_log('id_unidad: ' . $id_unidad);
error_log('nota: ' . $nota);
error_log('tipo: ' . $tipo);
error_log('puntosGanados: ' . $puntosGanados);
error_log('actividadIds: ' . json_encode($actividadIds));

// Inicializar el array de respuesta
$response = array('status' => 'success', 'message' => 'Nota guardada exitosamente', 'error' => '');

// Iniciar una transacción
mysqli_begin_transaction($con);

// Insertar la nota en la tabla nota
$query = "INSERT INTO nota (id_usuario, id_unidad, nota, tipo) VALUES ('$id_usuario', '$id_unidad', '$nota', '$tipo')";
$result = mysqli_query($con, $query);

if (!$result) {
    // Si hay un error, revertir la transacción y devolver un mensaje de error
    mysqli_rollback($con);
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
        // Si hay un error, revertir la transacción y devolver un mensaje de error
        mysqli_rollback($con);
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

// Verificar si el usuario ua tiene activado una bonificación de este tipo
$proximoDia = date("Y-m-d", strtotime('tomorrow')) . ' ' . date("H:i");
$proximoDomingo = date("Y-m-d 23:59:59", strtotime('next sunday'));

// Verifica si la nota es perfecta y duplica los puntos ganados
if($nota == 10){
    $puntosGanados = $puntosGanados * 2;
}

// Consultar si el usuario ya tiene una bonificación activa de este tipo
$queryBoniActiva = "SELECT 
                        ub.id_usuario_bonificacion, 
                        ub.id_usuario, 
                        ub.id_bonificacion, 
                        ub.fecha_uso, 
                        ub.estado, 
                        b.id_bonificacion, 
                        b.nombre_bonificacion 
                    FROM 
                        usuario_bonificacion ub 
                    JOIN 
                        bonificacion b 
                    ON 
                        ub.id_bonificacion = b.id_bonificacion 
                    WHERE 
                        ub.fecha_uso >= CURDATE() AND 
                        ub.fecha_uso < DATE_ADD(CURDATE(), INTERVAL 2 DAY) AND 
                        TIME(ub.fecha_uso) <= '23:59:59' AND 
                        ub.estado = 'utilizada' AND 
                        b.nombre_bonificacion = 'Double points' AND
                        ub.id_usuario = '$id_usuario'
                        LIMIT 1";
$resultBoniActiva = mysqli_query($con, $queryBoniActiva);
$rowBoniActiva = mysqli_fetch_assoc($resultBoniActiva);

if ($rowBoniActiva){
    $fecha_uso = strtotime($rowBoniActiva['fecha_uso']);
    $fechaActual = time();
    $diferenciaTiempo = $fechaActual - $fecha_uso;

    if($diferenciaTiempo < 0){
        $puntosGanados = $puntosGanados * 2;
    }
}

$queryActPuntosGanados = "UPDATE usuario SET puntos = puntos + $puntosGanados WHERE id_usuario = $id_usuario";
$resultActPuntosGanados = mysqli_query($con, $queryActPuntosGanados);

if (!$resultActPuntosGanados) {
    // Si hay un error, revertir la transacción y devolver un mensaje de error
    mysqli_rollback($con);
    $error = mysqli_error($con);
    $response['status'] = 'error';
    $response['message'] = 'Error al actualizar los puntos del usuario';
    $response['error'] = $error;

    // Imprimir mensaje en la consola del navegador
    echo json_encode($response);  // Devolver respuesta JSON incluso en error
    error_log('Error al actualizar los puntos del usuario: ' . $error); // Agregar mensaje al log de errores
    exit;
}

// Si no hay errores, confirmar la transacción
mysqli_commit($con);

// Mensaje de respuesta
$response['message'] = 'Grade saved successfully, '. $nota .' also you have earned ' . $puntosGanados . ' points';
$response['nota'] = $nota;
$_SESSION['puntos'] += $puntosGanados;

// Iniciar la transacción
mysqli_begin_transaction($con);

try {
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
                            start_date = CASE WHEN TIMESTAMPDIFF(SECOND, end_date, NOW()) > 93600 THEN NOW() ELSE start_date
                            END
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
} catch (Exception $e) {
    // Rollback de la transacción en caso de error
    mysqli_rollback($con);
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}


// Cerrar la conexión
mysqli_close($con);

// Enviar respuesta al cliente
echo json_encode($response);
?>