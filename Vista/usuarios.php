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
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Member since</th>
                                            <th>Description</th>
                                            <th>Points</th>
                                            <!-- Crear dinámicamente las columnas de las actividades -->
                                            <?php
                                            while ($actividad = mysqli_fetch_assoc($actividades_query)) {
                                                echo '<th>' . $actividad['tipo'] . ' id ' . $actividad['id_actividad'] . '</th>';
                                            }
                                            ?>
                                            <th class="bg-info">Average Tests</th>
                                            <th class="bg-dark">Average Activities</th>
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
                                            $sumActivities = 0;
                                            $sumTests = 0;
                                            $numActivities = 0;
                                            $numTests = 0;
                                            while ($actividad = mysqli_fetch_assoc($actividades_query)) {
                                                echo '<td>';
                                                if (isset($notas[$actividad['id_actividad']])) {
                                                    echo $notas[$actividad['id_actividad']];
                                                    if($actividad['tipo'] == 'Test'){
                                                        $sumTests += $notas[$actividad['id_actividad']];
                                                        $numTests++;
                                                    } else {
                                                        $sumActivities += $notas[$actividad['id_actividad']];
                                                        $numActivities++;
                                                    }
                                                } else {
                                                    echo 'N/A';
                                                }
                                                echo '</td>';
                                            }
                                            if($numActivities > 0){
                                                $sumActivities = $sumActivities / $numActivities;
                                            }else{
                                                $sumActivities = 0;
                                            }
                                            if($numTests > 0){
                                                $sumTests = $sumTests / $numTests;
                                            }else{
                                                $sumTests = 0;
                                            }

                                            $styleST = '';
                                            if ($sumTests >= 7) {
                                                $styleST = 'bg-success';
                                            } elseif ($sumTests >= 5) {
                                                $styleST = 'bg-warning';
                                            } else {
                                                $styleST = 'bg-danger';
                                            }

                                            $styleSA  = '';
                                            if ($sumActivities >= 7) {
                                                $styleSA = 'bg-success';
                                            } elseif ($sumActivities >= 5) {
                                                $styleSA = 'bg-warning';
                                            } else {
                                                $styleSA = 'bg-danger';
                                            }

                                            echo '<td class="' . $styleST . '">' . number_format($sumTests, 2) . '</td>';

                                            echo '<td class="' . $styleSA . '">' . number_format($sumActivities, 2) . '</td>';

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
