<!-- Content Wrapper. Contains page content -->
<br>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="row">
                            <?php
                            include_once '../Config/conexion.php';

                            $query = mysqli_query($con, "SELECT DISTINCT unidad FROM recurso JOIN unidad ON recurso.id_unidad = unidad.id_unidad ORDER BY recurso.id_recurso ASC") or die(mysqli_error($con));

                            while ($row = mysqli_fetch_assoc($query)) {
                                $unidad = $row['unidad'];

                                echo '
                                    <div class="col-md-4 unidad-container">
                                        <div class="d-flex align-items-center justify-content-center info-box bg-dark">
                                            <h3>Unidad ' . $unidad . '</h3>
                                            <div class="info-box-content">
                                                <select name="video_select" class="toggleIframeBtn video-select unidad-select bg-dark" onchange="loadVideo(this)" data-iframe="iframe1">';

                                // Agregar la opción por defecto
                                echo '<option value="">Seleccione un recurso</option>';

                                $unidadQuery = mysqli_query($con, "SELECT * FROM `recurso` WHERE id_unidad = '$unidad' ORDER BY `id_recurso` ASC") or die(mysqli_error($con));

                                while ($recRow = mysqli_fetch_assoc($unidadQuery)) {
                                    $nombreArchivo = $recRow['recurso_name'];
                                    $tipoArchivo = $recRow['tipo_archivo'];
                                    $ubicacionArchivo = $recRow['location'];

                                    if ($tipoArchivo == 'video') {
                                        $icono_archivo = 'fas fa-file-video';
                                    } elseif ($tipoArchivo == 'audio') {
                                        $icono_archivo = 'fas fa-file-audio';
                                    }

                                    echo '<option data-location="' . $ubicacionArchivo . '">' . $nombreArchivo . '</option>';
                                }

                                echo '
                                                </select>
                                            </div>    
                                        </div>
                                    </div>';
                            }
                            ?>
                            <!-- /.card -->
                        </div>
                        <?php
                        echo '<div id="iframe-container" style="display: none;">
                                        <video id="video-iframe" controls style="width: 100%; height: 500px; border: none;">
                                        </video>
                                    </div>';
                        ?>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    function loadVideo(selectElement) {
        var videoLocation = selectElement.options[selectElement.selectedIndex].getAttribute('data-location');

        // Obtener el video y establecer su atributo src con la ubicación del video
        var videoElement = document.getElementById('video-iframe');
        videoElement.src = videoLocation;

        // Reproducir el video automáticamente
        videoElement.play();

        // Establecer el atributo "value" de la opción por defecto en todos los selects
        var defaultOption = document.querySelectorAll('.unidad-select option[value=""]');
        defaultOption.forEach(function (option) {
            option.selected = true;
        });

        // Mostrar el contenedor del iframe
        var iframeContainer = document.getElementById('iframe-container');
        iframeContainer.style.display = 'block';
    }
</script>