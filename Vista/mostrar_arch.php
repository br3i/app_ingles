<?php
include_once '../Config/conexion.php';

// Verificar si se ha enviado el formulario de selección de video
if (isset($_POST['video_select'])) {
    $selected_video_id = $_POST['video_select'];

    // Realizar una nueva consulta para obtener el video seleccionado
    $selected_query = mysqli_query($con, "SELECT * FROM `recurso` WHERE `id_recurso` = '$selected_video_id'") or die(mysqli_error($con));
    $selected_video = mysqli_fetch_array($selected_query);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- <nav class="navbar navbar-default">
    <div class="container-fluid">
        <a href="panel.php?modulo=recursos" class="btn btn-primary">Volver</a>
    </div>
</nav> -->
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 well">
                <h3 class="text-primary">Video Seleccionado</h3>
                <hr style="border-top:1px dotted #ccc;" />
                <?php
                // Verificar si la variable $selected_video está definida
                if (isset($selected_video)) {
                    echo '<div class="row">';
                    echo '    <div class="col-md-4" style="word-wrap:break-word;">';
                    echo '        <br />';
                    echo '        <h4>Nombre del Video:</h4>';
                    echo '        <h5 class="text-primary">' . $selected_video['recurso_name'] . '</h5>';
                    echo '        <br />';
                    echo '        <h4>Descripción:</h4>';
                    echo '        <h5 class="text-primary">' . $selected_video['descripcion'] . '</h5>';
                    echo '    </div>';
                    echo '    <div class="col-md-8">';
                    echo '        <video width="100%" height="240" controls>';

                    // Obtener la ubicación del archivo VTT desde la base de datos
                    $subtitulo_location = $selected_video['vtt_location'];
                    echo '            <source src="' . $selected_video['location'] . '">';

                    // Verificar si se ha cargado un archivo de subtítulos
                    if (!empty($subtitulo_location)) {
                        echo '            <track label="Subtítulos" kind="subtitles" srclang="es" src="' . $subtitulo_location . '" default>';
                    }

                    echo '        </video>';
                    echo '    </div>';
                    echo '</div>';
                    echo '<br>';
                    echo '<hr style="border-top:1px groovy #000;"/>';
                } else {
                    echo '<div class="alert alert-danger">No se ha seleccionado ningún video.</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>