<?php
include_once '../Config/conexion.php';

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

// Cerrar la conexión
mysqli_close($con);

// Enviar respuesta al cliente
echo json_encode($response);
