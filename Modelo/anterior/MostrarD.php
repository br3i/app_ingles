<?php
 include("../Config/conexion.php");
 $sql = "SELECT *from usuario";
 $resultado=mysqli_query($conexion,$sql);
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