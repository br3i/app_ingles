<?php
    include("../../Config/conexion.php");
    $sql = "SELECT * from categoria";
    $resultado = mysqli_query($conexion, $sql);
    while($mostrar= mysqli_fetch_array($resultado)){
        ?>
        <tr>
            <td><?php echo $mostrar['ID_CATE'];?></td>
            <td><?php echo $mostrar['categoria'];?></td>
            <td>			
				<button type="button" style="border: transparent;" data-toggle="modal" data-target="#borrarCATE<?php echo $mostrar['ID_CATE']; ?>">
				<img src="../../Publico/img/img1.png" alt="icon" width="25">
				</button>
				
				<button type="button" style="border: transparent;" data-toggle="modal" data-target="#editarCATE<?php echo $mostrar['ID_CATE']; ?>">
				<img src="../../Publico/img/img2.png" alt="icon" width="25">
				</button>
			</td>
			<!--Ventana Modal para Actualizar--->
			<?php  include("ModalEditarCate.php"); ?>

			<!--Ventana Modal para la Alerta de Eliminar--->
			<?php include("../../Vista/categoria/ModalEliminarCate.php"); ?>	
        </tr>
    <?php
    }
?>