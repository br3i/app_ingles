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

// si se hace clic en el botón Iniciar prueba
start_btn.onclick = () => {
    info_box.classList.add("activeInfo"); //show info box
}

// si se hace clic en el botón Salir del cuestionario
exit_btn.onclick = () => {
    info_box.classList.remove("activeInfo"); //ocultar cuadro de información
}

// si se hace clic en el botón continuar prueba
continue_btn.onclick = () => {
    info_box.classList.remove("activeInfo"); //hide info box
    quiz_box.classList.add("activeQuiz"); //show quiz box
    showQuetions(0); //calling showQestions function
    queCounter(1); //passing 1 parameter to queCounter
    startTimer(); //calling startTimer function
    startTimerLine(0); //calling startTimerLine function
}

let timeValue = 120; // Tiempo total para toda la prueba en segundos
let que_count = 0;
let que_numb = 1;
let userScore = 0;
let counter;
let counterLine;
let widthValue = 0;
let temporizador;

const restart_quiz = result_box.querySelector(".buttons .restart");
const quit_quiz = result_box.querySelector(".buttons .quit");

// si se hace clic en el botón Reiniciar cuestionario
restart_quiz.onclick = () => {
    quiz_box.classList.add("activeQuiz"); //show quiz box
    result_box.classList.remove("activeResult"); //hide result box
    timeValue = 120; // Reinicia el tiempo total
    que_count = 0;
    que_numb = 1;
    userScore = 0;
    widthValue = 0;
    showQuetions(que_count); //calling showQestions function
    queCounter(que_numb); //passing que_numb value to queCounter
    clearInterval(counter); //clear counter
    clearInterval(counterLine); //clear counterLine
    startTimer(); //calling startTimer function
    startTimerLine(widthValue); //calling startTimerLine function
    timeText.textContent = "Tiempo restante"; //change the text of timeText to Time Left
    next_btn.classList.remove("show"); //hide the next button
}

// si se hace clic en el botón Salir del cuestionario
quit_quiz.onclick = () => {
    window.location.reload(); //reload the current window
}

const next_btn = document.querySelector("footer .next_btn");
const bottom_ques_counter = document.querySelector("footer .total_que");

// si se hace clic en el botón Next Que
next_btn.onclick = () => {
    if (que_count < questions.length - 1) {
        que_count++;
        que_numb++;
        showQuetions(que_count);
        queCounter(que_numb);
        clearInterval(counter);
        clearInterval(counterLine);
        startTimer();
        startTimerLine(widthValue);
        timeText.textContent = "Tiempo restante";
        next_btn.classList.remove("show");
    } else {
        clearInterval(counter);
        clearInterval(counterLine);
        showResult();
    }
}

// obtener preguntas y opciones de la matriz
function showQuetions(index) {
    const pregunta = questions[index];

    queText.innerHTML = `<span>${pregunta.descripcion}<br>${pregunta.pregunta}</span>`;

    if (pregunta.ruta_video) {
        let videoTag = `<div class="video"><video controls><source src="${pregunta.ruta_video}" type="video/mp4">Tu navegador no soporta el elemento de video.</video></div>`;
        queText.innerHTML += videoTag;
    }

    const optionTag = pregunta.opciones.map((opcion, i) => `<div class="option" data-index="${i}"><span>${opcion}</span></div>`).join("");
    option_list.innerHTML = optionTag;

    const options = option_list.querySelectorAll(".option");

    options.forEach((option) => {
        option.addEventListener("click", () => {
            clearInterval(temporizador);
            checkAnswer(option, pregunta);
        });
    });
}

let tickIconTag = '<div class="icon tick"><i class="fas fa-check"></i></div>';
let crossIconTag = '<div class="icon cross"><i class="fas fa-times"></i></div>';

function optionSelected(answer) {
    clearInterval(counter);
    clearInterval(counterLine);
    let userAns = answer.textContent;
    let correcAns = questions[que_count].respuesta;
    const allOptions = option_list.children.length;

    if (userAns == correcAns) {
        userScore += 1;
        answer.classList.add("correct");
        answer.insertAdjacentHTML("beforeend", tickIconTag);
        console.log("Respuesta correcta");
        console.log("Tus respuestas correctas = " + userScore);
    } else {
        answer.classList.add("incorrect");
        answer.insertAdjacentHTML("beforeend", crossIconTag);
        console.log("Respuesta incorrecta");

        for (let i = 0; i < allOptions; i++) {
            if (option_list.children[i].textContent == correcAns) {
                option_list.children[i].setAttribute("class", "option correct");
                option_list.children[i].insertAdjacentHTML("beforeend", tickIconTag);
                console.log("Respuesta correcta seleccionada automáticamente.");
            }
        }
    }

    for (let i = 0; i < allOptions; i++) {
        option_list.children[i].classList.add("disabled");
    }
    next_btn.classList.add("show");
}

function showResult() {
    info_box.classList.remove("activeInfo");
    quiz_box.classList.remove("activeQuiz");
    result_box.classList.add("activeResult");
    const scoreText = result_box.querySelector(".score_text");
    if (userScore > 3) {
        let scoreTag = '<span>¡Felicidades! 🎉, tienes <p>' + userScore + '</p> de <p>' + questions.length + '</p></span>';
        scoreText.innerHTML = scoreTag;
    } else if (userScore > 1) {
        let scoreTag = '<span>Muy bien 😎, tienes <p>' + userScore + '</p> de  <p>' + questions.length + '</p></span>';
        scoreText.innerHTML = scoreTag;
    } else {
        let scoreTag = '<span>Fallaste 😐, tienes  <p>' + userScore + '</p> de  <p>' + questions.length + '</p></span>';
        scoreText.innerHTML = scoreTag;
    }
}

function startTimerLine(time) {
    counterLine = setInterval(timer, 39);
    function timer() {
        time += 1;
        time_line.style.width = time + "px";
        if (time > 549) {
            clearInterval(counterLine);
        }
    }
}

function queCounter(index) {
    let totalQueCounTag = '<span><p>' + index + '</p> de <p>' + questions.length + '</p> Preguntas</span>';
    bottom_ques_counter.innerHTML = totalQueCounTag;
}
