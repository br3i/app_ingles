
<form name="form-data" action="../../Modelo/producto/insertarPro.php" method="POST">
    <h5 class="text-condensedLight">Datos Producto</h5>


	<form class="table-responsive">
		<?php include("../../Config/conexion.php"); ?>
			<div class="container mt-1">
				<div class="col-6">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
						<label class="mdl-button mdl-js-button mdl-button--icon" for="searchClient">
							<i class="zmdi zmdi-search"></i>
						</label>
					<div class="mdl-textfield__expandable-holder">
						<div class="mb-2">
							<input onkeyup="buscar_ahora($('#searchClient').val());" type="text" class="mdl-textfield__input" id="searchClient" name="searchClient">
								<label class="mdl-textfield__label"></label>
						</div>
					</div>
				</div>											
				<div  class="mb-2">
					<div class="card-body">
						<div id="buscador" class="container pl-0 pr-0"></div>
					</div>
				</div>
			</div>
		</div>
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
		</form> <br>




































		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<?php $mysqli = new mysqli('localhost', 'root', '', 'vivero');?>
			<select class="mdl-textfield__input" name="id">
				<option value="100">Cédula</option>
					<?php
						$query = $mysqli -> query ("SELECT * FROM proveedores");
						while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['ID_PRO'].'">'.$valores['nombre'].'</option>';
						}
					?>
			</select>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="producto" name="producto">
			<label class="mdl-textfield__label" for="producto">Producto</label>
			<span class="mdl-textfield__error">Producto no Valido</span>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<?php $mysqli = new mysqli('localhost', 'root', '', 'vivero');?>
			<select class="mdl-textfield__input" name="categoria">
				<option value="">Categoría</option>
					<?php
						$query = $mysqli -> query ("SELECT * FROM categoria");
						while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['ID_CATE'].'">'.$valores['categoria'].'</option>';
						}
					?>
			</select>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="number" name="cantidad" id="cantidad" min="1" pattern="^[0-9]+">
			<label class="mdl-textfield__label" for="direcCli">Cantidad</label>
			<span class="mdl-textfield__error"> Invalida</span>
		</div>
		
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="minorista" id="minorista" min="1" pattern="^[0-9]+(\.[0-9]{1,2})?$">
			<label class="mdl-textfield__label" for="direcCli">Precio Minorista</label>
			<span class="mdl-textfield__error"> Invalida</span>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="mayorista" id="mayorista" min="1" pattern="^[0-9]+(\.[0-9]{1,2})?$">
			<label class="mdl-textfield__label" for="direcCli">Precio Mayorista</label>
			<span class="mdl-textfield__error"> Invalida</span>
		</div>

        <div class="row justify-content-start text-center mt-5">
          <div class="col-12">
              <button class="btn btn-primary btn-block" id="btnEnviar" style="background-color: green;">
                  Registrar Producto
              </button>
          </div>
      </div>
</form>

