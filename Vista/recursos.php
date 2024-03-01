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
									<h4 class="info-box-text">Watch all Resources</h4>
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
									<h4 class="info-box-text">Upload files</h4>
									<button type="button" class="btn btn-outline-light text-ellipsis"
										data-toggle="modal" data-target="#form_modal"><b>Add file</b>
									</button>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="info-box bg-danger">
								<span class="info-box-icon"><i class="fas fa-trash"></i></span>
								<div class="info-box-content">
									<h4 class="info-box-text">Delete Resources</h4>
									<a href="panel.php?modulo=eliminar_recurso"
										class="btn btn-outline-light text-ellipsis"><b>Delete it</b></a>
								</div>
							</div>
						</div>
						<?php
						/*
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
						*/
						?>
						<?php
						include_once '../Config/conexion.php';

						// Consulta para obtener las unidades y los recursos asociados
						$query = "SELECT u.id_unidad, u.unidad, u.descripcion, r.id_recurso, r.recurso_name, r.tipo_archivo
								FROM unidad u
								LEFT JOIN recurso r ON u.id_unidad = r.id_unidad
								ORDER BY u.id_unidad ASC, r.id_recurso ASC";

						$result = mysqli_query($con, $query);

						// Inicializar la variable que almacenará el ID de la unidad actual
						$currentUnitId = null;

						// Verificar si la consulta fue exitosa
						if ($result && mysqli_num_rows($result) > 0) {
							
							echo '<div class="col-md-12">';
							// Inicio del bucle para recorrer los resultados
							while ($row = mysqli_fetch_assoc($result)) {
								$unidadId = $row['id_unidad'];
								$nombreUnidad = $row['unidad'];
								$descripcionUnidad = $row['descripcion'];
								$nombreArchivo = $row['recurso_name'];
								$tipoArchivo = $row['tipo_archivo'];
								
								// Verificar si hay cambio en la unidad actual
								if ($unidadId !== $currentUnitId) {
									// Si es una nueva unidad, imprimir el separador y el nombre de la unidad
									if ($currentUnitId !== null) {
										echo '</div>'; // Cerrar la fila de recursos de la unidad anterior
									}
									echo '<div class="unity' .$nombreUnidad.'">';
									echo '<h3>Unity: ' . $descripcionUnidad . '</h3>';
									echo '<div class="row">';
									$currentUnitId = $unidadId;
								}
								if ($tipoArchivo == 'video') {
									$icono_archivo = 'fas fa-file-video';
								}

								if ($tipoArchivo == 'audio') {
									$icono_archivo = 'fas fa-file-audio';
								}

								// Imprimir el recurso actual
								echo '<div class="col-md-4">';
									echo '<div class="info-box bg-dark">';
										echo '<span class="info-box-icon"><i class="' . $icono_archivo . '"></i></span>';
										echo '<div class="info-box-content">';
											echo '<h4 class="info-box-text">' . $nombreArchivo . '</h4>';
											echo '<form action="panel.php?modulo=mostrar_arch" method="POST">';
												echo '<input type="hidden" name="video_select" value="' . $row['id_recurso'] . '">';
												echo '<button type="submit" class="btn btn-outline-light text-ellipsis"><b>' . $nombreArchivo . '</b></button>';
											echo '</form>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
							
							// Cerrar la última fila y el div de la última unidad
							echo '</div>'; // Cerrar la última fila
							echo '</div>'; // Cerrar el div de la última unidad
						} else {
							// Mensaje si no hay unidades o recursos
							echo 'No hay unidades o recursos disponibles.';
						}
						echo '</div>';

						// Liberar el resultado y cerrar la conexión
						mysqli_free_result($result);
						mysqli_close($con);
						?>
						<div class="modal fade" id="form_modal" aria-hidden="true">
							<div class="modal-dialog">
								<form id="archivo_form" action="save_archive.php" method="POST"
									enctype="multipart/form-data">
									<div class="modal-content">
										<div class="modal-body">
											<div class="col-md-12">
												<div class="form-group">
													<label>File</label>
													<input type="file" name="archivo" class="form-control-file" />
												</div>
												<?php
												include_once '../Config/conexion.php';
												// Realizar la conexión a la base de datos y verificar si hay errores
												// Suponiendo que ya tienes la conexión establecida

												// Consulta para obtener todas las unidades disponibles
												$query_unidades = "SELECT * FROM unidad";
												$result_unidades = mysqli_query($con, $query_unidades);

												// Verificar si la consulta fue exitosa
												if ($result_unidades) {
													// Iniciar el select
													echo '<div class="form-group">
															<label>Unity</label>
															<select name="unidad" class="form-control-file">';
													
													// Iterar sobre los resultados de la consulta
													while ($row_unidad = mysqli_fetch_assoc($result_unidades)) {
														// Obtener el id y el nombre de la unidad
														$id_unidad = $row_unidad['id_unidad'];
														$nombre_unidad = $row_unidad['unidad'];
														$descripcion_unidad = $row_unidad['descripcion'];
														
														// Crear la opción del select
														echo "<option value='$id_unidad'>$nombre_unidad - $descripcion_unidad</option>";
													}
													
													// Cerrar el select
													echo '</select>
														</div>';
												} else {
													// Manejar el caso en que la consulta falle
													echo '<div class="form-group">';
														echo '<label>Unity</label>';
														echo "<br>Error while consulting unities, please write the number of unity";
														echo '<input type="text" name="unidad" class="form-control-file" />';
													echo '</div>';
												}

												// Cerrar la conexión a la base de datos
												mysqli_close($con);
												?>
												<div class="form-group">
													<label>Subtitle File (VTT)</label>
													<input type="file" name="subtitulo" class="form-control-file">
												</div>
												<div class="form-group">
													<label>Description</label>
													<input type="text" name="descripcion" class="form-control-file" />
												</div>
											</div>
										</div>
										<div style="clear:both;"></div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger" data-dismiss="modal"><span
													class="glyphicon glyphicon-remove"></span>Close</button>
											<button name="save" class="btn btn-primary"><span
													class="glyphicon glyphicon-save"></span>
												Save</button>
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