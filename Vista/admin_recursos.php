<div id="modulo_recursos">
    <nav class="navbar navbar-default">
		<div class="container-fluid">
        <ul class="nav navbar-nav ">
				<li class="nav-item">
					<form action="ver_recurso.php" method="POST">
						<button type="submit" class="btn btn-primary">Ver videos</button>
					</form>
				</li>
				<li class="nav-item">
					<form action="eliminar_recurso.php" method="POST">
						<button type="submit" class="btn btn-primary">Eliminar videos</button>
					</form>
				</li>
				<li class="nav-item">
					<form action="mostrar_arch.php" method="POST">
						<input type="hidden" name="video_select" value="41">
						<button type="submit" class="btn btn-primary">Video Ejercicio 1</button>
					</form>
				</li>
				<li class="nav-item">
					<form action="mostrar_arch.php" method="POST">
						<input type="hidden" name="video_select" value="42">
						<button type="submit" class="btn btn-primary">Video Ejercicio 2</button>
					</form>
				</li>
			</ul>
		</div>
	</nav>

	
	<div class="col-md-3 "></div>
	
	<div class="col-md-6 well">
		<h3 class="text-primary">Subir Arvhicos</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Agregar Archivo</button>
		<br /><br />
		<hr style="border-top:3px solid #ccc;"/>
		<?php
			include_once '../Config/conexion.php';
			
			$query = mysqli_query($con, "SELECT * FROM `recursos` ORDER BY `id_recurso` ASC") or die(mysqli_error($con));

			{
				
		?>
		
		<?php
			}
		?>
	</div>
	<div class="modal fade" id="form_modal" aria-hidden="true">
		<div class="modal-dialog">
			<form id="archivo_form" action="save_archive.php" method="POST" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-body">
						<div class="col-md-3"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Archivo</label>
								<input type="file" name="archivo" class="form-control-file"/>
							</div>
							<div class="form-group">
								<label>Archivo de Subtítulos (VTT)</label>
								<input type="file" name="subtitulo" class="form-control-file">
							</div>
							<div class="form-group">
								<label>Descripción</label>
								<input type="text" name="descripcion" class="form-control-file"/>
							</div>
							<input type="hidden" name="tipo_archivo" value="video">
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
						<button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>
