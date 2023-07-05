<?php
include('../../Config/conexion.php');
$IdPV= $_POST['idPV'];
$nombrePV =$_POST['nombrePV'];
$asesorPV =$_POST['asesorPV'];
$telePV=$_POST['telePV'];
$direcPV =$_POST['direcPV'];
$sqlPV="UPDATE proveedores SET nombre='$nombrePV', asesor='$asesorPV',telefono='$telePV',direccion='$direcPV' where ID_PRO = '$IdPV'";
$resultadoPV= mysqli_query($conexion,$sqlPV);
if ($resultadoPV){
     header("location:../../Vista/proveedor/providers.php");
}
?>