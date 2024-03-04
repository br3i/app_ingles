/* Variables */
var ctx;
var canvas;
var palabra;
var letras = "QWERTYUIOPASDFGHJKLZXCVBNM";
//"QWERTYUIOPASDFGHJKLÑZXCVBNM"
var colorTecla = "#585858";
var colorMargen = "red";
var inicioX = 200;
var inicioY = 300;
var lon = 35;
var margen = 20;
var pistaText = "";

/* Arreglos */
var teclas_array = new Array();
var letras_array = new Array();
var palabras_array = new Array();

/* Variables de control */
var aciertos = 0;
var errores = 0;

/* Palabras */

// Primeras palabras relacionadas a las temáticas
palabras_array.push("simpsons");
palabras_array.push("moon");
palabras_array.push("war");
palabras_array.push("avengers");
palabras_array.push("fast");

// Palabras adicionales
palabras_array.push("springfield");
palabras_array.push("homer");
palabras_array.push("bart");
palabras_array.push("lisa");
palabras_array.push("maggie");
palabras_array.push("marge");
palabras_array.push("krusty");
palabras_array.push("apu");
palabras_array.push("burns");
palabras_array.push("smithers");
palabras_array.push("flanders");
palabras_array.push("moonwalk");
palabras_array.push("astronaut");
palabras_array.push("space");
palabras_array.push("orbit");
palabras_array.push("apollo");
palabras_array.push("neil");
palabras_array.push("lunar");
palabras_array.push("nasa");
palabras_array.push("rocket");
palabras_array.push("astronomy");
palabras_array.push("hitler");
palabras_array.push("allies");
palabras_array.push("axis");
palabras_array.push("nazis");
palabras_array.push("stalin");
palabras_array.push("pearl");
palabras_array.push("dunkirk");
palabras_array.push("holocaust");
palabras_array.push("hiroshima");
palabras_array.push("japan");
palabras_array.push("ironman");
palabras_array.push("thor");
palabras_array.push("hulk");
palabras_array.push("captain");
palabras_array.push("blackwidow");
palabras_array.push("shield");
palabras_array.push("ultron");
palabras_array.push("vision");
palabras_array.push("tony");
palabras_array.push("stark");
palabras_array.push("race");
palabras_array.push("speed");
palabras_array.push("furious");
palabras_array.push("cars");
palabras_array.push("dom");
palabras_array.push("letty");
palabras_array.push("mia");
palabras_array.push("shaw");
palabras_array.push("han");
        
/* Objetos */
function Tecla(x, y, ancho, alto, letra){
    this.x = x;
    this.y = y;
    this.ancho = ancho;
    this.alto = alto;
    this.letra = letra;
    this.dibuja = dibujaTecla;
}

function Letra(x, y, ancho, alto, letra){
    this.x = x;
    this.y = y;
    this.ancho = ancho;
    this.alto = alto;
    this.letra = letra;
    this.dibuja = dibujaCajaLetra;
    this.dibujaLetra = dibujaLetraLetra;
}

/* Funciones */

/* Dibujar Teclas*/
function dibujaTecla(){
    ctx.fillStyle = colorTecla;
    ctx.strokeStyle = colorMargen;
    ctx.fillRect(this.x, this.y, this.ancho, this.alto);
    ctx.strokeRect(this.x, this.y, this.ancho, this.alto);
    
    ctx.fillStyle = "white";
    ctx.font = "bold 20px courier";
    ctx.fillText(this.letra, this.x+this.ancho/2-5, this.y+this.alto/2+5);
}

/* Dibua la letra y su caja */
function dibujaLetraLetra(){
    var w = this.ancho;
    var h = this.alto;
    ctx.fillStyle = "black";
    ctx.font = "bold 40px Courier";
    ctx.fillText(this.letra.toUpperCase(), this.x+w/2-12, this.y+h/2+14);
}
function dibujaCajaLetra(){
    ctx.fillStyle = "white";
    ctx.strokeStyle = "black";
    ctx.fillRect(this.x, this.y, this.ancho, this.alto);
    ctx.strokeRect(this.x, this.y, this.ancho, this.alto);
}


/// Funcion para dar una pista la usuario ////
function pistaFunction(palabra){
    let pista = ""; // Se crea la variable local pista que contendra nuestra frase de pista
    switch(palabra) {
        // Se crea un switch para poder controlar las pistas según la palabra
        case 'simpsons':
            pista = "Famous animated family";
            break;
        case 'moon':
            pista = "Earth's natural satellite";
            break;
        case 'war':
            pista = "Conflict between nations";
            break;
        case 'avengers':
            pista = "Superhero team";
            break;
        case 'fast':
            pista = "High-speed action movies";
            break;
        case 'springfield':
            pista = "Hometown of The Simpsons";
            break;
        case 'homer':
            pista = "Father in The Simpsons";
            break;
        case 'bart':
            pista = "Mischievous son in The Simpsons";
            break;
        case 'lisa':
            pista = "Intelligent daughter in The Simpsons";
            break;
        case 'maggie':
            pista = "Baby in The Simpsons";
            break;
        case 'marge':
            pista = "Homemaker and wife in The Simpsons";
            break;
        case 'krusty':
            pista = "Clown in The Simpsons";
            break;
        case 'apu':
            pista = "Owner of the Kwik-E-Mart in The Simpsons";
            break;
        case 'burns':
            pista = "Rich and evil in The Simpsons";
            break;
        case 'smithers':
            pista = "Mr. Burns' loyal assistant";
            break;
        case 'flanders':
            pista = "Neighbor of The Simpsons";
            break;
        case 'moonwalk':
            pista = "Dance move made famous by Michael Jackson";
            break;
        case 'astronaut':
            pista = "Trained to travel and work in space";
            break;
        case 'space':
            pista = "Vast expanse beyond Earth's atmosphere";
            break;
        case 'orbit':
            pista = "Path of a celestial object around another";
            break;
        case 'apollo':
            pista = "First moon landing mission";
            break;
        case 'neil':
            pista = "First name of the first man on the moon";
            break;
        case 'lunar':
            pista = "Relating to the moon";
            break;
        case 'nasa':
            pista = "Space agency";
            break;
        case 'rocket':
            pista = "Vehicle for space travel";
            break;
        case 'astronomy':
            pista = "Study of celestial objects";
            break;
        case 'hitler':
            pista = "Leader of Nazi Germany";
            break;
        case 'allies':
            pista = "Countries against the Axis powers in WWII";
            break;
        case 'axis':
            pista = "Alliance between Germany, Italy, and Japan in WWII";
            break;
        case 'nazis':
            pista = "German fascist party during WWII";
            break;
        case 'stalin':
            pista = "Soviet leader during WW2";
            break;
        case 'pearl':
            pista = "December 7, 1941 attack site";
            break;
        case 'dunkirk':
            pista = "1940 evacuation operation";
            break;
        case 'holocaust':
            pista = "Genocide of Jews during WW2";
            break;
        case 'hiroshima':
            pista = "Atomic bomb city in Japan";
            break;
        case 'japan':
            pista = "Asian country in WW2";
            break;
        case 'ironman':
            pista = "Genius billionaire playboy philanthropist";
            break;
        case 'thor':
            pista = "Norse god of thunder";
            break;
        case 'hulk':
            pista = "Big green smashing machine";
            break;
        case 'captain':
            pista = "Leader of the Avengers";
            break;
        case 'blackwidow':
            pista = "Avenger spy";
            break;
        case 'shield':
            pista = "Protection organization";
            break;
        case 'ultron':
            pista = "Artificial intelligence villain";
            break;
        case 'vision':
            pista = "Synthetic Avenger";
            break;
        case 'tony':
            pista = "Iron Man's first name";
            break;
        case 'stark':
            pista = "Last name of Iron Man";
            break;
        case 'race':
            pista = "Competition of speed";
            break;
        case 'speed':
            pista = "Velocity";
            break;
        case 'furious':
            pista = "Intense anger";
            break;
        case 'cars':
            pista = "Automobiles";
            break;
        case 'dom':
            pista = "Main character in Fast and Furious";
            break;
        case 'letty':
            pista = "Tough and skilled driver in Fast and Furious";
            break;
        case 'mia':
            pista = "Love interest of Dom in Fast and Furious";
            break;
        case 'shaw':
            pista = "Antagonist turned ally in Fast and Furious";
            break;
        case 'han':
            pista = "Drift king in Fast and Furious";
            break;

        default: // El default se puede omitir
            $pista = "Ther's no hint for this word";
    }
    // Pintamos la palabra en el canvas , en este ejemplo se pinta arriba a la izquierda //
    ctx.fillStyle = "black";  // Aqui ponemos el color de la letra
    ctx.font = "bold 20px Courier";  // aqui ponemos el tipo y tamaño de la letra
    ctx.fillText(pista, 10, 15);  // aqui ponemos la frase en nuestro caso la variable pista , seguido de la posx y posy
}

        
    /* Distribuir nuestro teclado con sus letras respectivas al acomodo de nuestro array */
function teclado(){
    var ren = 0;
    var col = 0;
    var letra = "";
    var miLetra;
    var x = inicioX;
    var y = inicioY;
    for(var i = 0; i < letras.length; i++){
        letra = letras.substr(i,1);
        miLetra = new Tecla(x, y, lon, lon, letra);
        miLetra.dibuja();
        teclas_array.push(miLetra);
        x += lon + margen;
        col++;
        if(col==10){
            col = 0;
            ren++;
            if(ren==2){
                x = 280;
            } else {
                x = inicioX;
            }
        }
        y = inicioY + ren * 50;
    }
}


/* aqui obtenemos nuestra palabra aleatoriamente y la dividimos en letras */
function pintaPalabra(){
    var p = Math.floor(Math.random()*palabras_array.length);
    palabra = palabras_array[p];
    console.log(palabra);

    pistaFunction(palabra);

    var w = canvas.width;
    var len = palabra.length;
    var ren = 0;
    var col = 0;
    var y = 230;
    var lon = 50;
    var x = (w - (lon+margen) *len)/2;
    for(var i=0; i<palabra.length; i++){
        letra = palabra.substr(i,1);
        miLetra = new Letra(x, y, lon, lon, letra);
        miLetra.dibuja();
        letras_array.push(miLetra);
        x += lon + margen;
    }
}

/* dibujar cadalzo y partes del pj segun sea el caso */
function horca(errores){
    var imagen = new Image();
    imagen.src = "../Publico/img/ahorcado/ahorcado"+errores+".png";
    imagen.onload = function(){
        ctx.drawImage(imagen, 390, 0, 230, 230);
    }
    /*************************************************
    // Imagen 2 mas pequeña a un lado de la horca //       
    var imagen = new Image();
    imagen.src = "imagenes/ahorcado"+errores+".png";
    imagen.onload = function(){
        ctx.drawImage(imagen, 620, 0, 100, 100);
    }
    *************************************************/
}

/* ajustar coordenadas */
function ajusta(xx, yy){
    var posCanvas = canvas.getBoundingClientRect();
    var x = xx-posCanvas.left;
    var y = yy-posCanvas.top;
    return{x:x, y:y}
}

/* Detecta tecla clickeada y la compara con las de la palabra ya elegida al azar */
function selecciona(e){
    var pos = ajusta(e.clientX, e.clientY);
    console.log("Coordenadas del clic del ratón: ", e.clientX, e.clientY);
    console.log("Posición ajustada: ", pos.x, pos.y);
    var x = pos.x;
    var y = pos.y;
    var tecla;
    var bandera = false;
    
    for (var i = 0; i < teclas_array.length; i++){
        tecla = teclas_array[i];
        if (tecla.x > 0){
            if ((x > tecla.x) && (x < tecla.x + tecla.ancho) && (y > tecla.y) && (y < tecla.y + tecla.alto)){
                console.log("Tecla encontrada: ", tecla);
                break;
            }
        }
    }
    if (i < teclas_array.length){
        console.log("Tecla seleccionada: ", tecla.letra);
        for (var i = 0 ; i < palabra.length ; i++){ 
            letra = palabra.substr(i, 1);
            console.log("Letra de la palabra: ", letra);
            if (letra == tecla.letra.toLowerCase()){ /* comparamos y vemos si acerto la letra */
                
                caja = letras_array[i];
                caja.dibujaLetra();
                aciertos++;
                bandera = true;
            }
        }
        if (bandera == false){ /* Si falla aumenta los errores y checa si perdio para mandar a la funcion gameover */
            errores++;
            console.log("Error al seleccionar la letra.");
            horca(errores);
            if (errores==3) {
                document.getElementById("hangButn2").hidden=false;
            }
            if (errores == 5) gameOver(errores);
        }
        /* Borra la tecla que se a presionado */
        ctx.clearRect(tecla.x - 1, tecla.y - 1, tecla.ancho + 2, tecla.alto + 2);
        tecla.x - 1;
        /* checa si se gano y manda a la funcion gameover */
        if (aciertos == palabra.length) gameOver(errores);
    }
}

/* Borramos las teclas y la palabra con sus cajas y mandamos msj segun el caso si se gano o se perdio */
function gameOver(errores){
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = "black";

    ctx.font = "bold 50px Courier";
    if (errores < 5){
        ctx.fillText("Very well, the word is: ", 110, 280);
    } else {
        ctx.fillText("Sorry, the word was: ", 110, 280);
    }
    
    ctx.font = "bold 80px Courier";
    lon = (canvas.width - (palabra.toUpperCase().length*48))/2;
    ctx.fillText(palabra.toUpperCase(), lon, 400);
    horca(errores);
}

/* Detectar si se a cargado nuestro contexco en el canvas, iniciamos las funciones necesarias para jugar o se le manda msj de error segun sea el caso */
window.onload = function(){
    canvas = document.getElementById("pantalla");
    if (canvas && canvas.getContext){
        ctx = canvas.getContext("2d");
        if(ctx){
            teclado();
            pintaPalabra();
            horca(errores);
            canvas.addEventListener("click", selecciona, false);
        } else {
            alert ("Error loading context!");
        }
    }
}

function reproducirAudio() {
    console.log("Esta llegando a la función de reproducir audio");
    
    // Ruta del archivo de audio
    var rutaAudio = "../Publico/audios/" + palabra + ".mp3";
    console.log("Ruta del archivo de audio:", rutaAudio);
    
    // Verificar la disponibilidad del archivo de audio
    fetch(rutaAudio)
        .then(response => {
            if (response.ok) {
                var audio = new Audio(rutaAudio);
                audio.play();
            } else {
                alert("The audio file is not available.");
            }
        })
        .catch(error => {
            console.error("Error al verificar la disponibilidad del archivo de audio:", error);
        });
}