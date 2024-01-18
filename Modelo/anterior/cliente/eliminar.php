<?php
    include("../../Config/conexion.php");
    $idE = $_REQUEST['id'];
    $sql = "DELETE from cliente where ID_CLI = '$idE'";
    $resultado = mysqli_query($conexion, $sql);
    if($resultado){
        header("location:../../vista/cliente/client.php");//recargar pagina
    }
    else{
        echo("Error al eliminar");
    }

?>