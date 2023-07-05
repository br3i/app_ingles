<?php include("../../Config/conexion.php");

$sql="SELECT * FROM categoria WHERE categoria LIKE LOWER('%".$_POST["buscarCate"]."%')";
$buscardor= mysqli_query($conexion, $sql);
$numero = mysqli_num_rows($buscardor); ?>

<h5 style="color: black;" class="card-tittle">Resultados encontrados (<?php echo $numero; ?>):</h5> <br><br>
<table class="table table-bordered table-striped table-hover">
    <thead>
		<tr>
			<th scope="col">ID</td>
			<th scope="col">Categoría</th>
			<th scope="col">Acción</th>
		</tr>
	</thead>

<?php while($mostrar =  mysqli_fetch_array($buscardor)){ ?>
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
		<?php  include("../../Modelo/categoria/ModalEditarCate.php"); ?>
		<!--Ventana Modal para la Alerta de Eliminar--->
		<?php include("../../Vista/categoria/ModalEliminarCate.php"); ?>	
    </tr>   
 <?php } ?>
 </table>
 