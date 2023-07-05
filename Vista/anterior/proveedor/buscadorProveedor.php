<?php include("../../Config/conexion.php");

$sql="SELECT * FROM proveedores WHERE nombre LIKE LOWER('%".$_POST["buscarP"]."%') OR asesor LIKE LOWER ('%".$_POST["buscarP"]."%')";
$buscardor= mysqli_query($conexion, $sql);
$numero = mysqli_num_rows($buscardor); ?>

<h5 style="color: black;" class="card-tittle">Resultados encontrados (<?php echo $numero; ?>):</h5> <br><br>
<table class="table table-bordered table-striped table-hover">
    <thead>
		<tr>
			<th scope="col">ID</td>
			<th scope="col">Proveedor</th>
			<th scope="col">Asesor</th>
			<th scope="col">Teléfono</th>
			<th scope="col">Dirección</th>
			<th scope="col">Acción</th>
		</tr>
	</thead>

<?php while($mostrarPV =  mysqli_fetch_array($buscardor)){ ?>
    <tr>
            <td><?php echo $mostrarPV['ID_PRO'];?></td>
            <td><?php echo $mostrarPV['nombre'];?></td>
            <td><?php echo $mostrarPV['asesor'];?></td>
            <td><?php echo $mostrarPV['telefono'];?></td>
            <td><?php echo $mostrarPV['direccion'];?></td>
            <td>			
				<button type="button" style="border: transparent;" data-toggle="modal" data-target="#deleteChildresn<?php echo $mostrarPV['ID_PRO']; ?>">
				<img src="../../Publico/img/img1.png" alt="icon" width="25">
				</button>
				
				<button type="button" style="border: transparent;" data-toggle="modal" data-target="#editarProve<?php echo $mostrarPV['ID_PRO']; ?>">
				<img src="../../Publico/img/img2.png" alt="icon" width="25">
				</button>
			</td>
        </tr>
   
 <?php } ?>
 </table>
 