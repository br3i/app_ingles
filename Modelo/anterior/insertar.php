<?php
//  $conexion = mysqli_connect('localhost','root','','prueba');
include("../Config/conexion.php");
echo "error";
$Id = $_POST['Id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$password = sha1($_POST['password']);
$sql = "INSERT into usuario(id,nombre,apellido,password) values('$Id','$nombre','$apellido','$password')";
mysqli_query($conexion, $sql);

?>