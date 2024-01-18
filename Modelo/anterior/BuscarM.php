<?php
$id =$_POST['id'];
include("../Config/conexion.php");
$sql= "SELECT *from usuario WHERE id=$id"; 
$resultado=mysqli_query($conexion,$sql);
include("../Vista/Tabla.php");
while($mostrar=mysqli_fetch_array($resultado)){
  ?>
       <tr>
            <td><?php echo $mostrar['id']?>  </td>
            <td><?php echo $mostrar['nombre']?>  </td>
            <td><?php echo $mostrar['apellido']?>  </td>
            <td><?php echo $mostrar['password']?>  </td>
       </tr>
<?php
 }
?>