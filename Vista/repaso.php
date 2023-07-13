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
                            <h3 class="card-title">Welcome to your train session!</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p>Get started with your English learning journey. Choose from a variety of activities and
                                tests to improve your language skills.</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="info-box bg-primary">
                                        <span class="info-box-icon"><i class="fas fa-file-signature"></i></span>
                                        <div class="info-box-content">
                                            <h4 class="info-box-text">Ahorcado</h4>
                                            <a href="panel.php?modulo=ahorcado"
                                                class="btn btn-outline-light text-ellipsis"><b>Play</b></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-box bg-success">
                                        <span class="info-box-icon"><i class="fas fa-pencil-alt"></i></span>
                                        <div class="info-box-content">
                                            <h4 class="info-box-text">Crucigrama</h4>
                                            <a href="panel.php?modulo=crucigrama"
                                                class="btn btn-outline-light text-ellipsis"><b>Play</b></a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Agregar los botones y iframes -->

                                <div class="col-md-4">
                                    <div class="info-box bg-dark">
                                        <span class="info-box-icon"><i class="fas fa-pencil-alt"></i></span>
                                        <div class="info-box-content">
                                            <h4 class="info-box-text">Repaso 1</h4>
                                            <a href="panel.php?modulo=ejRep1"
                                                class="btn btn-outline-light text-ellipsis"><b>Repaso 1</b></a>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="info-box bg-dark">
                                        <span class="info-box-icon"><i class="fas fa-pencil-alt"></i></span>
                                        <div class="info-box-content">
                                            <h4 class="info-box-text">Repaso 2</h4>
                                            <a href="panel.php?modulo=ejRep2"
                                                class="btn btn-outline-light text-ellipsis"><b>Repaso 2</b></a>
                                        </div>
                                    </div>
                                </div>



                                <!-- <button class="toggleIframeBtn btn btn-primary" data-iframe="iframe1">Repaso 1</button>
                                <button class="toggleIframeBtn btn btn-primary" data-iframe="iframe2">Repaso 2</button>

                                <div id="iframe1" class="iframe-container" style="display: none;">
                                    <iframe src="ejRep1.php" style="width: 100%; height: 500px; border: none;"></iframe>
                                </div>
                                <div id="iframe2" class="iframe-container" style="display: none;">
                                    <iframe src="ejRep2.php" style="width: 100%; height: 500px; border: none;"></iframe>
                                </div> -->
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 60%"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                    <span>Activity 3/10</span>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <span>Course Progress: 30%</span>
                            </div>
                        </div>
                        <!-- /.card-body -->
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


<!-- Agrega el siguiente código al encabezado de tu página -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        // Agrega el evento click a cada botón para mostrar/ocultar el iframe correspondiente
        $(".toggleIframeBtn").click(function () {
            var iframeId = $(this).data("iframe");

            // Recargar el contenido del otro iframe
            var otherIframeId = (iframeId === "iframe1") ? "iframe2" : "iframe1";
            $("#" + otherIframeId + " iframe").attr("src", $("#" + otherIframeId + " iframe").attr("src"));

            $("#" + iframeId).slideToggle();
            $(".iframe-container").not("#" + iframeId).slideUp();
        });
    });
</script>