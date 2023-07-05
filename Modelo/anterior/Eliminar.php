<?php
 include("../Config/conexion.php");
 $id=$_REQUEST['id'];
 $sql = "DELETE from usuario where id=$id";
 $resultado=mysqli_query($conexion,$sql);
 if ($resultado)
    header("location:../Index.html");
 else
 echo "error al eliminar";
?>