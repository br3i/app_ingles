<!-- Content Wrapper. Contains page content -->
<br>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="row">
                            <?php
                            include_once '../Config/conexion.php';

                            $query = mysqli_query($con, "SELECT DISTINCT unidad FROM recurso JOIN unidad ON recurso.id_unidad = unidad.id_unidad ORDER BY recurso.id_recurso ASC") or die(mysqli_error($con));

                            while ($row = mysqli_fetch_assoc($query)) {
                                $unidad = $row['unidad'];

                                echo '
                                    <div class="col-md-4 unidad-container">
                                        <div class="d-flex align-items-center justify-content-center info-box bg-dark">
                                            <h3>Unidad ' . $unidad . '</h3>
                                            <div class="info-box-content">
                                                <select name="video_select" class="toggleIframeBtn video-select unidad-select bg-dark" onchange="loadVideo(this)" data-iframe="iframe1">';

                                // Agregar la opción por defecto
                                echo '<option value="">Seleccione un recurso</option>';

                                $unidadQuery = mysqli_query($con, "SELECT * FROM `recurso` WHERE id_unidad = '$unidad' ORDER BY `id_recurso` ASC") or die(mysqli_error($con));

                                while ($recRow = mysqli_fetch_assoc($unidadQuery)) {
                                    $nombreArchivo = $recRow['recurso_name'];
                                    $tipoArchivo = $recRow['tipo_archivo'];
                                    $ubicacionArchivo = $recRow['location'];

                                    if ($tipoArchivo == 'video') {
                                        $icono_archivo = 'fas fa-file-video';
                                    } elseif ($tipoArchivo == 'audio') {
                                        $icono_archivo = 'fas fa-file-audio';
                                    }

                                    echo '<option data-location="' . $ubicacionArchivo . '">' . $nombreArchivo . '</option>';
                                }

                                echo '
                                                </select>
                                            </div>    
                                        </div>
                                    </div>';
                            }
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
                                    'ruta_video' => $rowActividad['location'] // Agrega la ruta del video desde la tabla recurso
                                );
                                $idActividad++;
                            }

                            // Convierte el arreglo de preguntas en formato JSON
                            $questionsJsonActividad = json_encode($questionsActividad, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

                            // Elimina las comillas solo alrededor de los nombres de las propiedades
                            $questionsJsonActividad = preg_replace('/"([^"]+)"\s*:/', '$1:', $questionsJsonActividad);
                            ?>
                            <!-- Imprime el contenido JSON como una variable JavaScript global -->
                            <script>
                                var preguntasActividad = <?php echo $questionsJsonActividad; ?>;
                            </script>
                            <!-- /.card -->
                        </div>
                        <?php
                        echo '<div id="iframe-container" style="display: none;">
                                        <video id="video-iframe" controls style="width: 100%; height: 500px; border: none;">
                                        </video>
                                    </div>';
                        ?>
                        <!-- /.row -->

                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- Contenedor de la ventana modal -->
        <div id="myModal" class="modal col-md-4"
            style="position: absolute; top: 80%; left: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content" style="padding: 10px;"> <!-- Agrega un padding de 10px aquí -->
                <!-- Cerrar el modal -->
                <span class="close">&times;</span>
                <!-- Contenedor para el formulario de preguntas -->
                <div id="formulario-container"></div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    var preguntasActividad;

    function loadVideo(selectElement) {
        var videoLocation = selectElement.options[selectElement.selectedIndex].getAttribute('data-location');

        // Obtener el video y establecer su atributo src con la ubicación del video
        var videoElement = document.getElementById('video-iframe');
        videoElement.src = videoLocation;

        // Reproducir el video automáticamente
        videoElement.play();

        // Establecer el atributo "value" de la opción por defecto en todos los selects
        var defaultOption = document.querySelectorAll('.unidad-select option[value=""]');
        defaultOption.forEach(function (option) {
            option.selected = true;
        });

        // Mostrar el contenedor del iframe
        var iframeContainer = document.getElementById('iframe-container');
        iframeContainer.style.display = 'block';

        // Evento "ended" al elemento de video
        videoElement.addEventListener('ended', function () {
            // Se mostraran las preguntas después de que el video termine
            mostrarPreguntas();
        });
    }

    function mostrarPreguntas() {
        // Acceder a las preguntas desde la variable global
        console.log(preguntasActividad);

        // Obtener el contenedor donde se mostrarán las preguntas
        var formularioContainer = document.getElementById('formulario-container');

        // Limpiar el contenido anterior del contenedor
        formularioContainer.innerHTML = '';

        // Crear un formulario
        var formulario = document.createElement('form');

        // Recorrer las preguntas y crear elementos para cada una
        preguntasActividad.forEach(function (pregunta, index) {
            // Crear un elemento de pregunta (por ejemplo, un párrafo)
            var preguntaElement = document.createElement('p');
            preguntaElement.textContent = pregunta.pregunta;

            // Agregar la pregunta al formulario
            formulario.appendChild(preguntaElement);

            // Crear elementos de respuesta (por ejemplo, opciones de selección)
            pregunta.opciones.forEach(function (opcion, opcionIndex) {
                // Crear un elemento de opción (por ejemplo, un input tipo radio)
                var opcionElement = document.createElement('input');
                opcionElement.type = 'radio';
                opcionElement.name = 'pregunta' + index; // Nombre único para cada pregunta
                opcionElement.value = opcion;

                // Crear una etiqueta para la opción
                var labelElement = document.createElement('label');
                labelElement.textContent = opcion;

                // Crear un div para contener la opción y la etiqueta
                var optionContainer = document.createElement('div');
                optionContainer.appendChild(opcionElement);
                optionContainer.appendChild(labelElement);

                // Agregar la opción y la etiqueta al formulario
                formulario.appendChild(optionContainer);
            });
        });

        // Agregar un salto de línea para separar las preguntas del botón
        var lineBreak = document.createElement('br');
        formulario.appendChild(lineBreak);

        // Agregar un botón de envío al formulario
        var submitButton = document.createElement('input');
        submitButton.type = 'submit';
        submitButton.value = 'Enviar respuestas';
        formulario.appendChild(submitButton);

        // Configurar el evento onsubmit del formulario para validar respuestas
        formulario.onsubmit = function (event) {
            event.preventDefault(); // Evitar que el formulario se envíe automáticamente

            // Obtener todas las opciones seleccionadas por el usuario
            var respuestasUsuario = [];
            preguntasActividad.forEach(function (pregunta, index) {
                var opciones = document.querySelectorAll('input[name="pregunta' + index + '"]:checked');
                if (opciones.length === 1) {
                    respuestasUsuario.push(opciones[0].value);
                } else {
                    respuestasUsuario.push(""); // Si el usuario no seleccionó una respuesta, agregar una cadena vacía
                }
            });

            // Validar las respuestas aquí comparándolas con las respuestas correctas
            var respuestasCorrectas = preguntasActividad.map(function (pregunta) {
                return pregunta.respuesta;
            });

            var respuestasCorrectasUsuario = respuestasUsuario.map(function (respuesta, index) {
                return respuesta === respuestasCorrectas[index];
            });

            // Mostrar un mensaje de retroalimentación al usuario
            mostrarRetroalimentacion(respuestasCorrectasUsuario);
        };

        // Agregar el formulario al contenedor
        formularioContainer.appendChild(formulario);

        // Mostrar la ventana modal
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';
    }

    // Obtener el elemento de cierre y la ventana modal
    var modal = document.getElementById('myModal');
    var closeButton = document.getElementsByClassName('close')[0];

    // Cerrar la ventana modal al hacer clic en el botón de cierre
    closeButton.onclick = function () {
        modal.style.display = 'none';
    };

    // Cerrar la ventana modal al hacer clic en el fondo oscuro del modal
    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    function mostrarRetroalimentacion(respuestasCorrectasUsuario) {
        // Crear un elemento div para mostrar la retroalimentación
        var retroalimentacionElement = document.createElement('div');
        retroalimentacionElement.style.backgroundColor = 'white';
        retroalimentacionElement.style.border = '1px solid #ccc';
        retroalimentacionElement.style.padding = '20px';
        retroalimentacionElement.style.position = 'fixed';
        retroalimentacionElement.style.top = '50%';
        retroalimentacionElement.style.left = '50%';
        retroalimentacionElement.style.transform = 'translate(-50%, -50%)';
        retroalimentacionElement.style.zIndex = '9999';

        var retroalimentacionHTML = '<h2>Retroalimentación</h2>';

        for (var i = 0; i < respuestasCorrectasUsuario.length; i++) {
            var mensaje = respuestasCorrectasUsuario[i] ? 'Respuesta correcta' : 'Respuesta incorrecta';
            retroalimentacionHTML += '<p>Pregunta ' + (i + 1) + ': ' + mensaje + '</p>';
        }

        retroalimentacionElement.innerHTML = retroalimentacionHTML;

        // Agregar el elemento de retroalimentación al cuerpo del documento
        document.body.appendChild(retroalimentacionElement);

        // Cerrar la retroalimentación después de unos segundos (opcional)
        setTimeout(function () {
            document.body.removeChild(retroalimentacionElement);
        }, 1000); // Cierra la retroalimentación después de 1 segundos (ajusta el tiempo según tus necesidades)
    }


</script>