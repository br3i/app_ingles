<?php
    include("../../Config/conexion.php");
    $nombreP = $_POST['nombreP'];
    $asesor = $_POST['asesor'];
    $teleP = $_POST['teleP'];
    $direcP = $_POST['direcP'];
    $sql =" INSERT INTO proveedores (nombre, asesor, telefono, direccion) 
            VALUES ('$nombreP', '$asesor', '$teleP','$direcP')";
    mysqli_query($conexion,$sql);
    header("location:../../vista/proveedor/providers.php");//recargar pagina
?>