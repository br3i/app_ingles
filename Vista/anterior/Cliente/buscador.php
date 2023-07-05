<?php include("../../Config/conexion.php");

$sql="SELECT * FROM cliente WHERE cedula LIKE LOWER('%".$_POST["buscar"]."%') OR apellido LIKE LOWER ('%".$_POST["buscar"]."%')";
$buscardor= mysqli_query($conexion, $sql);
$numero = mysqli_num_rows($buscardor); ?>

<h5 style="color: black;" class="card-tittle">Resultados encontrados (<?php echo $numero; ?>):</h5> <br><br>
<table class="table table-bordered table-striped table-hover">
    <thead>
		<tr>
	    	<th scope="col">ID</td>
				<th scope="col">Cédula</th>
				<th scope="col">Nombre</th>
				<th scope="col">Apellido</th>
				<th scope="col">Teléfono</th>
				<th scope="col">Dirección</th>
				<th scope="col">Acción</th>
		</tr>
	</thead>

<?php while($mostrar =  mysqli_fetch_array($buscardor)){ ?>
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
        </tr>
   
 <?php } ?>
 </table>
 