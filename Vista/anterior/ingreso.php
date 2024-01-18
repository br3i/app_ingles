<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de datos</title>
    <script src="../Publico/ext/bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="../js/Ajax.js"></script>

<body>
    <h1>Ingrese sus datos</h1>
    <form action="" id="frmAjax" method="POST">
        <label for="">Id</label>
        <input type="text" name="Id" id="Id" placeholder="Id">
        <br>
        <br>
        <label for="">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="nombre">
        <br>
        <br>
        <label for="">Apellido</label>
        <input type="text" name="apellido" id="apellido" placeholder="nombre">
        <br>
        <br>
        <label for="">password</label>
        <input type="text" name="password" id="password" placeholder="nombre">
        <br>
        <br>
        <input type="button" id="btnguardar" value="enviar" onclick="miFuncion()">
        <!-- <input type="submit" id="btnguardar" value="enviar" onclick="miFuncion()"> -->
    </form>
</body>

</html>
<script>



</script>