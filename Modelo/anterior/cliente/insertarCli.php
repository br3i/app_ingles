<?php
    include("../../Config/conexion.php");
    $cedula = $_POST['cedula'];
    $nombreCli = $_POST['nombreCli'];
    $apellidoCli = $_POST['apellidoCli'];
    $teleCli = $_POST['teleCli'];
    $direcCli = $_POST['direcCli'];
    $sql="SELECT * FROM cliente WHERE cedula = '$cedula'";

    $result = mysqli_query($conexion,$sql);
    if (mysqli_num_rows($result) > 0) {
      
      } else {
        $sql1 =" INSERT INTO cliente (cedula, nombre, apellido, telefono, direccion) 
        VALUES ('$cedula','$nombreCli', '$apellidoCli', '$teleCli','$direcCli')";
         mysqli_query($conexion,$sql1);
        header("location:../../vista/cliente/client.php");//recargar pagina
      }
      

?>