<?php
// Obtener el ID del usuario desde la sesión
$userId = $_SESSION['id_usuario'];
?>
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

                            $userId = $_SESSION['id_usuario'];

                            $query = mysqli_query($con, "SELECT DISTINCT unidad FROM recurso JOIN unidad ON recurso.id_unidad = unidad.id_unidad ORDER BY recurso.id_recurso ASC") or die(mysqli_error($con));

                            while ($row = mysqli_fetch_assoc($query)) {
                                $unidad = $row['unidad'];

                                echo '
                                    <div class="col-md-4 unidad-container">
                                        <div class="d-flex align-items-center justify-content-center info-box bg-dark">
                                            <h3>Unit ' . $unidad . '</h3>
                                            <div class="info-box-content">
                                                <select name="video_select" class="toggleIframeBtn video-select unidad-select bg-dark" onchange="loadVideo(this)" data-iframe="iframe1">';

                                // Agregar la opción por defecto
                                echo '<option value="">Select a resource</option>';

                                $unidadQuery = mysqli_query($con, "SELECT * FROM `recurso` WHERE id_unidad = '$unidad' ORDER BY `id_recurso` ASC") or die(mysqli_error($con));

                                while ($recRow = mysqli_fetch_assoc($unidadQuery)) {
                                    $nombreArchivo = $recRow['recurso_name'];
                                    $tipoArchivo = $recRow['tipo_archivo'];
                                    $ubicacionArchivo = $recRow['location'];
                                    $idRecurso = $recRow['id_recurso'];

                                    if ($tipoArchivo == 'video') {
                                        $icono_archivo = 'fas fa-file-video';
                                    } elseif ($tipoArchivo == 'audio') {
                                        $icono_archivo = 'fas fa-file-audio';
                                    }

                                    echo '<option data-location="' . $ubicacionArchivo . '" data-id-recurso="' . $idRecurso . '">' . $nombreArchivo . '</option>';
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
                        <select id="actividad-select" name="actividad_select" class="bg-dark" onchange="loadSelectedActivity()">
                            <option value="">Select an activity</option>
                        </select>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- Contenedor de la ventana modal -->
        <div id="myModal" class="modal col-md-4"
            style="position: absolute; top: 65%; left: 50%; transform: translate(-50%, -50%); max-width: 80%; max-height: 80vh; overflow-y: auto;">
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
// Variable global para almacenar temporalmente las actividades asociadas
    var actividadesAsociadasTemp;
    // Definir userId globalmente
    var userId = "<?php echo $userId; ?>";
    console.log("El valor de userId es: " + userId);

    // Función para actualizar la fecha de última actividad en la base de datos
    function actualizarTablaRacha() {
        console.log("Entra en la funcion para actualizar la tabla de racha");
        // Realizar una solicitud AJAX para actualizar la fecha de última actividad en la base de datos
        // Suponiendo que estés utilizando jQuery para realizar solicitudes AJAX
        $.ajax({
            url: 'actRacha.php',
            method: 'POST',
            data: { userId: userId },
            success: function(response) {
                console.log('Fecha de última actividad actualizada correctamente.');
            },
            error: function(xhr, status, error) {
                console.error('Error al actualizar la fecha de última actividad:', error);
            }
        });
    }

    //Funcion para cargar el select con actividades
    function loadSelectedActivity() {
        // Obtener el elemento select
        var actividadSelect = document.getElementById('actividad-select');

        // Obtener el valor seleccionado (id de la actividad)
        var selectedActivityId = actividadSelect.value;

        // Verificar que se haya seleccionado una actividad
        if (selectedActivityId) {
            // Encontrar la actividad correspondiente en actividadesAsociadasTemp
            var actividadSeleccionada = actividadesAsociadasTemp.find(function (actividad) {
                return actividad.id_actividad === parseInt(selectedActivityId);
            });

            // Verificar si se encontró la actividad
            if (actividadSeleccionada) {
                // Mostrar las preguntas de la actividad seleccionada
                mostrarPreguntas(actividadSeleccionada);
            } else {
                console.error('No se encontró la actividad con el id:', selectedActivityId);
            }
        } else {
            console.error('Ninguna actividad seleccionada.');
        }
    }


    // Función para cargar el video y las preguntas asociadas
    function loadVideo(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var videoLocation = selectedOption.getAttribute('data-location');
        var idRecursoSeleccionado = selectedOption.getAttribute('data-id-recurso');
        console.log("Id del recurso: " + idRecursoSeleccionado);

        // Limpiar contenido anterior
        var formularioContainer = document.getElementById('formulario-container');
        formularioContainer.innerHTML = '';

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

        // Obtener actividades asociadas al id del recurso seleccionado
        actividadesAsociadasTemp = obtenerActividadesAsociadas(idRecursoSeleccionado);
        console.log("En este punto tiene : " + actividadesAsociadasTemp.length);
        
        //Esto lo agregue para poder ver las actividades en el select
        // Llenar el menú select con las actividades asociadas
        var actividadSelect = document.getElementById('actividad-select');
        actividadSelect.innerHTML = '<option value="">Select an activity</option>';

        actividadesAsociadasTemp.forEach(function (actividad) {
            var option = document.createElement('option');
            option.value = actividad.id_actividad;
            option.textContent = actividad.descripcion;
            actividadSelect.appendChild(option);
        });

    
        videoElement.addEventListener('ended', function () {
            // Verificar si hay actividades asociadas cada vez que el video termine
            if (actividadesAsociadasTemp && actividadesAsociadasTemp.length !== 0) {
                console.log("Actividades asociadas:", JSON.stringify(actividadesAsociadasTemp, null, 2));
                // Mostrar solo una actividad al azar
                var actividadSeleccionada = actividadesAsociadasTemp[Math.floor(Math.random() * actividadesAsociadasTemp.length)];
                console.log("El valor que se manda en actividadSeleccionada es: ",JSON.stringify(actividadSeleccionada, null, 2));
                mostrarPreguntas(actividadSeleccionada);
            } else {
                // Limpiar el contenedor del formulario si no hay actividades asociadas
                formularioContainer.innerHTML = '';
            }
        });
    }

    // Función para obtener actividades asociadas a un recurso
    function obtenerActividadesAsociadas(idRecursoSeleccionado) {
        return preguntasActividad.filter(function (actividad) {
            return actividad.id_recurso === parseInt(idRecursoSeleccionado);
        });
    }

    // Función para mostrar la retroalimentación después de responder preguntas
    function mostrarRetroalimentacion(respuestasCorrectasUsuario, actividadSeleccionada, tipoActividad) {
        console.log('Mostrando retroalimentación');
        console.log('respuestasCorrectasUsuario: ' + JSON.stringify(respuestasCorrectasUsuario, null, 2));
        console.log('actividadSeleccionada: ' + JSON.stringify(actividadSeleccionada, null, 2));
        console.log('tipoActividad: ' + tipoActividad);

        // Cambiar el fondo solo de la opción seleccionada si es una pregunta de opciones
        if (tipoActividad === 'opciones') {
            console.log("1");
            var opcionSeleccionada = document.querySelector('input[name="pregunta"]:checked');
            if (opcionSeleccionada) {
                var esCorrecta = respuestasCorrectasUsuario;
                opcionSeleccionada.parentNode.style.backgroundColor = esCorrecta ? '#7CFF7C' : '#FF7C7C';
                actualizarTablaRacha();
            }
        }

        if (tipoActividad === 'opcionMultiple') {
            console.log("2");
            console.log("Llega con estos valores:", respuestasCorrectasUsuario);
            var opSelecionadas = respuestasCorrectasUsuario;
            // Cambiar el fondo de todas las opciones correctas y seleccionadas
            Object.keys(opSelecionadas).forEach(function (key) {
                console.log("Es: " + key);
                console.log("ademas: " + respuestasCorrectasUsuario[key]);
                var elemento = document.querySelector('input[value="' + key + '"]');
                //Esta seleccionada
                //Verificar si esta opcion esta dentro de actividadSeleccionada.respuesta
                if (actividadSeleccionada.respuesta.includes((key))){
                    //Si esta dentro de la respuesta
                    if (elemento) {
                        // Seleccionada y es correcta: pintar de verde
                        elemento.parentNode.style.backgroundColor = '#7CFF7C';
                    }
                } else {
                    if (elemento) {
                        // Seleccionada pero no es correcta: pintar de rojo
                        elemento.parentNode.style.backgroundColor = '#FF7C7C';
                    }
                }
            });

            // Mostrar mensaje de respuesta correcta o incorrecta
            respuestasCorrectasUsuario = false;
            actualizarTablaRacha();
        }

        // Mostrar mensaje específico para el caso de ordenar si la respuesta es correcta
        if (tipoActividad === 'ordenar') {
            if (respuestasCorrectasUsuario) {
                alert('Correct answer in the sorting activity!');
            } else {
                alert('Incorrect order. Please try again.');
            }
            actualizarTablaRacha();
        }

        // Mostrar mensaje de respuesta correcta o incorrecta para la actividad de completar
        if (tipoActividad === 'completar') {
            var mensaje = respuestasCorrectasUsuario ? 'Correct answers!' : 'Incorrect answers. Please try again.';
            actualizarTablaRacha();
            alert(mensaje);
        }

        if (tipoActividad === 'unir') {
            var mensajeUnir = respuestasCorrectasUsuario ? 'Connections are correct!' : 'Connections are incorrect. Please try again.';
            actualizarTablaRacha();
            alert(mensajeUnir);
        }

        if (tipoActividad === 'numerar') {
            console.log("Entra en numerar con estos valores:");
            Object.keys(respuestasCorrectasUsuario).forEach(function (palabra) {
                console.log(palabra, respuestasCorrectasUsuario[palabra]);
            });
            var mensajeUnir = respuestasCorrectasUsuario ? 'Numbers are correct!' : 'Numbers are incorrect. Please try again.';
            actualizarTablaRacha();
            alert(mensajeUnir);
        }

        // Cerrar la ventana modal si la respuesta es correcta (para todas las preguntas)
        if (respuestasCorrectasUsuario) {
            setTimeout(function () {
                var modal = document.getElementById('myModal');
                modal.style.display = 'none';
            }, 2000);  // Ajusta el tiempo según tus preferencias
        }
    }

    //Funcion para identificar el tipo de actividad
    function detectarTipoActividad(actividad) {
        var pregunta = actividad.pregunta.toLowerCase();
        console.log("Pregunta con esto dentro: " + pregunta);

        if (pregunta.includes('match') || pregunta.includes('link') || pregunta.includes('join') || pregunta.includes('unir')) {
            return 'unir';
        } else if (pregunta.includes('complete') || pregunta.includes('completar')) {
            return 'completar';
        }else if (pregunta.includes('number') || pregunta.includes('numera')) {
            return 'numerar';
        } else if (pregunta.includes('order') || pregunta.includes('ordenar')) {
            return 'ordenar';
        } else if (pregunta.includes('options') || pregunta.includes('opciones') || pregunta.includes('choose') || pregunta.includes('escoge') || pregunta.includes('select') || pregunta.includes('selecciona')) {
            if (
                pregunta.includes('multiple') ||
                pregunta.includes('opciones múltiples') ||
                pregunta.includes('select all that apply')||
                pregunta.includes('choose all')||
                pregunta.includes('selecciona todas')
            ) {
                return 'opcionMultiple';
            } else {
                return 'opciones';
            }
        }

        // Por defecto, asumir que es una actividad de opciones si no se encuentra ninguna palabra clave específica
        return 'opciones';
    }

    function mostrarPreguntas(actividadSeleccionada) {
        var tipoActividad = detectarTipoActividad(actividadSeleccionada);
        var formularioContainer = document.getElementById('formulario-container');
        formularioContainer.innerHTML = '';

        var formulario = document.createElement('form');
        var preguntaElement = document.createElement('p');
        preguntaElement.textContent = actividadSeleccionada.pregunta;
        formulario.appendChild(preguntaElement);

        // Construir el formulario según el tipo de actividad detectado
        if (tipoActividad === 'opciones') {
            actividadSeleccionada.opciones.forEach(function (opcion, opcionIndex) {
                // Crear elementos de opción para actividad de opciones
                var opcionElement = document.createElement('input');
                opcionElement.type = 'radio';
                opcionElement.name = 'pregunta';
                opcionElement.value = opcion;

                var labelElement = document.createElement('label');
                labelElement.textContent = opcion;

                var optionContainer = document.createElement('div');
                optionContainer.appendChild(opcionElement);
                optionContainer.appendChild(labelElement);

                formulario.appendChild(optionContainer);

                // Agregar evento para mostrar retroalimentación al hacer clic en una opción
                opcionElement.addEventListener('click', function () {
                    // Verificar si la opción seleccionada es la respuesta correcta
                    var respuestasCorrectasUsuario = opcionElement.value === actividadSeleccionada.respuesta;

                    // Mostrar retroalimentación
                    mostrarRetroalimentacion(respuestasCorrectasUsuario, actividadSeleccionada, tipoActividad);
                });
            });
        } else if (tipoActividad === 'unir') {
            console.log("Valor de la respuesta: " + actividadSeleccionada.respuesta);
            var palabraIzquierda = null;
            var palabraDerecha = null;
            var seleccionActual = null; // Variable para mantener el estado de la selección actual

            // Utilizar opcionesBarajadas para obtener las opciones barajadas correctamente
            var opcionesBarajadas = opcionesBarajadas(actividadSeleccionada.opciones.join(','));

            var contenedorGeneral = document.createElement('div');
            contenedorGeneral.className = 'contenedor-general';
            contenedorGeneral.style.display = 'flex';

            var columnaIzquierda = document.createElement('div');
            columnaIzquierda.className = 'columna-izquierda';
            columnaIzquierda.setAttribute("style", "width: 30%; border: 2px dashed #5f1818;");

            // Contenedor SVG para las líneas
            var svgContainer = document.createElementNS("http://www.w3.org/2000/svg", "svg");
            svgContainer.id = 'svg-container';
            svgContainer.style = 'flex: 1; width: 100%;'; // El SVG ocupa el espacio restante
            svgContainer.style.pointerEvents = 'none'; // Permitir clics a través del SVG

            var columnaDerecha = document.createElement('div');
            columnaDerecha.className = 'columna-derecha';
            columnaDerecha.style = "width: 30%";

            opcionesBarajadas.forEach(function (opcion, opcionIndex) {
                var palabraElement = document.createElement('div');
                palabraElement.className = 'draggable-word';
                palabraElement.textContent = opcion;
                palabraElement.setAttribute("style", "margin: 10px; border: 2px dashed red;");

                palabraElement.addEventListener('click', function () {
                    console.log("Estoy haciendo clic");
                    if (palabraIzquierda === null || palabraDerecha === null) {
                        
                        // Determinar la selección actual
                        if (seleccionActual === null) {
                            seleccionActual = opcionIndex % 2 === 0 ? 'derecha' : 'izquierda';
                            console.log("El valor de opcionIndex: " + opcionIndex);
                        }

                        if ((seleccionActual === 'izquierda' && opcionIndex % 2 === 0) ||
                            (seleccionActual === 'derecha' && opcionIndex % 2 !== 0)) {
                            palabraIzquierda = palabraElement;
                        } else {
                            palabraDerecha = palabraElement;
                        }

                        // Eliminar línea existente si hay una
                        

                        // Calcular las coordenadas de las palabras en porcentajes relativos al contenedor
                        var rectIzquierda = palabraIzquierda.getBoundingClientRect();
                        var rectDerecha = palabraDerecha.getBoundingClientRect();

                        // Coordenadas relativas al svgContainer
                        var y1 = ((rectIzquierda.top + rectIzquierda.bottom) / 2 - svgContainer.getBoundingClientRect().top) / svgContainer.clientHeight * 100;

                        // Coordenadas relativas al svgContainer, asegurándote de que no exceda el ancho del svgContainer
                        var y2 = ((rectDerecha.top + rectDerecha.bottom) / 2 - svgContainer.getBoundingClientRect().top) / svgContainer.clientHeight * 100;
                        
                        if(seleccionActual === "izquierda"){
                            removeExistingLine(palabraDerecha,palabraIzquierda );
                            svgContainer.appendChild(createLine(y2, y1));
                        }else{
                            removeExistingLine(palabraIzquierda, palabraDerecha);
                            svgContainer.appendChild(createLine(y1, y2));
                        }
                        // Crear y agregar la nueva línea SVG

                        // Limpiar las palabras seleccionadas y resetear la selección actual
                        palabraIzquierda = null;
                        palabraDerecha = null;
                        seleccionActual = null;
                    }
                });

                if (opcionIndex % 2 === 0) {
                    columnaDerecha.appendChild(palabraElement);
                } else {
                    columnaIzquierda.appendChild(palabraElement);
                }
            });

            // Crear el botón "Send"
            var sendButton = document.createElement('button');
            sendButton.textContent = 'Check answer';
            sendButton.className = 'order-button';
            sendButton.type = 'button';
            sendButton.addEventListener('click', function () {
                // Lógica para comprobar respuestas
                var respuestasUsuario = obtenerRespuestasUsuarioUnir();
                var respuestasCorrectas = comprobarRespuestasUnir(respuestasUsuario, actividadSeleccionada.respuesta);

                // Mostrar retroalimentación
                mostrarRetroalimentacion(respuestasCorrectas, actividadSeleccionada, tipoActividad);
            });

            contenedorGeneral.appendChild(columnaIzquierda);
            contenedorGeneral.appendChild(svgContainer);
            contenedorGeneral.appendChild(columnaDerecha);
            contenedorGeneral.appendChild(sendButton);

            formulario.appendChild(contenedorGeneral);
        } else if (tipoActividad === 'completar') {
            // Div que contendrá las opciones y los espacios para completar
            var completarContainer = document.createElement('div');

            // Mostrar las respuestas arriba del formulario
            var respuestasDiv = document.createElement('div');
            respuestasDiv.textContent = 'Options: ' + actividadSeleccionada.respuesta;
            completarContainer.appendChild(respuestasDiv);

            // Div que contendrá las opciones
            var opcionesContainer = document.createElement('div');

            // Separar las opciones de la respuesta
            var respuestas = actividadSeleccionada.respuesta.split(',');

            // Iterar sobre cada opción
            actividadSeleccionada.opciones.forEach(function (opcion) {
                // Div para cada opción
                var opcionDiv = document.createElement('div');
                opcionDiv.style.display = 'flex';

                // Separar palabras en la opción
                var palabrasOpcion = opcion.split(' ');

                // Separar palabras en la respuesta
                var palabrasRespuesta = actividadSeleccionada.respuesta.split(',');

                // Iterar sobre cada palabra en la opción
                palabrasOpcion.forEach(function (palabraOpcion, index) {
                    // Limpiar la palabra de caracteres especiales
                    var palabraLimpia = palabraOpcion.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()]/g, "");
                    // Crear elemento para cada palabra
                    var palabraElement = document.createElement('span');
                    // Dar atributo de margin para que se separen entre palabras
                    palabraElement.innerHTML = palabraLimpia + ' ';
                    palabraElement.setAttribute("style", "margin: 4px;");

                    // Agregar un salto de línea después de cada palabra (excepto la última)
                    if (index < palabrasOpcion.length - 1) {
                        palabraElement.innerHTML += '<br>';
                    } else {
                        // No añadir salto de línea después de la última palabra
                        palabraElement.innerHTML += ' ';
                    }

                    // Verificar si la palabra está en la respuesta
                    if (palabrasRespuesta.includes(palabraLimpia)) {
                        console.log(`Valor en palabrasRespuesta: ${palabrasRespuesta} y el valor en palabraOpcion: ${palabraLimpia}`);
                        // Crear espacio para completar (input)
                        var completarEspacioElement = document.createElement('input');
                        completarEspacioElement.type = 'text';
                        completarEspacioElement.name = 'respuesta_completar';
                        opcionDiv.appendChild(completarEspacioElement);
                    } else {
                        // Mostrar la palabra normalmente
                        palabraElement.textContent = palabraOpcion + ' ';
                        opcionDiv.appendChild(palabraElement);
                    }
                });

                // Agregar div de opción al contenedor de opciones
                opcionesContainer.appendChild(opcionDiv);
            });

            // Agregar las opciones al contenedor principal
            completarContainer.appendChild(opcionesContainer);

            // Agregar un contenedor para el botón de comprobar respuestas
            var botonContainer = document.createElement('div');

            // Crear el botón para comprobar respuestas
            var comprobarBoton = document.createElement('button');
            comprobarBoton.textContent = 'Check Answers';
            comprobarBoton.type = 'button';
            comprobarBoton.addEventListener('click', function () {
                // Lógica para comprobar respuestas
                var respuestasUsuario = obtenerRespuestasUsuarioCompletar();
                var respuestasCorrectas = comprobarRespuestasCompletar(respuestasUsuario, actividadSeleccionada.respuesta);

                // Mostrar retroalimentación
                mostrarRetroalimentacion(respuestasCorrectas, actividadSeleccionada, tipoActividad);
            });

            // Agregar el botón al contenedor
            botonContainer.appendChild(comprobarBoton);

            // Agregar el contenedor del botón al formulario
            completarContainer.appendChild(botonContainer);

            // Agregar el contenedor principal al formulario
            formulario.appendChild(completarContainer);
        } else if (tipoActividad === 'ordenar') {
            // Coloca las palabras en un distinto orden, aleatoriamente
            var opcionesBarajadas = actividadSeleccionada.opciones.sort(function () {
                return 0.5 - Math.random();
            });

            // Crear el contenedor principal
            var dragdropContainer = document.createElement('div');
            dragdropContainer.id = 'dragdropContainer';
            dragdropContainer.className = 'dragdrop-container';

            // Crear el contenedor para las palabras
            var wordContainer = document.createElement('div');
            wordContainer.id = 'wordContainer';
            wordContainer.className = 'word-container';
            wordContainer.style = 'width: 40%; min-height: 50%; margin: 20px; border: 2px dashed #c7d2e2;';

            // Crear un div para cada palabra
            opcionesBarajadas.forEach(function (opcion, opcionIndex) {
                var originalWord = document.createElement('div');
                originalWord.className = 'draggable-word';
                originalWord.textContent = opcion;

                // Agregar evento de clic a cada palabra
                originalWord.addEventListener("click", function () {
                    // Clonar la palabra original
                    var clonedWord = originalWord.cloneNode(true);

                    // Agregar evento para quitar la palabra al hacer clic
                    clonedWord.addEventListener("click", function () {
                        answerContainer.removeChild(clonedWord);
                        originalWord.style.display = 'block'; // Mostrar la palabra original nuevamente en el contenedor original
                    });

                    answerContainer.appendChild(clonedWord);
                    originalWord.style.display = 'none'; // Ocultar la palabra original en el contenedor original
                });

                wordContainer.appendChild(originalWord);
            });

            // Crear el contenedor para la respuesta
            var answerContainer = document.createElement('div');
            answerContainer.id = 'answerContainer';
            answerContainer.className = 'answer-container';
            answerContainer.textContent = 'ANSWER';
            answerContainer.style = 'width: 40%; min-height: 50%; margin: 20px; border: 2px dashed #5f1818;';

            // Agregar evento de clic para quitar palabra del contenedor de respuesta
            answerContainer.addEventListener("click", function () {
                var lastDroppedWord = answerContainer.lastElementChild;
                if (lastDroppedWord) {
                    wordContainer.appendChild(originalWord); // Devolver la palabra original al contenedor original
                    lastDroppedWord.parentNode.removeChild(lastDroppedWord); // Eliminar la palabra clonada del contenedor de respuesta
                    originalWord.style.display = 'block'; // Mostrar la palabra original nuevamente en el contenedor original
                }
            });

            // Crear el botón "Send"
            var sendButton = document.createElement('button');
            sendButton.textContent = 'Check answer';
            sendButton.className = 'order-button';
            sendButton.type = 'button';

            // Agregar los contenedores y el botón al contenedor principal
            dragdropContainer.appendChild(wordContainer);
            dragdropContainer.appendChild(answerContainer);
            dragdropContainer.appendChild(sendButton);

            // Agregar el contenedor principal al formulario
            formulario.appendChild(dragdropContainer);

            // Agregar evento al botón "Send"
            sendButton.addEventListener('click', function () {
                // Obtener todas las palabras en el contenedor de respuesta
                var answerWords = answerContainer.querySelectorAll('.draggable-word');

                // Obtener las palabras correctas en el orden correcto desde la respuesta en la base de datos
                var respuestaCorrecta = actividadSeleccionada.respuesta.split(' ');

                // Verificar si la respuesta del usuario coincide con la respuesta correcta
                var respuestasCorrectasUsuario = Array.from(answerWords).map(word => word.textContent).join(' ') === actividadSeleccionada.respuesta;

                // Mostrar retroalimentación
                mostrarRetroalimentacion(respuestasCorrectasUsuario, actividadSeleccionada, tipoActividad);
            });
            
        }else if(tipoActividad === 'opcionMultiple'){
            actividadSeleccionada.opciones.forEach(function (opcion, opcionIndex) {
                // Crear elementos de opción para actividad de opciones múltiples
                var opcionElement = document.createElement('input');
                opcionElement.type = 'checkbox';  // Cambiar a checkbox
                opcionElement.name = 'pregunta';
                opcionElement.value = opcion;

                var labelElement = document.createElement('label');
                labelElement.textContent = opcion;

                var optionContainer = document.createElement('div');
                optionContainer.appendChild(opcionElement);
                optionContainer.appendChild(labelElement);

                formulario.appendChild(optionContainer);
            });

            // Crear el botón "Check answer"
            var comprobarBoton = document.createElement('button');
            comprobarBoton.textContent = 'Check answer';
            comprobarBoton.className = 'order-button';
            comprobarBoton.type = 'button';
            
            // Agregar evento para comprobar respuestas
            comprobarBoton.addEventListener('click', function () {
                // Lógica para comprobar respuestas
                var respuestasUsuario = obtenerRespuestasUsuarioMultiple();
                var respuestasCorrectas = comprobarRespuestasMultiple(respuestasUsuario, actividadSeleccionada.respuesta);

                // Mostrar retroalimentación
                mostrarRetroalimentacion(respuestasCorrectas, actividadSeleccionada, tipoActividad);
            });

            formulario.appendChild(comprobarBoton);
        } else if (tipoActividad === 'numerar') {
            console.log("entramos en numerar");

            var optionContainer = document.createElement('div');

            // Obtener las opciones de la actividad seleccionada
            var opcionesActividad = actividadSeleccionada.opciones;
            //imprimr los valors de opciones en formato json
            console.log("Valores de opciones: " + JSON.stringify(opcionesActividad, null, 2));

            for (var i = 0; i < opcionesActividad.length; i ++) {
                // Crear span para la parte izquierda
                var txtIzquierda = document.createElement('div');
                txtIzquierda.textContent = opcionesActividad[i];

                // Crear select para la parte derecha
                var selectDerecha = document.createElement('select');
                selectDerecha.className = "respuestaNumerar";
                // Añadir opciones al select (números)
                for (var j = 1; j <= opcionesActividad.length; j++) {  // Ajusta según la cantidad de opciones
                    var option = document.createElement('option');
                    option.value = j;
                    option.text = j;
                    selectDerecha.appendChild(option);
                }

                // Agregar elementos al contenedor
                optionContainer.appendChild(txtIzquierda);
                optionContainer.appendChild(selectDerecha);
            }

            formulario.appendChild(optionContainer);

            // Crear el botón "Send"
            var sendButton = document.createElement('button');
            sendButton.textContent = 'Check answer';
            sendButton.className = 'order-button';
            sendButton.type = 'button';

            sendButton.addEventListener('click', function () {
                // Obtener las respuestas del usuario
                var respuestasUsuario = obtenerRespuestasUsuarioNumber();
                console.log("En la funcion principal Respuestas del usuario: " + JSON.stringify(respuestasUsuario, null, 2));

                // Obtener las respuestas correctas
                var respuestasCorrectas = actividadSeleccionada.respuesta.split(',');
                console.log("Respuestas correctas: " + respuestasCorrectas);

                // Verificar si las respuestas del usuario coinciden con las respuestas correctas
                var respuestasCorrectasUsuario = comprobarRespuestasNumber(respuestasUsuario, respuestasCorrectas);

                // Mostrar retroalimentación
                mostrarRetroalimentacion(respuestasCorrectasUsuario, actividadSeleccionada, tipoActividad);
            });

            formulario.appendChild(sendButton);
        }

        // Agregar el formulario al contenedor
        formularioContainer.appendChild(formulario);

        // Mostrar la ventana modal
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';


        
        //NUMERAR
        function obtenerRespuestasUsuarioNumber(){
             var respuestasUsuario = [];

            // Iterar sobre los elementos select
            document.querySelectorAll('select.respuestaNumerar').forEach(function (select) {
                // Obtener el texto asociado al select
                var frase = select.previousElementSibling.textContent.trim();

                // Obtener el valor seleccionado y agregarlo al array de respuestasUsuario
                respuestasUsuario.push({ frase: frase, respuesta: select.value });
            });

            return respuestasUsuario;
        }

        function comprobarRespuestasNumber(respuestasUsuario, respuestasCorrectas) {
            // Imprimir todos los valores dentro de respuestasUsuario
            console.log("func comprobarRespuestas del usuario: " + JSON.stringify(respuestasUsuario, null, 2));
            var resultados = false;

            var unidoNumerar = '';
            respuestasUsuario.forEach(function (respuestaUsuario) {
                console.log("El valor de respuestaUsuario es " + JSON.stringify(respuestaUsuario, null, 2));
                unidoNumerar = unidoNumerar + respuestaUsuario.frase + respuestaUsuario.respuesta;
                console.log("Y el de unidoNumerar es " + JSON.stringify(unidoNumerar, null, 2));
            });

            // Separar en elementos unidoNumerar cada que encuentre un número, pero el número también se debe incluir
            unidoNumerar = unidoNumerar.split(/(\d+)/).filter(Boolean);
            console.log("El valor de unidoNumerar es " + JSON.stringify(unidoNumerar, null, 2));

            // Convertir respuestasCorrectas a un objeto para facilitar la comparación
            var respuestasCorrectasObj = {};
            for (var i = 0; i < respuestasCorrectas.length; i += 2) {
                respuestasCorrectasObj[respuestasCorrectas[i]] = parseInt(respuestasCorrectas[i + 1], 10);
                //imprimir el valor
                console.log("El valor de respuestasCorrectasObj es " + JSON.stringify(respuestasCorrectasObj, null, 2));
            }

           // Verificar si todos los pares de valores coinciden
            resultados = respuestasUsuario.every(function (respuestaUsuario) {
                // Obtener la frase y respuesta del usuario
                var fraseUsuario = respuestaUsuario.frase;
                var respuestaUsuarioValor = parseInt(respuestaUsuario.respuesta, 10);

                // Obtener la respuesta correcta para la frase del usuario
                var respuestaCorrecta = respuestasCorrectasObj[fraseUsuario];

                // Comparar respuesta del usuario con la respuesta correcta
                return respuestaUsuarioValor === respuestaCorrecta;
            });

            return resultados;
                }



        //OPCION MULTIPLE
        // Función para obtener las respuestas seleccionadas por el usuario en una actividad de opciones múltiples
        function obtenerRespuestasUsuarioMultiple() {
            var opcionesSeleccionadas = document.querySelectorAll('input[name="pregunta"]:checked');
            var respuestasUsuario = [];

            opcionesSeleccionadas.forEach(function (opcionSeleccionada) {
                respuestasUsuario.push(opcionSeleccionada.value);
            });

            // Imprime en consola los valores de respuestasUsuario
            console.log("Respuestas del usuario: " + respuestasUsuario);
            return respuestasUsuario;
        }

        // Función para comprobar las respuestas en una actividad de opciones múltiples
        function comprobarRespuestasMultiple(respuestasUsuario, respuestasCorrectas) {
            var respuestasCorrectasArray = respuestasCorrectas.split(",").map(function(item) {
                return item.trim();
            });

            // Inicializar el objeto opcionesCorrectas
            var opcionesCorrectas = {};

            // Iterar sobre las respuestas del usuario y marcar como true o false según si está en las respuestas correctas
            respuestasUsuario.forEach(function(opcion) {
                opcionesCorrectas[opcion] = respuestasCorrectasArray.includes(opcion);
            });

            console.log("2 -Respuestas del usuario: " + respuestasUsuario);
            console.log("Respuestas correcras: " + respuestasCorrectas);
            return opcionesCorrectas;
        }







        //ORDENAR
        //Funcion para barajar las opciones que llegan en la pregunta de unir
        function opcionesBarajadas(datos) {
            var opciones = datos.split(',');
            var preguntas = [];
            var respuestas = [];

            // Separar preguntas y respuestas
            for (var i = 0; i < opciones.length; i++) {
                if (i % 2 === 0) {
                    preguntas.push(opciones[i]);
                } else {
                    respuestas.push(opciones[i]);
                }
            }

            // Barajar solo las preguntas
            preguntas.sort(function () {
                return 0.5 - Math.random();
            });

            // Reconstruir el arreglo barajado con preguntas y respuestas asociadas
            var opcionesBarajadas = [];
            for (var j = 0; j < preguntas.length; j++) {
                opcionesBarajadas.push(preguntas[j]);
                opcionesBarajadas.push(respuestas[j]);
            }

            return opcionesBarajadas;
        }





        //COMPLETAR
        // Función para obtener las respuestas del usuario
        function obtenerRespuestasUsuarioCompletar() {
            var respuestasUsuario = [];
            // Obtener respuestas de los inputs (ajusta según tu implementación)
            var inputs = document.querySelectorAll('input[name="respuesta_completar"]');
            inputs.forEach(function (input) {
                //imprimir con console loge cada uno de respuestasUsuario.push(input.value);
                console.log("Respuestas del usuario: " + input.value);
                respuestasUsuario.push(input.value);
            });
            return respuestasUsuario;
        }

        // Función para comparar las respuestas del usuario con las respuestas correctas
        function comprobarRespuestasCompletar(respuestasUsuario, respuestasCorrectas) {
            console.log("Respuestas correctas:", respuestasCorrectas);

            // Convertir la cadena de respuestasCorrectas en un array de palabras
            var respuestasCorrectasArray = respuestasCorrectas.split(",").map(function (word) {
                return word.trim().toLowerCase();
            });

            var resultado = respuestasUsuario.every(function (respuestaUsuario, index) {
                var coincidencia = respuestaUsuario.trim().toLowerCase() === respuestasCorrectasArray[index];
                console.log(`Respuesta Usuario: ${respuestaUsuario}, Respuesta Correcta: ${respuestasCorrectasArray[index]}, Coincidencia: ${coincidencia}`);
                return coincidencia;
            });

            console.log("Resultado final:", resultado);

            return resultado;
        }








        //UNIR
        // Función para eliminar la línea existente entre dos palabras 
        function removeExistingLine(palabraIzquierda, palabraDerecha) {
            var existingLines = findExistingLines(palabraIzquierda, palabraDerecha);
            existingLines.forEach(line => {
                line.parentNode.removeChild(line);
            });
        }

        // Función para encontrar las líneas existentes entre dos palabras
        function findExistingLines(palabraIzquierda, palabraDerecha) {
            console.log(`Valor en palabraIzquierda: ${palabraIzquierda.textContent}`);
            console.log(`Valor en palabraDerecha: ${palabraDerecha.textContent}`);

            var lines = svgContainer.getElementsByTagName('line');
            var existingLines = [];

            for (var i = 0; i < lines.length; i++) {
                var line = lines[i];
                console.log(`Línea existente - dataset.from: ${line.dataset.from}, dataset.to: ${line.dataset.to}`);

                // Verificar si la línea está conectada a las mismas palabras
                if (
                    (line.dataset.from === palabraIzquierda.textContent && line.dataset.to !== palabraDerecha.textContent) ||
                    (line.dataset.from === palabraDerecha.textContent && line.dataset.to !== palabraIzquierda.textContent) ||
                    (line.dataset.to === palabraIzquierda.textContent && line.dataset.from !== palabraDerecha.textContent) ||
                    (line.dataset.to === palabraDerecha.textContent && line.dataset.from !== palabraIzquierda.textContent)
                ) {
                    console.log('¡Encontró una línea existente entre las mismas palabras!');
                    existingLines.push(line);
                }
            }

            console.log(`Número de líneas existentes encontradas: ${existingLines.length}`);
            return existingLines;
        }

        //Funcion para obtener las uniones que hizo el usuario
        function obtenerRespuestasUsuarioUnir(){
            var lines = svgContainer.getElementsByTagName('line');
            var respuestasUsuario = [];

            for (var i = 0; i < lines.length; i++) {
                var line = lines[i];
                var palabraIzquierda = line.dataset.from;
                var palabraDerecha = line.dataset.to;
                respuestasUsuario.push(palabraIzquierda, palabraDerecha);
            }
            //Imprime en consola los valores de respuestasUsuarios
            console.log("Respuestas del usuario: " + respuestasUsuario);
            return respuestasUsuario;
        }

        // Función para comprobar las respuestas
        function comprobarRespuestasUnir(respuestasUsuario, respuestasCorrectas) {
            // Obtener todas las líneas existentes
            var lines = svgContainer.getElementsByTagName('line');
            
            // Almacena las conexiones establecidas por el usuario
            var conexionesUsuario = respuestasUsuario;

            //imprimir todas las conexionesUsuario almacenadas como array
            for(var i=0; i<conexionesUsuario.length; i++){
                console.log("Conexiones del usuario: " + conexionesUsuario[i]);
            }

            var respuestasCorrectasArray = respuestasCorrectas.split(",");

            //imprimir los valores de respuestasCorrectas con un ciclo for
            for(var i=0; i<respuestasCorrectasArray.length; i++){
                console.log("Respuestas correctas: " + respuestasCorrectasArray[i]);
            }

            // Verificar si las conexiones del usuario coinciden con las respuestas correctas
            var conexionesCorrectas = 0;
            var respuestaUnir = false;

            for (var i = 0; i < conexionesUsuario.length; i+=2) {
                var op1 = conexionesUsuario[i];
                var op2 = conexionesUsuario[i + 1];

                for (var j = 0; j < respuestasCorrectasArray.length; j = j + 2) {
                    var op3 = respuestasCorrectasArray[j];
                    var op4 = respuestasCorrectasArray[j + 1];

                    console.log("Valor de op1: " + op1);
                    console.log("Valor de op2: " + op2);
                    console.log("Valor de op3: " + op3);
                    console.log("Valor de op4: " + op4);

                    if ((op1 === op3 && op2 === op4) || (op1 === op4 && op2 === op3)) {
                        conexionesCorrectas = conexionesCorrectas+1;
                        // Remover los elementos encontrados de ambos arrays
                        respuestasCorrectasArray.splice(j, 2);
                        break;
                    }
                }

                // Si no se encontró la conexión, entonces no es correcta
                if (conexionesCorrectas === conexionesUsuario.length/2) {
                    respuestaUnir = true;
                    console.log("respuestaUnir = true");
                }
            }

            return respuestaUnir;
        }
       
        // Función para crear una línea SVG
        function createLine(y1, y2) {
            try {
                var line = document.createElementNS("http://www.w3.org/2000/svg", "line");
                line.setAttribute("x1", "0%");
                line.setAttribute("y1", y1 + "%");
                line.setAttribute("x2", "100%");
                line.setAttribute("y2", y2 + "%");
                line.setAttribute("stroke", "Green");
                line.setAttribute("stroke-width", "2"); // Grosor relativo
                console.log(`Valores que se grafican al final y1: ${y1}, y2: ${y2} `);
                line.dataset.from = palabraIzquierda.textContent; // Almacenar información de las palabras conectadas
                line.dataset.to = palabraDerecha.textContent;
                return line;
            } catch (error) {
                console.error("Error creating line:", error);
                return null;
            }
        }
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
</script>
