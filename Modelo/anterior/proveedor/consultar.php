<?php
    include("../../Config/conexion.php");
    $sqlPV = "SELECT * from proveedores";
    $resultadoPV = mysqli_query($conexion, $sqlPV);
    while($mostrarPV = mysqli_fetch_array($resultadoPV)){
        ?>
        <tr>
            <td><?php echo $mostrarPV['ID_PRO'];?></td>
            <td><?php echo $mostrarPV['nombre'];?></td>
            <td><?php echo $mostrarPV['asesor'];?></td>
            <td><?php echo $mostrarPV['telefono'];?></td>
            <td><?php echo $mostrarPV['direccion'];?></td>
            <td>			
				<button type="button" style="border: transparent;" data-toggle="modal" data-target="#borrarPV<?php echo $mostrarPV['ID_PRO']; ?>">
				<img src="../../Publico/img/img1.png" alt="icon" width="25">
				</button>
				
				<button type="button" style="border: transparent;" data-toggle="modal" data-target="#editarProve<?php echo $mostrarPV['ID_PRO']; ?>">
				<img src="../../Publico/img/img2.png" alt="icon" width="25">
				</button>
			</td>
			<!--Ventana Modal para Actualizar--->
			<?php  include("ModalEditarPV.php"); ?>

			<!--Ventana Modal para la Alerta de Eliminar--->
			<?php include("../../Vista/proveedor/ModalEliminarProve.php"); ?>	
        </tr>
    <?php
    }
?>