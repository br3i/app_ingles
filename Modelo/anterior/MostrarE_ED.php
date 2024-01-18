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
            <td> <a href="../Modelo/Eliminar.php?id=<?php echo $mostrar['id']?>">Eliminar</a>                                  </td>
            <td> <a href="../Modelo/Editar.php?id=<?php echo $mostrar['id']?>">Editar</a>                                  </td>

       </tr>
<?php
 }
?>