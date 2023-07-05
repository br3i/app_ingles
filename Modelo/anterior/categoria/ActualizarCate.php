<?php
include('../../Config/conexion.php');
$IdC= $_POST['idCATE'];
$Categoria =$_POST['Categoria'];
$sql="UPDATE categoria SET categoria='$Categoria' where ID_CATE = '$IdC'";
$resultado= mysqli_query($conexion,$sql);
if ($resultado){
     header("location:../../Vista/categoria/categories.php");
}
?>