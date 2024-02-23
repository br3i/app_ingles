<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>CRUCIGRAMA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../Publico/ext/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../Publico/css/style.css">
  <link rel="stylesheet" href="../Publico/css/crucigrama.css">
  <script src="../Publico/js/bootstrap.min.js"></script>
  <script src="../Publico/js/crucigrama.js"></script>
</head>

<body>
  <div class="col-md-12">
    <h2>Crucigrama</h2>
    <div id="mensaje"></div>
    <b>Busca la palabra que describe la imagen</b><br />
    <div class="words">
      <div class="horizontales">
        <p><b>ACROSS</b></p>
        <div class="wHor">
          <img class="pictures" src="../Publico/img/crucigrama/palabra1.png"/>
          <button id="btn" onclick="reproducirAudio(1)">Audio</button>
        </div>
        <div class="wHor">
          <img class="pictures" src="../Publico/img/crucigrama/palabra2.png"/>
          <button id="btn" onclick="reproducirAudio(2)">Audio</button>
        </div>
      </div>
      <div class="verticales">
        <p><b>DOWN</b></p>
        <div class="wHor">
          <img class="pictures" src="../Publico/img/crucigrama/palabra3.png"/>
          <button id="btn" onclick="reproducirAudio(3)">Audio</button>
        </div>
        <div class="wHor">
          <img class="pictures" src="../Publico/img/crucigrama/palabra4.png"/>
          <button id="btn" onclick="reproducirAudio(4)">Audio</button>
        </div>
      </div>
    </div>
    <table class="table">
      <tr>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila1C1" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila1C2" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila1C3" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila1C4" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila1C5" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila1C6" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila1C7" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila1C8" />
        </td>
      </tr>
      <tr>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila2C1" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila2C2" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila2C3" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila2C4" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila2C5" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila2C6" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila2C7" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila2C8" />
        </td>
      </tr>
      <tr>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila3C1" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila3C2" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila3C3" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila3C4" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila3C5" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila3C6" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila3C7" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila3C8" />
        </td>
      </tr>
      <tr>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila4C1" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila4C2" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila4C3" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila4C4" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila4C5" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila4C6" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila4C7" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila4C8" />
        </td>
      </tr>
      <tr>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila5C1" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila5C2" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila5C3" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila5C4" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila5C5" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila5C6" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila5C7" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila5C8" />
        </td>
      </tr>
      <tr>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila6C1" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila6C2" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila6C3" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila6C4" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila6C5" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila6C6" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila6C7" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila6C8" />
        </td>
      </tr>
      <tr>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila7C1" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila7C2" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila7C3" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila7C4" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila7C5" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila7C6" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila7C7" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila7C8" />
        </td>
      </tr>
      <tr>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila8C1" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila8C2" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila8C3" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila8C4" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila8C5" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila8C6" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila8C7" />
        </td>
        <td>
          <input class="casilla" type="text" maxlength="1" id="fila8C8" />
        </td>
      </tr>
    </table>
    <button onclick="verificar()">Verificar</button>
  </div>
</body>

</html>