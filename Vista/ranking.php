<?php
include_once '../Config/conexion.php';

// 1. Ranking por número total de actividades completadas
$rankingActividadesQuery = "SELECT u.username, COUNT(DISTINCT p.id_actividad) AS total_actividades
                            FROM usuario u
                            INNER JOIN progreso p ON u.id_usuario = p.id_usuario
                            GROUP BY u.username
                            ORDER BY total_actividades DESC
                            LIMIT 5";

$resultActividades = mysqli_query($con, $rankingActividadesQuery);

if ($resultActividades) {
    $rankingActividades = array();

    while ($rowActividades = mysqli_fetch_assoc($resultActividades)) {
        $rankingActividades[] = $rowActividades;
    }
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($con)]);
    exit;
}

// 2. Ranking por promedio de notas de Actividades
$rankingNotaActividadesQuery = "SELECT u.username, AVG(n.nota) AS avg_nota_actividades 
                                FROM usuario u
                                INNER JOIN nota n ON u.id_usuario = n.id_usuario
                                WHERE n.tipo = 'Actividad'
                                GROUP BY u.username
                                ORDER BY avg_nota_actividades DESC
                                LIMIT 5";

$resultNotaActividades = mysqli_query($con, $rankingNotaActividadesQuery);

if ($resultNotaActividades) {
    $rankingNotaActividades = array();

    while ($rowNotaActividades = mysqli_fetch_assoc($resultNotaActividades)) {
        $rankingNotaActividades[] = $rowNotaActividades;
    }
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($con)]);
    exit;
}

// 3. Ranking por promedio de notas de Pruebas
$rankingNotaPruebasQuery = "SELECT u.username, AVG(n.nota) AS avg_nota_pruebas 
                            FROM usuario u
                            INNER JOIN nota n ON u.id_usuario = n.id_usuario
                            WHERE n.tipo = 'Prueba'
                            GROUP BY u.username
                            ORDER BY avg_nota_pruebas DESC
                            LIMIT 5";

$resultNotaPruebas = mysqli_query($con, $rankingNotaPruebasQuery);

if ($resultNotaPruebas) {
    $rankingNotaPruebas = array();

    while ($rowNotaPruebas = mysqli_fetch_assoc($resultNotaPruebas)) {
        $rankingNotaPruebas[] = $rowNotaPruebas;
    }
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($con)]);
    exit;
}

// 4. Ranking por frecuencia de rachas
$rankingRachasQuery = "SELECT u.username, COUNT(DISTINCT DATE(r.end_date)) AS frecuencia_rachas
                      FROM usuario u
                      INNER JOIN racha r ON u.id_usuario = r.id_usuario
                      GROUP BY u.username
                      ORDER BY frecuencia_rachas DESC
                      LIMIT 5";

$resultRachas = mysqli_query($con, $rankingRachasQuery);

if ($resultRachas) {
    $rankingRachas = array();

    while ($rowRachas = mysqli_fetch_assoc($resultRachas)) {
        $rankingRachas[] = $rowRachas;
    }
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($con)]);
    exit;
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
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
                            <h3 class="card-title">Welcome to Ranking!</h3>
                        </div>
                    </div>
                    <!-- /.card -->

                    <!-- Ranking Section -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ranking Results</h3>
                        </div>
                        <div class="card-body">
                            <!-- Ranking Actividades -->
                            <div>
                                <h4>Ranking por número total de actividades completadas</h4>
                                <ul>
                                    <?php foreach ($rankingActividades as $usuario): ?>
                                        <li>Usuario: <?= $usuario['username']; ?> - Total Actividades: <?= $usuario['total_actividades']; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Ranking Notas por Actividades -->
                            <div>
                                <h4>Ranking por promedio de notas de Actividades</h4>
                                <ul>
                                    <?php foreach ($rankingNotaActividades as $usuario): ?>
                                        <li>Usuario: <?= $usuario['username']; ?> - Promedio de Notas: <?= $usuario['avg_nota_actividades']; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Ranking Notas por Pruebas -->
                            <div>
                                <h4>Ranking por promedio de notas de Pruebas</h4>
                                <ul>
                                    <?php foreach ($rankingNotaPruebas as $usuario): ?>
                                        <li>Usuario: <?= $usuario['username']; ?> - Promedio de Notas: <?= $usuario['avg_nota_pruebas']; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Ranking Rachas -->
                            <div>
                                <h4>Ranking por frecuencia de rachas</h4>
                                <ul>
                                    <?php foreach ($rankingRachas as $usuario): ?>
                                        <li>Usuario: <?= $usuario['username']; ?> - Frecuencia de Rachas: <?= $usuario['frecuencia_rachas']; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
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
