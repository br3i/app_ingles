<?php
    include("../../Config/conexion.php");
    $sql = "SELECT * from cliente";
    $resultado = mysqli_query($conexion, $sql);
    while($mostrar = mysqli_fetch_array($resultado)){
        ?>
        <tr>
            <td><?php echo $mostrar['ID_CLI'];?></td>
            <td><?php echo $mostrar['cedula'];?></td>
            <td><?php echo $mostrar['nombre'];?></td>
            <td><?php echo $mostrar['apellido'];?></td>
            <td><?php echo $mostrar['telefono'];?></td>
            <td><?php echo $mostrar['direccion'];?></td>
            <td>			
				<button type="button" style="border: transparent;" data-toggle="modal" data-target="#deleteChildresn<?php echo $mostrar['ID_CLI']; ?>">
				<img src="../../Publico/img/img1.png" alt="icon" width="25">
				</button>
				
				<button type="button" style="border: transparent;" data-toggle="modal" data-target="#editChildresn<?php echo $mostrar['ID_CLI']; ?>">
				<img src="../../Publico/img/img2.png" alt="icon" width="25">
				</button>
			</td>
            
			<!--Ventana Modal para Actualizar--->
			<?php  include('ModalEditar.php'); ?>

			<!--Ventana Modal para la Alerta de Eliminar--->
			<?php include('../../Vista/cliente/ModalEliminar.php'); ?>	
        </tr>
    <?php
    }
?>