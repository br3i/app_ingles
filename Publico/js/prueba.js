let questions;
let selectedUnitIndex = -1; // Inicializar con un valor que no corresponda a ningún índice válido
let unidadId;

// En tu script JavaScript (prueba.js)
document.addEventListener("DOMContentLoaded", function () {
    const currentPath = "/app_ingles/Vista/panel.php";
    const isPruebaPage = window.location.pathname.includes(currentPath) && window.location.search.includes("modulo=prueba");

    if (isPruebaPage) {
        console.log("11");
        const unidadButtons = document.querySelectorAll(".unidad-buttons .unidad-btn");
        const startBtn = document.querySelector(".start_btn");

        unidadButtons.forEach(function (button, index) {
            console.log("22");
            button.addEventListener("click", function () {
                unidadId = button.getAttribute("data-id");
                console.log("Clic en la unidad con ID:", unidadId);

                // Filtrar preguntas por el id_unidad
                const preguntasFiltradas = preguntas.filter(function (pregunta) {
                    console.log("nose: " + JSON.stringify(pregunta.id_unidad));

                    return pregunta.id_unidad === parseInt(unidadId);
                });

                selectedUnitIndex = index; // Almacena el índice de la unidad seleccionada

                // Oculta los demás botones de unidad
                unidadButtons.forEach((otherButton, otherIndex) => {
                    if (otherIndex !== index) {
                        otherButton.style.display = "none";
                    }
                });

                console.log("aaqui: " + preguntasFiltradas);
                console.log("aaqui: " + preguntasFiltradas.length);

                if (preguntasFiltradas.length > 0) {
                    // Mostrar el botón de inicio si hay preguntas para la unidad
                    startBtn.removeAttribute("hidden");

                    // Obtener solo las primeras 10 preguntas después de reorganizarlas
                    let allQuestions = preguntasFiltradas.slice(); // Copiar el array para no modificar el original
                    let shuffledQuestions = shuffleArray(allQuestions);

                    // Seleccionar solo las primeras 10 preguntas después de reorganizarlas
                    let selectedQuestions = shuffledQuestions.slice(0, 10);

                    // Asignar las preguntas reorganizadas y seleccionadas a la variable "questions"
                    questions = selectedQuestions;
                    console.log("Preguntas reorganizadas y seleccionadas:", questions);
                } else {
                    // Ocultar el botón de inicio si no hay preguntas para la unidad
                    startBtn.setAttribute("hidden", "true");
                }
            });
        });
        console.log("33");
        // Obtener todas las actividades y reorganizar aleatoriamente
        let allQuestions = preguntas.slice(); // Copiar el array para no modificar el original
        let shuffledQuestions = shuffleArray(allQuestions);

        // Seleccionar solo las primeras 10 preguntas después de reorganizarlas
        let selectedQuestions = shuffledQuestions.slice(0, 10);

        // Asignar las preguntas reorganizadas y seleccionadas a la variable "questions"
        questions = selectedQuestions;
        console.log("zzzPreguntas reorganizadas y seleccionadas:", questions);
    }
});


// Función para reorganizar aleatoriamente un array (algoritmo de Fisher-Yates)
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}




//seleccionando todos los elementos requeridos
const start_btn = document.querySelector(".start_btn button");
const info_box = document.querySelector(".info_box");
const exit_btn = info_box.querySelector(".buttons .quit");
const continue_btn = info_box.querySelector(".buttons .restart");
const quiz_box = document.querySelector(".quiz_box");
const result_box = document.querySelector(".result_box");
const option_list = document.querySelector(".option_list");
const time_line = document.querySelector("header .time_line");
const timeText = document.querySelector(".timer .time_left_txt");
const timeCount = document.querySelector(".timer .timer_sec");
const videoPlayer = document.createElement("video");

// si se hace clic en el botón Iniciar prueba

start_btn.onclick = ()=>{
    info_box.classList.add("activeInfo"); //show info box
}

// si se hace clic en el botón Salir del cuestionario
exit_btn.onclick = ()=>{
     info_box.classList.remove("activeInfo"); //ocultar cuadro de información
}

let timeValue = 90;
let que_count = 0;
let que_numb = 1;
let userScore = 0;
let counter;
let counterLine;
let widthValue = 0;

// si se hace clic en el botón continuar prueba
continue_btn.onclick = ()=>{
    info_box.classList.remove("activeInfo"); //hide info box
    quiz_box.classList.add("activeQuiz"); //show quiz box
    showQuestions(0); //calling showQestions function
    queCounter(1); //passing 1 parameter to queCounter
    startTimer(timeValue) //calling startTimer function
    startTimerLine(timeValue); //calling startTimerLine function
}



const restart_quiz = result_box.querySelector(".buttons .restart");
const quit_quiz = result_box.querySelector(".buttons .quit");

// si se hace clic en el botón Reiniciar cuestionario
restart_quiz.onclick = ()=>{
    quiz_box.classList.add("activeQuiz"); //show quiz box
    result_box.classList.remove("activeResult"); //hide result box
    timeValue = 90; 
    que_count = 0;
    que_numb = 1;
    userScore = 0;
    widthValue = 0;
    showQuestions(que_count); //calling showQestions function
    queCounter(que_numb); //passing que_numb value to queCounter
    clearInterval(counter); //clear counter
    clearInterval(counterLine); //clear counterLine
    startTimer(timeValue); //calling startTimer function
    startTimerLine(widthValue); //calling startTimerLine function
    timeText.textContent = "Time Left"; //change the text of timeText to Time Left
    next_btn.classList.remove("show"); //hide the next button
}

// si se hace clic en el botón Salir del cuestionario
quit_quiz.onclick = ()=>{
    window.location.reload(); //reload the current window
}

const next_btn = document.querySelector("footer .next_btn");
const bottom_ques_counter = document.querySelector("footer .total_que");

// si se hace clic en el botón Next Que
next_btn.onclick = ()=>{
     if(que_count < questions.length - 1){ //if question count is less than total question length
        que_count++; //increment the que_count value
        que_numb++; //increment the que_numb value
        showQuestions(que_count); //calling showQestions function
        queCounter(que_numb); //passing que_numb value to queCounter
        clearInterval(counter); //clear counter
        clearInterval(counterLine); //clear counterLine
        startTimer(timeValue); //calling startTimer function
        console.log("Siguiente pregunta");
        time_line.style.width = "0px"; //reset time line width
        console.log("Nuevo valor de time_line: " + time_line.width);
        startTimerLine(timeValue); //calling startTimerLine function
        timeText.textContent = "Time left"; //change the timeText to Time Left
        next_btn.classList.remove("show"); //hide the next button
    }else{
        clearInterval(counter); //clear counter
        clearInterval(counterLine); //clear counterLine
        showResult(); //calling showResult function
    }
}


function showQuestions(index) {
    const que_text = document.querySelector(".que_text");
    const quiz_box = document.querySelector(".quiz_box");

    if (questions.length > 0 && questions[index]) {
        let que_tag = '<span>' + (index + 1) + "." + questions[index].pregunta + '</span>';

        // Crear la etiqueta de video de forma dinámica
        let video_tag = '<div class="video-container"><video class="video-player" controls autoplay>';
        video_tag += '<source src="' + questions[index].ruta_video + '" type="video/mp4">';
        video_tag += 'Tu navegador no soporta el tag de video.';
        video_tag += '</video></div>';

        let option_tag = video_tag +
            '<div class="option">' + questions[index].opciones[0] + '<span></span></div>'
            + '<div class="option">' + questions[index].opciones[1] + '<span></span></div>'
            + '<div class="option">' + questions[index].opciones[2] + '<span></span></div>'
            + '<div class="option">' + questions[index].opciones[3] + '<span></span></div>';

        que_text.innerHTML = que_tag;
        option_list.innerHTML = option_tag;

        const option = option_list.querySelectorAll(".option");
        for (let i = 0; i < option.length; i++) {
            option[i].setAttribute("onclick", "optionSelected(this)");
        }

        const videoContainer = document.querySelector(".video-container");
        const videoPlayer = document.querySelector(".video-player");
        resizeVideo(videoContainer, videoPlayer, quiz_box);
        window.addEventListener("resize", function() {
            resizeVideo(videoContainer, videoPlayer, quiz_box);
        });
    } else {
        console.error("No hay preguntas disponibles o el índice especificado está fuera de rango.");
    }
}

// creating the new div tags which for icons
let tickIconTag = '<div class="icon tick"><i class="fas fa-check"></i></div>';
let crossIconTag = '<div class="icon cross"><i class="fas fa-times"></i></div>';

//if user clicked on option
function optionSelected(answer){
    clearInterval(counter); //clear counter
    clearInterval(counterLine); //clear counterLine
    let userAns = answer.textContent; //getting user selected option
    let correcAns = questions[que_count].respuesta; //getting correct answer from array
    //Imprimir en consola el valor de mi objeto en questions[que_count], utilizando el formato  JSON.stringify
    console.log("aquiii: " + JSON.stringify(questions[que_count]));
    console.log("aquiii2: " + JSON.stringify(questions[que_count].respuesta));


    const allOptions = option_list.children.length; //getting all option items

    const videoPlayer = document.querySelector(".video-player");
    videoPlayer.pause();

    if(userAns == correcAns){ //if user selected option is equal to array's correct answer
        userScore += 1; //upgrading score value with 1
         answer.classList.add("correct"); //adding green color to correct selected option
        answer.insertAdjacentHTML("beforeend", tickIconTag); //adding tick icon to correct selected option
        console.log("Correct Answer");
        console.log("Your correct answers = " + userScore);
    }else{
        answer.classList.add("incorrect"); //adding red color to correct selected option
        answer.insertAdjacentHTML("beforeend", crossIconTag); //adding cross icon to correct selected option
        console.log("Wrong Answer");

        for(i=0; i < allOptions; i++){
            if(option_list.children[i].textContent == correcAns){ //if there is an option which is matched to an array answer 
                option_list.children[i].setAttribute("class", "option correct"); //adding green color to matched option
                option_list.children[i].insertAdjacentHTML("beforeend", tickIconTag); //adding tick icon to matched option
                console.log("Auto selected correct answer.");
            }
        }
    }




    for(i=0; i < allOptions; i++){
        option_list.children[i].classList.add("disabled"); //once user select an option then disabled all options
    }
     next_btn.classList.add("show"); //show the next button if user selected any option
}

function showResult(){
    info_box.classList.remove("activeInfo"); //hide info box
    quiz_box.classList.remove("activeQuiz"); //hide quiz box
    result_box.classList.add("activeResult"); //show result box
    const scoreText = result_box.querySelector(".score_text");

    const percentage = (userScore / questions.length) * 100;
    scoreText.textContent = "Tu puntaje es " + percentage.toFixed(2) + "%";

    let message = "";
    if (percentage <= 25) {
        message = "No te preocupes, sigue practicando. 🙂";
    } else if (percentage <= 50) {
        message = "Bien, pero aún hay margen de mejora. 😄";
    } else if (percentage <= 75) {
        message = "¡Buen trabajo! Estás en el camino correcto. 😎";
    } else {
        message = "¡Felicidades! Eres un experto en el tema. 🤩🎉";
    }

    // Crear el mensaje dinámico
    let scoreTag = `<span>${message}, Tienes ${userScore} de ${questions.length}</span>`;
    scoreText.innerHTML = scoreTag;

    
    // Aquí deberías realizar la consulta para guardar el valor del test para ese usuario
    // Puedes utilizar AJAX, Fetch u otra técnica según tu entorno y backend.
    // Aquí un ejemplo ficticio:
    console.log("questions:", questions);
    let actividadIds = questions.map(question => question.id_actividad);
    saveTestResult(userScore, questions.length, unidadId, actividadIds)
}

function startTimer(time){
    console.log("aqui: " + time);
    counter = setInterval(timer, 1000);
    function timer(){
        timeCount.textContent = time; //changing the value of timeCount with time value
        time--; //decrement the time value
        if(time < 9){ //if timer is less than 9
            let addZero = timeCount.textContent; 
            timeCount.textContent = "0" + addZero; //add a 0 before time value
        }
        if(time < 0){ //if timer is less than 0
            clearInterval(counter); //clear counter
            timeText.textContent = "Se acabo el tiempo"; //change the time text to time off
            onTimeOut();
        }
    }
}

function startTimerLine(time){
    counterLine = setInterval(timer, 1000);
    //utilizar solo el valor entero de la division 550/time
    let widthLine = 550/time;
    
    function timer(){
        time_line.style.width = widthLine + "px"; //increasing width of time_line with px by time value
        widthLine = widthLine + 550/time;
        if (parseFloat(time_line.style.width) > 549) {
            clearInterval(counterLine);
        }
    }
}

function queCounter(index){
    //creating a new span tag and passing the question number and total question
    let totalQueCounTag = '<span><p>'+ index +'</p> of <p>'+ questions.length +'</p> Preguntas</span>';
    bottom_ques_counter.innerHTML = totalQueCounTag;  //adding new span tag inside bottom_ques_counter
}

function playVideo(player, source) {
    player.src = source;
    player.load();
    player.play();
}

function resizeVideo(container, player, parentContainer) {
    const parentWidth = parentContainer.clientWidth;
    const maxVideoWidth = Math.min(0.65 * parentWidth, 640); // Ocupa solo el 90% del espacio
    const aspectRatio = 16 / 9; // Relación de aspecto típica para videos
    const newWidth = Math.min(maxVideoWidth, parentWidth);
    const newHeight = newWidth / aspectRatio;

    container.style.width = newWidth + "px";
    container.style.height = newHeight + "px";
    container.style.margin = "auto"; // Centrar el contenedor
    player.style.width = "100%";
    player.style.height = "100%";
}

function onTimeOut() {
    clearInterval(counterLine); // Limpiar el temporizador de la línea de tiempo
    showResult(); // Mostrar los resultados
}

function saveTestResult(userScore, totalQuestions, unidadId, actividadIds) {
    // Obtener el valor de id_usuario de mi <input type="hidden" id="userId" value="<?php echo $_SESSION['id_usuario']; ?>">
    let userId = document.getElementById("userId").value;
    let porcentaje = (userScore / totalQuestions);
    let userNota = 10 * porcentaje;

    let userData = {
        id_usuario: userId,
        id_unidad: unidadId,
        nota: userNota.toFixed(2),
        tipo: "Prueba",
        actividadIds: actividadIds,
    };
    //imprimir todos los valores en este punto
    console.log("userData:", userData);

    fetch('save_nota_test.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(userData),
    })
    .then(response => {
        console.log('Respuesta del servidor:', response);
        // Verificar si la respuesta es exitosa
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Respuesta no exitosa del servidor');
        }
    })
    .then(data => {
        console.log('Nota guardada exitosamente:', data);
        // Puedes realizar acciones adicionales aquí si es necesario
    })
    .catch(error => {
        console.error('Error al procesar la respuesta:', error);
        // Puedes agregar mensajes de depuración adicionales si es necesario
        console.log("error 1: " + JSON.stringify(userData) + "\n" + error);
    });
}