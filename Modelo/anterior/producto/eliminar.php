<?php
    include("../../Config/conexion.php");
    $idE = $_REQUEST['idPd'];
    $sql = "DELETE from producto where ID_PRODUC = '$idE'";
    $resultado = mysqli_query($conexion, $sql);
?>