<?php
include_once '../Config/conexion.php';

// Obtener actividades y usuarios en una sola consulta para reducir el número de consultas a la base de datos
$actividades_query = mysqli_query($con, "SELECT * FROM actividad ORDER BY tipo") or die(mysqli_error($con));
$usuarios_query = mysqli_query($con, "SELECT * FROM usuario ORDER BY id_usuario") or die(mysqli_error($con));

// Crear un array para guardar las actividades por tipo
$actividades = [];
while ($actividad = mysqli_fetch_assoc($actividades_query)) {
    $actividades[] = $actividad;
}

// Variables para contar actividades y tests
$numActivities = 0;
$numTests = 0;
foreach ($actividades as $actividad) {
    if ($actividad['tipo'] === 'Test') {
        $numTests++;
    } else {
        $numActivities++;
    }
}

// Si hay una búsqueda, filtrar las actividades por id_actividad
$search_id = isset($_POST['search_id']) ? $_POST['search_id'] : '';

?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($_SESSION['rol'] == 'admin' || $_SESSION['rol'] == 'teacher'): ?>
                        <!-- Mostrar solo para admins y teachers -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Welcome to Users!</h3>
                            </div>
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
                                                <th class="bg-info">Average Tests</th>
                                                <th class="bg-dark">Average Activities</th>

                                                <?php
                                                // Mostrar las columnas de actividades y tests después de los promedios
                                                foreach ($actividades as $actividad) {
                                                    $bgTH = $actividad['tipo'] === 'Test' ? 'bg-info' : 'bg-dark';
                                                    echo '<th class="' . $bgTH . '">' . $actividad['tipo'] . ' id ' . $actividad['id_actividad'] . '</th>';
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($usuario = mysqli_fetch_assoc($usuarios_query)) {
                                                // Inicializar variables para cada usuario
                                                $sumActivities = 0;
                                                $sumTests = 0;
                                                $notas = [];
                                                
                                                // Obtener las notas del usuario
                                                $notas_query = mysqli_query($con, "SELECT na.id_actividad, n.nota 
                                                                                    FROM nota_actividad na 
                                                                                    INNER JOIN nota n ON na.id_nota = n.id_nota 
                                                                                    WHERE n.id_usuario = {$usuario['id_usuario']}") or die(mysqli_error($con));

                                                while ($nota = mysqli_fetch_assoc($notas_query)) {
                                                    $notas[$nota['id_actividad']] = $nota['nota'];
                                                }

                                                // Calcular promedios
                                                foreach ($actividades as $actividad) {
                                                    $id_actividad = $actividad['id_actividad'];
                                                    if (isset($notas[$id_actividad])) {
                                                        if ($actividad['tipo'] === 'Test') {
                                                            $sumTests += $notas[$id_actividad];
                                                        } else {
                                                            $sumActivities += $notas[$id_actividad];
                                                        }
                                                    }
                                                }
                                                
                                                $averageTests = $numTests > 0 ? $sumTests / $numTests : 0;
                                                $averageActivities = $numActivities > 0 ? $sumActivities / $numActivities : 0;

                                                // Determinar estilos para promedios
                                                $styleTests = $averageTests >= 7 ? 'bg-success' : ($averageTests >= 5 ? 'bg-warning' : 'bg-danger');
                                                $styleActivities = $averageActivities >= 7 ? 'bg-success' : ($averageActivities >= 5 ? 'bg-warning' : 'bg-danger');

                                                // Mostrar la fila con datos del usuario
                                                echo '<tr>';
                                                echo '<td>' . $usuario['id_usuario'] . '</td>';
                                                echo '<td>' . $usuario['username'] . '</td>';
                                                echo '<td>' . $usuario['nombre'] . '</td>';
                                                echo '<td>' . $usuario['rol'] . '</td>';
                                                echo '<td>' . $usuario['fecha_creacion'] . '</td>';
                                                echo '<td>' . $usuario['descripcion'] . '</td>';
                                                echo '<td>' . $usuario['puntos'] . '</td>';
                                                echo '<td class="' . $styleTests . '">' . number_format($averageTests, 2) . '</td>';
                                                echo '<td class="' . $styleActivities . '">' . number_format($averageActivities, 2) . '</td>';

                                                // Mostrar las notas de actividades y tests
                                                foreach ($actividades as $actividad) {
                                                    $id_actividad = $actividad['id_actividad'];
                                                    echo '<td>';
                                                    if (isset($notas[$id_actividad])) {
                                                        echo $notas[$id_actividad];
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                    echo '</td>';
                                                }
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="m-2 alert alert-danger" role="alert">
                            Your user role does not allow access to this page.
                        </div>
                    <?php endif; ?>

                    <!-- Nueva tabla para mostrar las actividades y tests -->
                    <?php if ($_SESSION['rol'] == 'admin' || $_SESSION['rol'] == 'teacher'): ?>
                        <!-- Formulario de búsqueda -->
                        <form method="POST" class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search_id" placeholder="Search Activity ID" value="<?php echo htmlspecialchars($search_id); ?>">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                        <div class="card card-primary mt-4">
                            <div class="card-header">
                                <h3 class="card-title">Activities and Tests</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Question</th>
                                                <th>Options</th>
                                                <th>Answer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Si hay un término de búsqueda, aplicar un filtro
                                            if ($search_id != '') {
                                                $actividades_query = mysqli_query($con, "SELECT * FROM actividad WHERE id_actividad LIKE '%$search_id%' ORDER BY tipo") or die(mysqli_error($con));
                                            } else {
                                                $actividades_query = mysqli_query($con, "SELECT * FROM actividad ORDER BY tipo") or die(mysqli_error($con));
                                            }

                                            while ($actividad = mysqli_fetch_assoc($actividades_query)) {
                                                echo '<tr>';
                                                echo '<td>' . $actividad['id_actividad'] . '</td>';
                                                echo '<td>' . $actividad['tipo'] . '</td>';
                                                echo '<td>' . $actividad['descripcion'] . '</td>';
                                                echo '<td>' . $actividad['pregunta'] . '</td>';
                                                echo '<td>' . $actividad['opciones'] . '</td>';
                                                echo '<td>' . $actividad['respuesta'] . '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
</div>

<?php
// Ahora puedes cerrar la conexión al final del archivo
mysqli_close($con);
?>
