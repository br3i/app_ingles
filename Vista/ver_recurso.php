<?php
include_once '../Config/conexion.php';

// Verificar si se ha enviado el formulario de selección de video
if (isset($_POST['video_select'])) {
    $selected_video_id = $_POST['video_select'];

    // Realizar una nueva consulta para obtener el video seleccionado
    $selected_query = mysqli_query($con, "SELECT * FROM `recursos` WHERE `id_recurso` = '$selected_video_id'") or die(mysqli_error($con));
    $selected_video = mysqli_fetch_array($selected_query);
}

// Realizar consulta para obtener los videos de la base de datos
$query = mysqli_query($con, "SELECT * FROM `recursos` ORDER BY `id_recurso` ASC") or die(mysqli_error($con));
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


                    <div class="card alert alert-primary alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        Welcome to Resources!
                    </div>


                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Welcome to Resources!</h3>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="d-flex align-items-center justify-content-center card-header">
                                <h3 class="text-primary col-md-10">Explorar Recursos</h3>
                                <a href="panel.php?modulo=recursos" class="btn btn-primary">Volver</a>
                            </div>
                        </div>
                        <?php
                        // Verificar si se ha enviado el formulario de selección de video
                        if (isset($_POST['video_select'])) {
                            $selected_video_id = $_POST['video_select'];

                            // Realizar una nueva consulta para obtener el video seleccionado
                            $selected_query = mysqli_query($con, "SELECT * FROM `recursos` WHERE `id_recurso` = '$selected_video_id'") or die(mysqli_error($con));
                            $selected_video = mysqli_fetch_array($selected_query);

                            // Mostrar el video seleccionado
                            if ($selected_video) {
                                echo '
                                    <div class="card d-flex align-items-center justify-content-center">
                                        <div class="col-md-4" style="word-wrap:break-word;">
                                            <br />
                                            <h4>Nombre del Recurso:</h4>
                                            <h5 class="text-primary">' . $selected_video['recurso_name'] . '</h5>
                                            <br />
                                            <h4>Descripción:</h4>
                                            <h5 class="text-primary">' . $selected_video['descripcion'] . '</h5>
                                        </div>
                                        <div class="col-md-8 text-center">
                                            <video width="100%" height="240" controls>
                                                <source src="' . $selected_video['location'] . '">
                                            </video>
                                        </div>
                                        <br>
                                    </div>                         
                                ';
                            }
                        }
                        ?>

                        <!-- Mostrar la lista de videos -->

                        <div class="col-md-12">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="video_select">Seleccionar Recurso:</label>
                                    <select class="form-control" name="video_select" id="video_select">
                                        <?php
                                        while ($fetch = mysqli_fetch_array($query)) {
                                            echo '<option value="' . $fetch['id_recurso'] . '">' . $fetch['recurso_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Cargar recurso
                                    seleccionado</button>
                            </form>
                        </div>
                        <br />
                        <br />
                        <!-- /.card -->
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


<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->