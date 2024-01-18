<?php
include('../../Config/conexion.php');
$Id= $_POST['idProv'];
$producto = $_POST['producto'];
$categoria = $_POST['categoria'];
$cantidad = $_POST['cantidad'];
$minorista= $_POST['minorista'];
$mayorista= $_POST['mayorista'];

$sql="UPDATE producto SET nombre ='$producto',tipo='$categoria',cantidad='$cantidad',pMenor='$minorista',pMayor='$mayorista' where ID_PRODUC='$Id'";
$resultado= mysqli_query($conexion,$sql);
header("location:../../Vista/producto/products.php");