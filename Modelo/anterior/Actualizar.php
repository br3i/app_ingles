<?php
include("../Config/conexion.php");
$Id= $_POST['Id'];
$nombre =$_POST['nombre'];
$apellido =$_POST['apellido'];
$password =sha1($_POST['password']);
$sql="UPDATE usuario SET nombre='$nombre', apellido='$apellido',password='$password' where id='$Id'";
$resultado= mysqli_query($conexion,$sql);
if ($resultado)
    header("location:../Index.html");
 else
 echo "error al eliminar";

?>