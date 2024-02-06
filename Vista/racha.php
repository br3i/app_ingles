<?php
include_once '../Config/conexion.php';

// Obtener el ID del usuario desde la sesión
$userId = $_SESSION['id_usuario'];

// Consulta para obtener la información de la racha del usuario
$rachaQuery = "SELECT COUNT(DISTINCT DATE(ultima_actividad)) AS racha, GROUP_CONCAT(DISTINCT DATE(ultima_actividad) ORDER BY ultima_actividad ASC) AS dias_cumplidos
               FROM racha
               WHERE id_usuario = $userId";
$rachaResult = mysqli_query($con, $rachaQuery);

if ($rachaResult) {
    $rachaData = mysqli_fetch_assoc($rachaResult);
    $numeroRacha = $rachaData['racha'];
    $diasCumplidos = explode(',', $rachaData['dias_cumplidos']);
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($con)]);
    exit;
}

// Configuración del calendario
$mesActual = date('n');
$anioActual = date('Y');
if (isset($_GET['mes']) && isset($_GET['anio'])) {
    $mesActual = $_GET['mes'];
    $anioActual = $_GET['anio'];
}

// Navegación del calendario
$mesSiguiente = $mesActual % 12 + 1;
$anioSiguiente = $anioActual + ($mesSiguiente == 1 ? 1 : 0);
$mesAnterior = $mesActual > 1 ? $mesActual - 1 : 12;
$anioAnterior = $anioActual - ($mesAnterior == 12 ? 1 : 0);

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
                            <h3 class="card-title">Welcome to Strikes!</h3>
                        </div>
                    </div>
                    <!-- /.card -->

                    <!-- Racha Section -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Streak Information</h3>
                        </div>
                        <div class="card-body">
                            <p>Current Streak: <?= $numeroRacha; ?> days</p>

                            <!-- Navegación de calendario -->
                            <div>
                                <a href="?mes=<?= $mesAnterior; ?>&anio=<?= $anioAnterior; ?>">Mes anterior</a>
                                <span><?= date('F Y', strtotime("$anioActual-$mesActual-01")); ?></span>
                                <a href="?mes=<?= $mesSiguiente; ?>&anio=<?= $anioSiguiente; ?>">Mes siguiente</a>
                            </div>

                            <div>
                                <h4>Calendar</h4>
                                <!-- Calendario -->
                                <?php
                                $diasEnMes = cal_days_in_month(CAL_GREGORIAN, $mesActual, $anioActual);
                                $primerDiaMes = date('N', strtotime("$anioActual-$mesActual-01"));

                                echo '<table border="1" cellpadding="2" cellspacing="2">';
                                echo '<tr>';
                                echo '<th style="width:30px; text-align:center;">Sun</th>';
                                echo '<th style="width:30px; text-align:center;">Mon</th>';
                                echo '<th style="width:30px; text-align:center;">Tue</th>';
                                echo '<th style="width:30px; text-align:center;">Wed</th>';
                                echo '<th style="width:30px; text-align:center;">Thu</th>';
                                echo '<th style="width:30px; text-align:center;">Fri</th>';
                                echo '<th style="width:30px; text-align:center;">Sat</th>';
                                echo '</tr>';

                                echo '<tr>';
                                $contador = 0;
                                for ($i = 1; $i < $primerDiaMes; $i++) {
                                    echo '<td style="width:30px; text-align:center;"></td>';
                                    $contador++;
                                }

                                for ($i = 1; $i <= $diasEnMes; $i++) {
                                    $fechaActual = "$anioActual-$mesActual-" . str_pad($i, 2, '0', STR_PAD_LEFT);
                                    $esCumplido = in_array($fechaActual, $diasCumplidos);

                                    if ($contador % 7 == 0) {
                                        echo '</tr><tr>';
                                    }

                                    echo '<td style="width:30px; text-align:center; background-color: ' . ($esCumplido ? 'orange' : 'blue') . ';">' . $i . '</td>';
                                    $contador++;
                                }

                                while ($contador % 7 != 0) {
                                    echo '<td style="width:30px; text-align:center;"></td>';
                                    $contador++;
                                }

                                echo '</tr>';
                                echo '</table>';
                                ?>
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
