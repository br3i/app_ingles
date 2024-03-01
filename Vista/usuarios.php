<?php
include_once '../Config/conexion.php';

// Consulta para obtener las actividades
$actividades_query = mysqli_query($con, "SELECT * FROM actividad") or die(mysqli_error($con));

// Consulta para obtener los usuarios y sus datos
$usuarios_query = mysqli_query($con, "SELECT * FROM usuario") or die(mysqli_error($con));

// Cerrar la conexión a la base de datos

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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Welcome to Users!</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Nombre</th>
                                            <th>Rol</th>
                                            <th>Fecha de Creación</th>
                                            <th>Descripción</th>
                                            <th>Puntos</th>
                                            <!-- Crear dinámicamente las columnas de las actividades -->
                                            <?php
                                            while ($actividad = mysqli_fetch_assoc($actividades_query)) {
                                                echo '<th>' . $actividad['tipo'] . ' Activity ' . $actividad['id_actividad'] . '</th>';
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($usuario = mysqli_fetch_assoc($usuarios_query)) {
                                            echo '<tr>';
                                            echo '<td>' . $usuario['id_usuario'] . '</td>';
                                            echo '<td>' . $usuario['username'] . '</td>';
                                            echo '<td>' . $usuario['nombre'] . '</td>';
                                            echo '<td>' . $usuario['rol'] . '</td>';
                                            echo '<td>' . $usuario['fecha_creacion'] . '</td>';
                                            echo '<td>' . $usuario['descripcion'] . '</td>';
                                            echo '<td>' . $usuario['puntos'] . '</td>';

                                            // Consulta para obtener las notas de actividades del usuario actual
                                            $notas_query = mysqli_query($con, "SELECT na.id_actividad, n.nota 
                                                                                FROM nota_actividad na 
                                                                                INNER JOIN nota n ON na.id_nota = n.id_nota 
                                                                                WHERE n.id_usuario = {$usuario['id_usuario']}") or die(mysqli_error($con));
                                            $notas = array();
                                            while ($nota = mysqli_fetch_assoc($notas_query)) {
                                                $notas[$nota['id_actividad']] = $nota['nota'];
                                            }

                                            // Iterar sobre las actividades para mostrar las notas correspondientes
                                            mysqli_data_seek($actividades_query, 0); // Reiniciar el puntero de la consulta de actividades
                                            while ($actividad = mysqli_fetch_assoc($actividades_query)) {
                                                echo '<td>';
                                                if (isset($notas[$actividad['id_actividad']])) {
                                                    echo $notas[$actividad['id_actividad']];
                                                } else {
                                                    echo 'N/A';
                                                }
                                                echo '</td>';
                                            }

                                            echo '</tr>';
                                        }
                                        mysqli_close($con);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
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
