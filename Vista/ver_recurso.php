<?php
include_once '../Config/conexion.php';

// Verificar si se ha enviado el formulario de selección de video
if (isset($_POST['video_select'])) {
    $selected_video_id = $_POST['video_select'];

    // Realizar una nueva consulta para obtener el video seleccionado
    $selected_query = mysqli_query($con, "SELECT * FROM `recurso` WHERE `id_recurso` = '$selected_video_id'") or die(mysqli_error($con));
    $selected_video = mysqli_fetch_array($selected_query);
}

// Realizar consulta para obtener los videos de la base de datos
$query = mysqli_query($con, "SELECT * FROM `recurso` ORDER BY `id_recurso` ASC") or die(mysqli_error($con));

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

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="d-flex align-items-center justify-content-center card-header">
                                <h3 class="text-primary col-md-10">Explore Resources</h3>
                                <a href="panel.php?modulo=recursos" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                        <?php
                        // Verificar si se ha enviado el formulario de selección de video
                        if (isset($_POST['video_select'])) {
                            $selected_video_id = $_POST['video_select'];

                            // Realizar una nueva consulta para obtener el video seleccionado
                            $selected_query = mysqli_query($con, "SELECT * FROM `recurso` WHERE `id_recurso` = '$selected_video_id'") or die(mysqli_error($con));
                            $selected_video = mysqli_fetch_array($selected_query);

                            // Obtener el total de actividades asociadas al recurso seleccionado
                            $total_actividades_query = mysqli_query($con, "SELECT COUNT(*) as total_actividades FROM `actividad` WHERE `id_recurso` = '$selected_video_id' AND `tipo` = 'Activity'") or die(mysqli_error($con));
                            $total_actividades = mysqli_fetch_assoc($total_actividades_query);

                            // Obtener el total de pruebas asociadas al recurso seleccionado
                            $total_pruebas_query = mysqli_query($con, "SELECT COUNT(*) as total_pruebas FROM `actividad` WHERE `id_recurso` = '$selected_video_id' AND `tipo` = 'Test'") or die(mysqli_error($con));
                            $total_pruebas = mysqli_fetch_assoc($total_pruebas_query);

                            // Mostrar el video seleccionado
                            if ($selected_video) {
                                echo '
                                <div class="card-body row">
                                    <div class="col-md-4 my-1" style="word-wrap:break-word;">
                                        <h6>Resource Name:</h6>
                                        <h7 class="text-primary">' . $selected_video['recurso_name'] . '</h7>
                                    </div>
                                    <div class="col-md-4 my-1" style="word-wrap:break-word;">
                                        <h6>Unity Number:</h6>
                                        <h7 class="text-primary">' . $selected_video['id_unidad'] . '</h7>
                                    </div>
                                    <div class="col-md-4 my-1" style="word-wrap:break-word;">
                                        <h6>Number of Activities:
                                            <a href="#" data-toggle="modal" data-target="#agregarActividadModal" class="ml-2">+</a>
                                        </h6>
                                        <h7 class="text-primary">' . $total_actividades['total_actividades'] . '</h7>                                            
                                    </div>
                                    <div class="col-md-4 my-1" style="word-wrap:break-word;">
                                        <h6>Number of Tests:
                                            <a href="#" data-toggle="modal" data-target="#agregarPruebaModal" class="ml-2">+</a>
                                        </h6>
                                        <h7 class="text-primary">' . $total_pruebas['total_pruebas'] . '</h7>                                            
                                    </div>
                                    <div class="col-md-4 my-1" style="word-wrap:break-word;">
                                        <h6>Description:</h6>
                                        <h7 class="text-primary">' . $selected_video['descripcion'] . '</h7>
                                    </div>
                                    <br>
                                </div>  
                                <div class="text-center d-flex align-items-center justify-content-center">
                                        <video width="70%" controls>
                                            <source src="' . $selected_video['location'] . '">
                                        </video>
                                </div>                       
                            ';
                            }
                        }
                        ?>

                        <!-- Mostrar la lista de videos -->

                        <div class="col-md-12">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="video_select">Select Resource:</label>
                                    <select class="form-control" name="video_select" id="video_select">
                                        <?php
                                        while ($fetch = mysqli_fetch_array($query)) {
                                            $selected = '';
                                            if (isset($_POST['video_select']) && $_POST['video_select'] == $fetch['id_recurso']) {
                                                $selected = 'selected';
                                            }
                                            echo '<option value="' . $fetch['id_recurso'] . '" ' . $selected . '>' . $fetch['recurso_name'] . '</option>';
                                        }
                                        mysqli_close($con);
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mb-4">Load selected resource</button>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="modal fade" id="agregarActividadModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="actividad_form" action="agregar_actividades.php" method="POST">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <!-- Agrega aquí el contenido del formulario para agregar actividades -->
                                        <div class="col-md-3"></div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Question</label>
                                                <input type="text" name="pregunta" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label>Options (Separated by commas)</label>
                                                <input type="text" name="opciones" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label>Answer</label>
                                                <input type="text" name="respuesta" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <select name="descripcion" class="form-control">
                                                    <option value=0 selected >Select</option>
                                                    <option value=1>Order</option>
                                                    <option value=2>Match</option>
                                                    <option value=3>Complete</option>
                                                    <option value=4>Multiple Choise</option>
                                                    <option value=5>Number</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Type</label>
                                                <input type="text" name="tipo" class="form-control" value="Activity"
                                                    readonly />
                                            </div>
                                            <input type="hidden" name="id_recurso"
                                                value="<?php echo $selected_video_id; ?>">
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><span
                                                class="glyphicon glyphicon-remove"></span>Close</button>
                                        <button type="submit" name="save" class="btn btn-primary"><span
                                                class="glyphicon glyphicon-save"></span>Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>



                    <div class="modal fade" id="agregarPruebaModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="actividad_form" action="agregar_actividades.php" method="POST">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <!-- Agrega aquí el contenido del formulario para agregar actividades -->
                                        <div class="col-md-3"></div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Question</label>
                                                <input type="text" name="pregunta" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label>Options (Separated by commas)</label>
                                                <input type="text" name="opciones" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label>Answer</label>
                                                <input type="text" name="respuesta" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" name="descripcion" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label>Type</label>
                                                <input type="text" name="tipo" class="form-control" value="Test"
                                                    readonly />
                                            </div>
                                            <input type="hidden" name="id_recurso"
                                                value="<?php echo $selected_video_id; ?>">
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><span
                                                class="glyphicon glyphicon-remove"></span>Close</button>
                                        <button type="submit" name="save" class="btn btn-primary"><span
                                                class="glyphicon glyphicon-save"></span>Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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