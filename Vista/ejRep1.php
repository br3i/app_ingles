<!DOCTYPE html>
<html>

<head>
    <title>Ejercicio 1</title>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        #panelRespuestas {
            display: none;
        }
    </style>
    <script src="Publico/js/scriptEva.js"></script>
    <script>
        <?php
        // Array de preguntas y respuestas
        $preguntas = array(
            "¿Cuál es el color del cielo?",
            "¿Cuál es el animal que ladra?",
            "¿Cuál es la capital de Francia?",
            "¿Cuál es el opuesto de 'arriba'?",
            "¿Cuál es el día después del martes?"
        );

        $respuestas = array(
            "azul",
            "perro",
            "París",
            "abajo",
            "miércoles"
        );
        ?>

        var preguntas = <?php echo json_encode($preguntas); ?>;
        var respuestas = <?php echo json_encode($respuestas); ?>;

        $(document).ready(function () {
            $("#openModalBtn").click(function () {
                $("#myModal").modal("show");
                $("#panelRespuestas").hide(); // Ocultar el panel de respuestas incorrectas
                $("#respuestasIncorrectas").empty(); // Borrar el contenido de las respuestas incorrectas
            });

            $("#myModal").on("hidden.bs.modal", function () {
                $("#listeningForm")[0].reset();
            });

            $("#listeningForm").submit(function (event) {
                event.preventDefault();

                var respuestasIncorrectas = [];

                for (var i = 0; i < respuestas.length; i++) {
                    var pregunta = $('input[name="pregunta-' + i + '"]:checked');
                    if (pregunta.length === 0) {
                        respuestasIncorrectas.push({
                            pregunta: preguntas[i],
                            respuestaCorrecta: respuestas[i],
                            respuestaUsuario: "No respondida"
                        });
                    } else if (pregunta.val() !== respuestas[i]) {
                        respuestasIncorrectas.push({
                            pregunta: preguntas[i],
                            respuestaCorrecta: respuestas[i],
                            respuestaUsuario: pregunta.val()
                        });
                    }
                }

                var panelRespuestas = $("#panelRespuestas");
                var respuestasIncorrectasDiv = $("#respuestasIncorrectas");
                respuestasIncorrectasDiv.empty();
                if (respuestasIncorrectas.length === 0) {
                    respuestasIncorrectasDiv.html("¡Todas las respuestas son correctas!");
                } else {
                    respuestasIncorrectasDiv.append('<ul>');
                    respuestasIncorrectas.forEach(function (respuestaIncorrecta) {
                        var preguntaItem = $("<li>").text(respuestaIncorrecta.pregunta);
                        var respuestaCorrectaItem = $("<li>").text("Respuesta correcta: " + respuestaIncorrecta.respuestaCorrecta);
                        var respuestaUsuarioItem = $("<li>").text("Tu respuesta: " + (respuestaIncorrecta.respuestaUsuario ? respuestaIncorrecta.respuestaUsuario : "No respondida"));
                        respuestasIncorrectasDiv.append(preguntaItem, respuestaCorrectaItem, respuestaUsuarioItem);
                    });
                    respuestasIncorrectasDiv.append('</ul>');
                }
                panelRespuestas.show();

                $("#myModal").modal("hide");
            });
        });
    </script>
</head>

<body>
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
                                <h3 class="card-title">Welcome to Train!</h3>
                            </div>
                            <div class="card-body">
                                <h1>Listening de Inglés</h1>

                                <button id="openModalBtn" class="btn btn-primary">Comenzar Listening</button>

                                <!-- Modal -->
                                <div id="myModal" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Crear Preguntas</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="listeningForm" action="evaluar_respuestas.php" method="post">
                                                    <?php
                                                    // Opciones personalizadas para cada pregunta
                                                    $opciones = array(
                                                        array("azul", "rojo", "verde", "amarillo"),
                                                        // Opciones para la primera pregunta
                                                        array("perro", "gato", "elefante", "conejo"),
                                                        // Opciones para la segunda pregunta
                                                        array("París", "Londres", "Roma", "Madrid"),
                                                        // Opciones para la tercera pregunta
                                                        array("abajo", "arriba", "derecha", "izquierda"),
                                                        // Opciones para la cuarta pregunta
                                                        array("miércoles", "jueves", "viernes", "sábado") // Opciones para la quinta pregunta
                                                    );

                                                    // Generar opciones para cada pregunta
                                                    for ($i = 0; $i < count($preguntas); $i++) {
                                                        shuffle($opciones[$i]); // Cambiar el orden de las opciones
                                                    
                                                        echo '<h5>' . ($i + 1) . '. ' . $preguntas[$i] . '</h5>';
                                                        foreach ($opciones[$i] as $opcion) {
                                                            echo '<div class="form-check">';
                                                            echo '<input class="form-check-input" type="radio" name="pregunta-' . $i . '" id="pregunta-' . $i . '-' . $opcion . '" value="' . $opcion . '">';
                                                            echo '<label class="form-check-label" for="pregunta-' . $i . '-' . $opcion . '">' . $opcion . '</label>';
                                                            echo '</div>';
                                                        }
                                                        echo '<br>';
                                                    }
                                                    ?>

                                                    <input type="submit" class="btn btn-primary"
                                                        value="Evaluar respuestas">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Panel de respuestas incorrectas -->
                                <div id="panelRespuestas" class="panel">
                                    <h2>Respuestas incorrectas</h2>
                                    <div id="respuestasIncorrectas"></div>
                                </div>
                            </div>
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
</body>

</html>