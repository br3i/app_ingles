<!-- <script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script> -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<div class="col-lg-12">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Welcome to Resources!</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="info-box bg-success">
								<span class="info-box-icon"><i class="fas fa-play"></i></span>
								<div class="info-box-content">
									<h4 class="info-box-text">Ver recursos</h4>
									<a href="panel.php?modulo=ver_recurso"
										class="btn btn-outline-light text-ellipsis"><b>Watch
											Resources</b></a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="info-box bg-info">
								<span class="info-box-icon"><i class="fas fa-plus"></i></span>
								<div class="info-box-content">
									<h4 class="info-box-text">Subir archivos</h4>
									<button type="button" class="btn btn-outline-light text-ellipsis"
										data-toggle="modal" data-target="#form_modal"><b>Agregar Archivo</b>
									</button>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="info-box bg-danger">
								<span class="info-box-icon"><i class="fas fa-trash"></i></span>
								<div class="info-box-content">
									<h4 class="info-box-text">Eliminar Recursos</h4>
									<a href="panel.php?modulo=eliminar_recurso"
										class="btn btn-outline-light text-ellipsis"><b>Delete
											Resources</b></a>
								</div>
							</div>
						</div>
						<?php

						include_once '../Config/conexion.php';

						$query = mysqli_query($con, "SELECT * FROM `recurso` ORDER BY `id_recurso`ASC") or die(mysqli_error($con));

						while ($row = mysqli_fetch_assoc($query)) {
							$nombreArchivo = $row['recurso_name'];
							$tipoArchivo = $row['tipo_archivo'];
							if ($tipoArchivo == 'video') {
								$icono_archivo = 'fas fa-file-video';
							}

							if ($tipoArchivo == 'audio') {
								$icono_archivo = 'fas fa-file-audio';
							}
							echo '
								<div class="col-md-4">
									<div class="info-box bg-dark">
									    <span class="info-box-icon"><i class="' . $icono_archivo . '"></i></span>
									    <div class="info-box-content">
									        <h4 class="info-box-text">' . $nombreArchivo . '</h4>
									        <form action="mostrar_arch.php" method="POST">
									            <input type="hidden" name="video_select" value="' . $row['id_recurso'] . '">
									            <button type="submit" class="btn btn-outline-light text-ellipsis"><b>' . $nombreArchivo . '</b></button>
									        </form>
									    </div>
									</div>
								</div>';
						}
						?>
						<div class="modal fade" id="form_modal" aria-hidden="true">
							<div class="modal-dialog">
								<form id="archivo_form" action="save_archive.php" method="POST"
									enctype="multipart/form-data">
									<div class="modal-content">
										<div class="modal-body">
											<div class="col-md-3"></div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Archivo</label>
													<input type="file" name="archivo" class="form-control-file" />
												</div>
												<div class="form-group">
													<label>Unidad</label>
													<input type="text" name="unidad" class="form-control-file" />
												</div>
												<div class="form-group">
													<label>Archivo de Subtítulos (VTT)</label>
													<input type="file" name="subtitulo" class="form-control-file">
												</div>
												<div class="form-group">
													<label>Descripción</label>
													<input type="text" name="descripcion" class="form-control-file" />
												</div>
												<input type="hidden" name="tipo_archivo" value="video">
											</div>
										</div>
										<div style="clear:both;"></div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger" data-dismiss="modal"><span
													class="glyphicon glyphicon-remove"></span> Cerrar</button>
											<button name="save" class="btn btn-primary"><span
													class="glyphicon glyphicon-save"></span>
												Guardar</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- /.card -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->