<?php
    include("../../Config/conexion.php");
    $idC= $_REQUEST['idCATE'];
    $sqlc= "DELETE from categoria where ID_CATE = '$idC'";
    $resultadoC = mysqli_query($conexion, $sqlc);
    if($resultadoC){
        header("location:../../vista/categoria/categories.php");//recargar pagina
    }
?>