<?php
    include("../../Config/conexion.php");
    $idPV= $_REQUEST['idPV'];
    $sqlPV = "DELETE from proveedores where ID_PRO = '$idPV'";
    $resultadoPV = mysqli_query($conexion, $sqlPV);
    header("location:../../vista/proveedor/providers.php");//recargar pagina
?>