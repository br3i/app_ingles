url = window.location.href;
if (url.includes('modulo=sopaLetras')) {
    // Llamar a la función para generar la sopa de letras cuando se cargue la página
    window.onload = function() {
        generarSopaLetras();
    };

    // Función para generar una sopa de letras dinámica
    function generarSopaLetras() {
        // Tamaño de la sopa de letras
        var filas = 10; // Cambia este valor según el tamaño que desees
        var columnas = 10; // Cambia este valor según el tamaño que desees
        
        // Array con las letras posibles para la sopa de letras
        var letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

        // Palabras a encontrar
        var palabras = [
            "simpsons", "moon", "war", "avengers", "fast", "springfield", "homer", "bart", "lisa", "maggie", "marge", "krusty", "apu", "burns", "smithers", "flanders", "moonwalk", "astronaut", "space", "orbit", "apollo", "neil", "lunar", "nasa", "rocket", "astronomy", "hitler", "allies", "axis", "nazis", "stalin", "pearl", "dunkirk", "holocaust", "hiroshima", "japan", "ironman", "thor", "hulk", "captain", "blackwidow", "shield", "ultron", "vision", "tony", "stark", "race", "speed", "furious", "cars", "dom", "letty", "mia", "shaw", "han"];

        var palabrasSeleccionadas = []; // Aquí se guardarán las palabras seleccionadas

        // Obtener la tabla donde se mostrará la sopa de letras
        var tabla = document.getElementById("sopaLetras");
        
        // Limpiar tabla
        tabla.innerHTML = '';

        // Crear una matriz vacía para la sopa de letras
        var sopaLetras = [];
        for (var i = 0; i < filas; i++) {
            sopaLetras[i] = [];
            for (var j = 0; j < columnas; j++) {
                sopaLetras[i][j] = '';
            }
        }

        // Función para seleccionar una palabra aleatoria y colocarla en la sopa de letras
        function seleccionarPalabra() {
            var palabraIndex = Math.floor(Math.random() * palabras.length);
            var palabra = palabras[palabraIndex];
            var filaInicial = Math.floor(Math.random() * filas);
            var columnaInicial = Math.floor(Math.random() * columnas);
            var direccion = Math.random() < 0.5 ? 'horizontal' : 'vertical';

            // Verificar si la palabra cabe en la dirección elegida
            var palabraCabe = true;
            if (direccion === 'horizontal' && columnaInicial + palabra.length > columnas) {
                palabraCabe = false;
            } else if (direccion === 'vertical' && filaInicial + palabra.length > filas) {
                palabraCabe = false;
            }

            // Variable para controlar si la palabra se coloca correctamente
            var palabraColocada = false;

            // Colocar la palabra en la sopa de letras si cabe
            if (palabraCabe) {
                for (var i = 0; i < palabra.length; i++) {
                    if (direccion === 'horizontal') {
                        // Verificar si la casilla está vacía o contiene la misma letra
                        if (sopaLetras[filaInicial][columnaInicial + i] !== '' && sopaLetras[filaInicial][columnaInicial + i] !== palabra.charAt(i)) {
                            return false; // Palabra no puede ser colocada en esta dirección
                        }
                        sopaLetras[filaInicial][columnaInicial + i] = palabra.toUpperCase().charAt(i);
                    } else {
                        // Verificar si la casilla está vacía o contiene la misma letra
                        if (sopaLetras[filaInicial + i][columnaInicial] !== '' && sopaLetras[filaInicial + i][columnaInicial] !== palabra.charAt(i)) {
                            palabraCabe = false; // Palabra no puede ser colocada en esta dirección
                            break;
                        }
                        sopaLetras[filaInicial + i][columnaInicial] = palabra.toUpperCase().charAt(i);
                    }
                }
                
                // Si la palabra se colocó correctamente, agregarla a la lista de palabras seleccionadas
                if (palabraCabe) {
                    palabrasSeleccionadas.push(palabra);
                    palabraColocada = true;
                }
            }

            // Si la palabra se colocó correctamente, eliminarla de la lista de palabras
            if (palabraColocada) {
                palabras.splice(palabraIndex, 1);
            }
        }

        // Seleccionar palabras hasta que haya 5 palabras seleccionadas o no haya más palabras para seleccionar
        while (palabrasSeleccionadas.length < 5 && palabras.length > 0) {
            seleccionarPalabra();
        }

        // Rellenar el resto de la sopa de letras con letras aleatorias
        for (var i = 0; i < filas; i++) {
            for (var j = 0; j < columnas; j++) {
                if (sopaLetras[i][j] === '') {
                    sopaLetras[i][j] = letras[Math.floor(Math.random() * letras.length)];
                }
            }
        }

        // Generar la tabla de la sopa de letras en HTML
        for (var i = 0; i < filas; i++) {
            var fila = tabla.insertRow(i);
            for (var j = 0; j < columnas; j++) {
                var casilla = fila.insertCell(j);
                casilla.textContent = sopaLetras[i][j];
            }
        }
        console.log("Palabras seleccionadas:", palabrasSeleccionadas);
        // Mostrar las palabras a encontrar
        var listaPalabras = document.getElementById('palabras');
        palabrasSeleccionadas.forEach(function(palabra) {
            var li = document.createElement('li');
            li.textContent = palabra.toUpperCase();
            listaPalabras.appendChild(li);
        });

        // Variables para seguimiento de selección de letras
        var letraInicial = null;
        var letraFinal = null;
        var palabraSeleccionada = '';

        // Agregar eventos de mouse a las celdas de la tabla para la selección de letras
        tabla.addEventListener('mousedown', function(event) {
            if (event.target.tagName === 'TD') {
                letraInicial = event.target;
                letraFinal = event.target;
                palabraSeleccionada = event.target.textContent;
                event.target.classList.add('seleccionada');
            }
        });

        tabla.addEventListener('mouseover', function(event) {
            if (event.target.tagName === 'TD' && letraInicial) {
                letraFinal = event.target;
                palabraSeleccionada += event.target.textContent;
                event.target.classList.add('seleccionada');
            }
        });

        var nTachadas = 0;
        tabla.addEventListener('mouseup', function(event) {
            if (letraInicial) {
                if (palabrasSeleccionadas.includes(palabraSeleccionada.toLowerCase())) {
                    alert('¡Encontraste la palabra: ' + palabraSeleccionada + '!');
                    // Agregar clase 'encontrada' a las celdas de la palabra encontrada
                    var celdasPalabra = document.querySelectorAll('.seleccionada');
                    celdasPalabra.forEach(function(celda) {
                        celda.classList.add('encontrada');
                        celda.classList.add("a"+nTachadas);
                    });
                    // Tachar la palabra encontrada en la lista de palabras
                    var elementosLi = listaPalabras.getElementsByTagName('li');
                    for (var i = 0; i < elementosLi.length; i++) {
                        if (elementosLi[i].textContent === palabraSeleccionada) {
                            elementosLi[i].classList.add('tachado');
                            nTachadas++;
                            break;
                        }
                    }
                    if(nTachadas == 5){
                        alert('¡Felicidades! Has encontrado todas las palabras');
                        btnReiniciar.style.display = 'block';
                    }
                }
                letraInicial = null;
                letraFinal = null;
                palabraSeleccionada = '';
                var celdasSeleccionadas = document.querySelectorAll('.seleccionada');
                celdasSeleccionadas.forEach(function(celda) {
                    celda.classList.remove('seleccionada');
                });
            }
        });
        
        // Función para reiniciar el juego
        function reiniciarJuego() {
            window.location.href = 'http://localhost/app_ingles/Vista/panel.php?modulo=sopaLetras';
        }


        // Asignar la función reiniciarJuego al evento click del botón de reinicio
        var btnReiniciar = document.getElementById('btn-reiniciar');
        btnReiniciar.addEventListener('click', reiniciarJuego);
    }

}