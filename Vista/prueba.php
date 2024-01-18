<?php
/*
// Incluye tu archivo de conexión a la base de datos
include_once "../Config/conexion.php";

// Obtén las preguntas de tipo "Prueba" desde la base de datos
$queryPrueba = "SELECT a.*, r.location FROM actividad a
JOIN recurso r ON a.id_recurso = r.id_recurso
WHERE a.tipo = 'Prueba'";
$resultPrueba = mysqli_query($con, $queryPrueba);

$questionsPrueba = array();
$idPrueba = 1;

// Convierte los resultados en un arreglo asociativo
while ($rowPrueba = mysqli_fetch_assoc($resultPrueba)) {
    $opcionesPrueba = explode(',', $rowPrueba['opciones']); // Convertir la cadena de opciones en un arreglo
    $questionsPrueba[] = array(
        'id' => $idPrueba,
        'tipo' => $rowPrueba['tipo'],
        'id_recurso' => intval($rowPrueba['id_recurso']),
        'id_actividad' => intval($rowPrueba['id_actividad']),
        'descripcion' => $rowPrueba['descripcion'],
        'pregunta' => $rowPrueba['pregunta'],
        'respuesta' => $rowPrueba['respuesta'],
        'opciones' => $opcionesPrueba,
        // Utilizar el arreglo de opciones
        'ruta_video' => $rowPrueba['location'] // Agrega la ruta del video desde la tabla recurso
    );
    $idPrueba++;
}

// Convierte el arreglo de preguntas en formato JSON
$questionsJsonPrueba = json_encode($questionsPrueba, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES |
    JSON_PRETTY_PRINT);

// Elimina las comillas solo alrededor de los nombres de las propiedades
$questionsJsonPrueba = preg_replace('/"([^"]+)"\s*:/', '$1:', $questionsJsonPrueba);

// Guarda el JSON en el archivo PreguntasPrueba.js
$filePrueba = fopen('../Publico/js/PreguntasPrueba.js', 'w');
fwrite($filePrueba, 'let preguntas = ' . $questionsJsonPrueba . ';');
fclose($filePrueba);


// Obtén las preguntas de tipo "Actividad" desde la base de datos
$queryActividad = "SELECT a.*, r.location FROM actividad a
JOIN recurso r ON a.id_recurso = r.id_recurso
WHERE a.tipo = 'Actividad'";
$resultActividad = mysqli_query($con, $queryActividad);

$questionsActividad = array();
$idActividad = 1;

// Convierte los resultados en un arreglo asociativo
while ($rowActividad = mysqli_fetch_assoc($resultActividad)) {
    $opcionesActividad = explode(',', $rowActividad['opciones']); // Convertir la cadena de opciones en un arreglo
    $questionsActividad[] = array(
        'id' => $idActividad,
        'tipo' => $rowActividad['tipo'],
        'id_recurso' => intval($rowActividad['id_recurso']),
        'id_actividad' => intval($rowActividad['id_actividad']),
        'descripcion' => $rowActividad['descripcion'],
        'pregunta' => $rowActividad['pregunta'],
        'respuesta' => $rowActividad['respuesta'],
        'opciones' => $opcionesActividad,
        // Utilizar el arreglo de opciones
        'ruta_video' => $rowActividad['location'] // Agrega la ruta del video desde la tabla recurso
    );
    $idActividad++;
}

// Convierte el arreglo de preguntas en formato JSON
$questionsJsonActividad = json_encode($questionsActividad, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES |
    JSON_PRETTY_PRINT);

// Elimina las comillas solo alrededor de los nombres de las propiedades
$questionsJsonActividad = preg_replace('/"([^"]+)"\s*:/', '$1:', $questionsJsonActividad);

// Guarda el JSON en el archivo PreguntasActividad.js
$fileActividad = fopen('../Publico/js/PreguntasActividad.js', 'w');
fwrite($fileActividad, 'let preguntasActividad = ' . $questionsJsonActividad . ';');
fclose($fileActividad);
*/


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
                            <h3 class="card-title">Welcome to Quiz!</h3>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- start Quiz button -->
                <div class="start_btn"><button id="startQuizBtn">Start Quiz</button></div>

                <!-- Info Box -->
                <div class="info_box">
                    <div class="info-title"><span>Some Rules of this Quiz</span></div>
                    <div class="info-list">
                        <div class="info">1. You will have only <span>60 seconds</span> per each question.</div>
                        <div class="info">2. Once you select your answer, it can't be undone.</div>
                        <div class="info">3. You can't select any option once time goes off.</div>
                        <div class="info">4. You can't exit from the Quiz while you're playing.</div>
                        <div class="info">5. You'll get points on the basis of your correct answers.</div>
                    </div>
                    <div class="buttons">
                        <button class="quit">Exit Quiz</button>
                        <button class="restart">Continue</button>
                    </div>
                </div>

                <!-- Quiz Box -->
                <div class="quiz_box">
                    <header>
                        <div class="title">Awesome Quiz Application</div>
                        <div class="timer">
                            <div class="time_left_txt">Time Left</div>
                            <div class="timer_sec">40</div>
                        </div>
                        <div class="time_line"></div>
                    </header>
                    <section>
                        <div class="que_text">
                            <!-- Here I've inserted question from JavaScript -->
                        </div>
                        <div class="option_list">
                            <!-- Here I've inserted options from JavaScript -->
                        </div>
                    </section>

                    <!-- footer of Quiz Box -->
                    <footer>
                        <div class="total_que">
                            <!-- Here I've inserted Question Count Number from JavaScript -->
                        </div>
                        <button class="next_btn">Next Que</button>
                    </footer>
                </div>

                <!-- Result Box -->
                <div class="result_box">
                    <div class="icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="complete_text">You've completed the Quiz!</div>
                    <div class="score_text">
                        <!-- Here I've inserted Score Result from JavaScript -->
                    </div>
                    <div class="buttons">
                        <button class="restart">Replay Quiz</button>
                        <button class="quit">Quit Quiz</button>
                    </div>
                </div>
            </div>
            <!-- /.col -->

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->