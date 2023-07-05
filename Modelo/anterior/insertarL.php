<?php
 // $conexion = mysqli_connect('localhost','root','','prueba');
    include("../Config/conexion.php");
    $usuario= $_POST['usuario'];
    $clave=$_POST['contrasenia'];
    $sql="INSERT into usuario (usuario, clave) values('$usuario', '$clave')";
    mysqli_query($conexion,$sql);

?>