<?php
 include("../Config/conexion.php");
 $id=$_REQUEST['id'];
 $sql = "SELECT *from usuario where id= $id";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../Modelo/Actualizar.php" method= "POST">
        <?php include("../Vista/Tabla.php");?>
    </form>
</body>
</html>
<?php
 $resultado=mysqli_query($conexion,$sql);
 while($mostrar=mysqli_fetch_array($resultado)){
  ?>
       <tr>
            <td> <input type="hidden" value=  <?php echo $mostrar['id']?> name="Id" > </td>
            <td><input type="text" value= <?php echo $mostrar['nombre']?> name="nombre">  </td>
            <td><input type="text" value= <?php echo $mostrar['apellido']?> name="apellido">  </td>
            <td><input type="text" value= <?php echo $mostrar['password']?> name="password">  </td>
            <td> <input type="submit" value="Editar"></td>
       </tr>
<?php
 }
?>


 