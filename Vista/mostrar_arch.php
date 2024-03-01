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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-lg-12">
                    <div class="card mt-3">
                        <div class="d-flex justify-content-between card-header">
                            <h3 class="text-primary col-md-10">Seleted Resource</h3>
                            <a href="panel.php?modulo=recursos" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                    <!-- /.card -->
                    <div>
                        <?php
                        // Verificar si la variable $selected_video está definida
                        if (isset($selected_video)) {
                            echo '<div class="card">';
                            echo '    <div class="mx-auto m-2">';
                            echo '        <div class="text-center">';
                            echo '            <br />';
                            echo '            <h4>Resource Name:</h4>';
                            echo '            <h5 class="text-primary">' . $selected_video['recurso_name'] . '</h5>';
                            echo '            <br />';
                            echo '            <h4>Description:</h4>';
                            echo '            <h5 class="text-primary">' . $selected_video['descripcion'] . '</h5>';
                            echo '        </div>';
                            echo '        <div>';
                            echo '            <video style="max-height: 550px; height: 80%; width: 100%" controls>';

                            // Obtener la ubicación del archivo VTT desde la base de datos
                            $subtitulo_location = $selected_video['vtt_location'];
                            echo '            <source src="' . $selected_video['location'] . '">';

                            // Verificar si se ha cargado un archivo de subtítulos
                            if (!empty($subtitulo_location)) {
                                echo '            <track label="Subtítulos" kind="subtitles" srclang="es" src="' . $subtitulo_location . '" default>';
                            }

                            echo '            </video>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                            echo '<br>';
                            echo '<hr style="border-top:1px groovy #000;"/>';
                        } else {
                            echo '<div class="alert alert-danger">No se ha seleccionado ningún video.</div>';
                        }
                        ?>
                    </div>
                    <!-- Racha Section -->
                    
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    $(document).ready(function () {
        // Detectar cuando se presiona la tecla "Volver"
        $(document).keydown(function (event) {
            if (event.keyCode == 8) {
                event.preventDefault(); // Prevenir el comportamiento predeterminado de la tecla "Volver"

                // Redirigir a la página anterior
                window.location.href = 'panel.php?modulo=recursos';
            }
        });
    });
</script>