<?php
    include("../../Config/conexion.php");
    $sql21 =$conexion->query ("SELECT b.ID_PRODUC as id,a.nombre as proveedor,b.nombre as nombre, c.categoria as categoria, b.cantidad as cantidad, b.pMenor as pMenor,b.pMayor as pMayor                            FROM proveedores as a INNER JOIN producto as b ON a.ID_PRO=b.ID_PRO 
                            INNER JOIN categoria as c ON c.ID_CATE=b.tipo");
    while($mostrarPd = mysqli_fetch_array($sql21)){
        ?>
        <tr>
            <td><?php echo $mostrarPd['id'];?></td>
            <td><?php echo $mostrarPd['proveedor'];?></td>
            <td><?php echo $mostrarPd['nombre'];?></td>
            <td><?php echo $mostrarPd['categoria'];?></td>
            <td><?php echo $mostrarPd['cantidad'];?></td>
            <td><?php echo $mostrarPd['pMenor'];?></td>
            <td><?php echo $mostrarPd['pMayor'];?></td>
            <td>			
				<button type="button" style="border: transparent;" data-toggle="modal" data-target="#borrarProd<?php echo $mostrarPd['id']; ?>">
				<img src="../../Publico/img/img1.png" alt="icon" width="25">
				</button>
				
				<button type="button" style="border: transparent;" data-toggle="modal" data-target="#editarProd<?php echo $mostrarPd['id']; ?>">
				<img src="../../Publico/img/img2.png" alt="icon" width="25">
				</button>
			</td>
            
			<!--Ventana Modal para Actualizar--->
			<?php  include('ModalEditarProd.php'); ?>

			<!--Ventana Modal para la Alerta de Eliminar--->
			<?php include('../../Vista/producto/ModalEliminarPd.php'); ?>	
        </tr>
    <?php
    }
?>