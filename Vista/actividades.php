<!-- Agrega el siguiente código al encabezado de tu página -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        // Agrega el evento click al botón "Video 1" para mostrar/ocultar el iframe correspondiente y cargar el video
        $(".toggleIframeBtn").click(function () {
            var iframeId = $(this).data("iframe");

            // Recargar el contenido del otro iframe
            var otherIframeId = (iframeId === "iframe1") ? "iframe2" : "iframe1";
            $("#" + otherIframeId + " iframe").attr("src", $("#" + otherIframeId + " iframe").attr("src"));

            $("#" + iframeId).slideToggle();
            $(".iframe-container").not("#" + iframeId).slideUp();

            // Cargar el video cuando se muestre el iframe
            if ($("#" + iframeId).is(":visible")) {
                var iframeContainer = $("#" + iframeId);
                var iframe = iframeContainer.find("iframe");
                var src = iframeContainer.data("src");
                var videoSelect = iframeContainer.data("video-select");

                // Combinar el valor del video con los demás parámetros
                var params = "video_select=" + videoSelect;

                // Realizar una solicitud AJAX POST para cargar el contenido en el iframe
                $.ajax({
                    type: "POST",
                    url: src,
                    data: params,
                    success: function (response) {
                        // Actualizar el contenido del iframe con la respuesta recibida
                        iframe.attr("srcdoc", response);
                    },
                    error: function () {
                        // Manejar cualquier error de la solicitud AJAX
                        console.log("Error al cargar el contenido del iframe.");
                    }
                });
            }
        });
    });
</script>
<br>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12">
                    <?php
                    include_once '../Config/conexion.php';

                    $query = mysqli_query($con, "SELECT DISTINCT unidad FROM `recursos` ORDER BY `id_recurso` ASC") or die(mysqli_error($con));

                    while ($row = mysqli_fetch_assoc($query)) {
                        $unidad = $row['unidad'];

                        echo '
                        <div class="col-md-4 unidad-container">
                            <div class="d-flex align-items-center justify-content-center info-box bg-dark">
                                <h3>Unidad ' . $unidad . '</h3>
                                    <div class="info-box-content">
                                    <select name="video_select" class="video-select bg-dark">';

                        $unidadQuery = mysqli_query($con, "SELECT * FROM `recursos` WHERE unidad = '$unidad' ORDER BY `id_recurso` ASC") or die(mysqli_error($con));

                        while ($recRow = mysqli_fetch_assoc($unidadQuery)) {
                            $nombreArchivo = $recRow['recurso_name'];
                            $tipoArchivo = $recRow['tipo_archivo'];

                            if ($tipoArchivo == 'video') {
                                $icono_archivo = 'fas fa-file-video';
                            } elseif ($tipoArchivo == 'audio') {
                                $icono_archivo = 'fas fa-file-audio';
                            }

                            echo '<option value="' . $recRow['id_recurso'] . '">' . $nombreArchivo . '</option>';
                        }

                        echo '
                                    </select>
                                </div>    
                            </div>
                        </div>';
                    }
                    echo '<div id="iframe-container" style="display: none;">
                            <iframe id="video-iframe" style="width: 100%; height: 500px; border: none;"></iframe>
                        </div>';
                    ?>



                    <!-- Agregar el botón y el iframe -->
                    <button class="toggleIframeBtn btn btn-primary" data-iframe="iframe1">Video 1</button>
                    <button class="toggleIframeBtn btn btn-primary" data-iframe="iframe2">Video 2</button>
                    <div id="iframe1" class="iframe-container" style="display: none;" data-src="mostrar_arch.php"
                        data-video-select="22">
                        <iframe style="width: 100%; height: 500px; border: none;"></iframe>
                    </div>
                    <div id="iframe2" class="iframe-container" style="display: none;" data-src="mostrar_arch.php"
                        data-video-select="24">
                        <iframe style="width: 100%; height: 500px; border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
function loadVideo(selectElement) {
    var selectedVideoId = selectElement.value;
    var iframeContainer = document.getElementById('iframe-container');
    var videoIframe = document.getElementById('video-iframe');

    if (selectedVideoId) {
        var dataSrc = selectElement.dataset.src;
        var dataVideoSelect = selectElement.dataset.videoSelect;

        iframeContainer.style.display = 'block';
        videoIframe.src = dataSrc + '?video_select=' + dataVideoSelect;
    } else {
        iframeContainer.style.display = 'none';
        videoIframe.src = '';
    }
}
</script>