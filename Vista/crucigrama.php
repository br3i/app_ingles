<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>CRUCIGRAMA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../Publico/css/bootstrap.min.css">
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
    <table class="table">
      <tr>
        <td>
          Horizontales<br />
          - <img src="../Publico/img/crucigrama/palabra1.png" width="50" /><button id="btn"
            onclick="reproducirAudio(1)">Audio</button><br />
          - <img src="../Publico/img/crucigrama/palabra2.png" width="50" /><button id="btn"
            onclick="reproducirAudio(2)">Audio</button><br />
        </td>
        <td>
          Verticales<br />
          - <img src="../Publico/img/crucigrama/palabra3.png" width="50" /><button id="btn"
            onclick="reproducirAudio(3)">Audio</button><br />
          - <img src="../Publico/img/crucigrama/palabra4.png" width="50" /><button id="btn"
            onclick="reproducirAudio(4)">Audio</button><br />
        </td>
      </tr>
    </table>
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
      </tr>
    </table>
    <button onclick="verificar()">Verificar</button>
  </div>
</body>