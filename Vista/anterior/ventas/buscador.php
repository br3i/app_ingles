<?php include("../../Config/conexion.php");

$sql="SELECT * FROM cliente WHERE cedula LIKE LOWER('%".$_POST["buscar"]."%')";
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
				<th scope="col">Acción</th>
		</tr>
	</thead>

<?php while($mostrar =  mysqli_fetch_array($buscardor)){ ?>
    <tr>
            <td><?php echo $mostrar['ID_CLI'];?></td>
            <td><?php echo $mostrar['cedula'];?></td>
            <td><?php echo $mostrar['nombre'];?></td>
            <td><?php echo $mostrar['apellido'];?></td>
            <td>		
				<a class="ewk_banner_link" href="ingreProducto.php?var1=<?php $_POST["buscar"]?>">Ingresar</a>
			</td>
        </tr>

		<script type="text/javascript">
									function buscar_ahora(buscar) {
									var parametros = {"buscar":buscar};
									var a=document.getElementById("searchClient").value;
									if(a!=""){
										$.ajax({
											data:parametros,
											type: 'POST',
											url: 'buscador.php',
											success: function(data) {
											document.getElementById("buscador").innerHTML = data;
											}
										});
									}}
									</script>
 <?php } ?>
 </table>
 