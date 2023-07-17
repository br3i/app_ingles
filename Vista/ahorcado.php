<head>
    <meta charset="utf-8">
    <title>Juego del ahorcado</title>
    <link rel="stylesheet" href="../Publico/css/ahorcado.css">
    <script src="../Publico/js/ahorcado.js"></script>
</head>

<body>
    <h1>-El juego del ahorcado-</h1>
    <canvas id="pantalla" width="960px" height="450px"> <!-- etiqueta del canvas con sus medidas en la pantalla -->
        Tu navegador no soporta Canvas.
    </canvas>
    <!-- El boton que nos sirve para recargar la pagina y asi generar una nueva palabra y volver a jugar -->
    <button id="boton" type="reset" onclick="javascript:window.location.reload();">Volver a Jugar</button>
    <button id="boton2" type="reset" onclick="reproducirAudio()" hidden>Audio</button>
</body>