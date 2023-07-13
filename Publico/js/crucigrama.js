document.addEventListener("DOMContentLoaded",function(){
    // Deshabilitar todos los campos

    for(fila=1; fila<=6; fila++){
        for(columna=1;columna<=6;columna++){
        document.getElementById("fila"+fila+"C"+columna).readOnly=true;
        }
    }

    var palabra1_letra1 = document.getElementById("fila3C1");
    var palabra1_letra2 = document.getElementById("fila3C2");
    var palabra1_letra3 = document.getElementById("fila3C3");
    var palabra1_letra4 = document.getElementById("fila3C4");

    var palabra2_letra1 = document.getElementById("fila5C1");
    var palabra2_letra2 = document.getElementById("fila5C2");
    var palabra2_letra3 = document.getElementById("fila5C3");
    var palabra2_letra4 = document.getElementById("fila5C4");
    var palabra2_letra5 = document.getElementById("fila5C5");
    var palabra2_letra6 = document.getElementById("fila5C6");

    var palabra3_letra1 = document.getElementById("fila2C4");
    var palabra3_letra2 = document.getElementById("fila3C4");
    var palabra3_letra3 = document.getElementById("fila4C4");
    var palabra3_letra4 = document.getElementById("fila5C4");

    var palabra4_letra1 = document.getElementById("fila3C6");
    var palabra4_letra2 = document.getElementById("fila4C6");
    var palabra4_letra3 = document.getElementById("fila5C6");

    //Habilitar las casillas necesarias (horizontales)
    palabra1_letra1.readOnly =false;
    palabra1_letra2.readOnly =false;
    palabra1_letra3.readOnly =false;
    palabra1_letra4.readOnly =false;

    palabra2_letra1.readOnly =false;
    palabra2_letra2.readOnly =false;
    palabra2_letra3.readOnly =false;
    palabra2_letra4.readOnly =false;
    palabra2_letra5.readOnly =false;
    palabra2_letra6.readOnly =false;

    //Habilitar las casillas necesarias (verticales)
    palabra3_letra1.readOnly =false;
    palabra3_letra2.readOnly =false;
    palabra3_letra3.readOnly =false;
    palabra3_letra4.readOnly =false;

    palabra4_letra1.readOnly =false;
    palabra4_letra2.readOnly =false;
    palabra4_letra3.readOnly =false;

    for(fila=1; fila<=6; fila++){
        for(columna=1;columna<=6;columna++){
        if(document.getElementById("fila"+ fila +"C" + columna).readOnly==false){
            document.getElementById("fila"+ fila +"C" + columna).style.backgroundColor="#07c7e6";
        }
        }
    }
})

function verificar(){
    var palabra1_letra1 = document.getElementById("fila3C1");
    var palabra1_letra2 = document.getElementById("fila3C2");
    var palabra1_letra3 = document.getElementById("fila3C3");
    var palabra1_letra4 = document.getElementById("fila3C4");

    var palabra2_letra1 = document.getElementById("fila5C1");
    var palabra2_letra2 = document.getElementById("fila5C2");
    var palabra2_letra3 = document.getElementById("fila5C3");
    var palabra2_letra4 = document.getElementById("fila5C4");
    var palabra2_letra5 = document.getElementById("fila5C5");
    var palabra2_letra6 = document.getElementById("fila5C6");

    var palabra3_letra1 = document.getElementById("fila2C4");
    var palabra3_letra2 = document.getElementById("fila3C4");
    var palabra3_letra3 = document.getElementById("fila4C4");
    var palabra3_letra4 = document.getElementById("fila5C4");

    var palabra4_letra1 = document.getElementById("fila3C6");
    var palabra4_letra2 = document.getElementById("fila4C6");
    var palabra4_letra3 = document.getElementById("fila5C6");

    document.getElementById("mensaje").innerHTML="";
    //var palabra1 = document.ge
    palabra1 = palabra1_letra1.value + palabra1_letra2.value + palabra1_letra3.value + palabra1_letra4.value; 
    palabra2 = palabra2_letra1.value + palabra2_letra2.value + palabra2_letra3.value + palabra2_letra4.value + palabra2_letra5.value + palabra2_letra6.value; 
    palabra3 = palabra3_letra1.value + palabra3_letra2.value + palabra3_letra3.value + palabra3_letra4.value; 
    palabra4 = palabra4_letra1.value + palabra4_letra2.value + palabra4_letra3.value;
    
    if(palabra1.toLowerCase()=="fire" && palabra2.toLowerCase()=="parrot" && palabra3.toLowerCase()=="bear" && palabra4.toLowerCase()=="cat"){
    document.getElementById("mensaje").innerHTML="Ganaste";
    document.getElementById("mensaje").style.fontSize="24px";
    document.getElementById("mensaje").className="alert alert-success";
    }else{
    if(palabra1.toLowerCase()!="fire"){
        palabra1_letra1.value="";
        palabra1_letra2.value="";
        palabra1_letra3.value="";
        palabra1_letra4.value="";
        error();
    }

    if(palabra2.toLowerCase()!="parrot"){
        palabra2_letra1.value="";
        palabra2_letra2.value="";
        palabra2_letra3.value="";
        palabra2_letra4.value="";
        palabra2_letra5.value="";
        palabra2_letra6.value="";
        error();
    }

    if(palabra3.toLowerCase()!="bear"){
        palabra3_letra1.value="";
        palabra3_letra2.value="";
        palabra3_letra3.value="";
        palabra3_letra4.value="";
        error();
    }

    if(palabra4.toLowerCase()!="cat"){
        palabra4_letra1.value="";
        palabra4_letra2.value="";
        palabra4_letra3.value="";
        error();
    }

    //corrector de palabras
    if(palabra1.toLowerCase()=="fire"){
        palabra1_letra4.value="e";
    }

    if(palabra2.toLowerCase()=="parrot"){
        palabra2_letra4.value="r";
    }

    if(palabra3.toLowerCase()=="bear"){
        palabra3_letra2.value="e";
        palabra3_letra4.value="r";
    }

    if(palabra2.toLowerCase()=="cat"){
        palabra4_letra3.value="t";
    }

    }
}

var errorActivo=0;
function error(){
    document.getElementById("mensaje").innerHTML="Existen palabras malas";
    document.getElementById("mensaje").className="alert alert-danger";
    errorActivo=1;
}

//esta funcion es para ejecutarse cada 5 segundos
setInterval('ocultarError()',5000);

function ocultarError(){
    if(errorActivo==1){
    document.getElementById("mensaje").innerHTML="";
    document.getElementById("mensaje").className="";
    errorActivo=0;
    }
}

// reproducir audio
function reproducirAudio(aud) {
    if(aud==1){
        var audio= new Audio("../Publico/audios/fire.mp3");
        audio.play();
    }
    if(aud==2){
        var audio= new Audio("../Publico/audios/parrot.mp3");
        audio.play();
    }
    if(aud==3){
        var audio= new Audio("../Publico/audios/bear.mp3");
        audio.play();
    }
    if(aud==4){
        var audio= new Audio("../Publico/audios/cat.mp3");
        audio.play();
    }
}