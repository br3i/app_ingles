<?php include("../../Config/conexion.php");

$sql="SELECT * FROM producto WHERE ID_PRO LIKE LOWER('%".$_POST["buscarPd"]."%') OR nombre LIKE LOWER ('%".$_POST["buscarPd"]."%')";
$buscardor= mysqli_query($conexion, $sql);
$numero = mysqli_num_rows($buscardor); ?>

<h5 style="color: black;" class="card-tittle">Resultados encontrados (<?php echo $numero; ?>):</h5> <br><br>
<table class="table table-bordered table-striped table-hover">
    <thead>
	<tr>
		<th scope="col">ID</td>
		<th scope="col">Proveedor</th>
		<th scope="col">Producto</th>
		<th scope="col">Categoria</th>
		<th scope="col">Cantidad</th>
		<th scope="col">Precio Menor</th>
		<th scope="col">Precio Mayor</th>
		<th scope="col">Acción</th>
	</tr>
	</thead>

<?php while($mostrarPd =  mysqli_fetch_array($buscardor)){ ?>
    <tr>
			<td><?php echo $mostrarPd['ID_PRODUC'];?></td>
            <td><?php echo $mostrarPd['ID_PRO'];?></td>
            <td><?php echo $mostrarPd['nombre'];?></td>
            <td><?php echo $mostrarPd['tipo'];?></td>
            <td><?php echo $mostrarPd['cantidad'];?></td>
            <td><?php echo $mostrarPd['pMenor'];?></td>
            <td><?php echo $mostrarPd['pMayor'];?></td>
            <td>			
				<button type="button" style="border: transparent;" data-toggle="modal" data-target="#borrarProd<?php echo $mostrarPd['ID_PRODUC']; ?>">
				<img src="../../Publico/img/img1.png" alt="icon" width="25">
				</button>
				
				<button type="button" style="border: transparent;" data-toggle="modal" data-target="#editarProd<?php echo $mostrarPd['ID_PRODUC']; ?>">
				<img src="../../Publico/img/img2.png" alt="icon" width="25">
				</button>
			</td>
            
        </tr>
 <?php } ?>
 </table>
 