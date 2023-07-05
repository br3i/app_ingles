<?php
    include("../../Config/conexion.php");
    $proveedor = $_POST['id'];
    $producto = $_POST['producto'];
    $categoria = $_POST['categoria'];
    $cantidad = $_POST['cantidad'];
    $minorista= $_POST['minorista'];
    $mayorista= $_POST['mayorista'];
    $sql =" INSERT INTO producto (ID_PRO,nombre,tipo,cantidad,pMenor,pMayor) 
             VALUES ('$proveedor','$producto', '$categoria', '$cantidad','$minorista','$mayorista')";
    mysqli_query($conexion,$sql);
    header("location:../../vista/producto/products.php");//recargar pagina  

?>