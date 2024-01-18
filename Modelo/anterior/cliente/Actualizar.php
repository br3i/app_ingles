<?php
include("../../Config/conexion.php");
$Id= $_POST['id'];
$nombre =$_POST['nombreCli'];
$apellido =$_POST['apellidoCli'];
$telefono=$_POST['teleCli'];
$direccion =$_POST['direcCli'];
$sql="UPDATE cliente SET nombre='$nombre', apellido='$apellido',telefono='$telefono',direccion='$direccion' where ID_CLI='$Id'";
$resultado= mysqli_query($conexion,$sql);
if ($resultado){
     header("location:../../Vista/cliente/client.php");
}
 else
    echo "error al eliminar";

?>