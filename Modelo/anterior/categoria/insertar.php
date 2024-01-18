<?php
    include("../../Config/conexion.php");
    $Categoria = $_POST['Categoria'];
    $sql =" INSERT INTO categoria (categoria) 
            VALUES ('$Categoria')";
    mysqli_query($conexion,$sql);
    header("location:../../vista/categoria/categories.php");//recargar pagina
?>