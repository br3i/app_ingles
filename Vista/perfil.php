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
                            <h3 class="card-title">Welcome to your Profile,
                                <b>
                                    <?php echo $_SESSION['username']; ?>!
                                </b>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="card col-md-6">
                                    <div>
                                        <h4>
                                            <?php echo $_SESSION['username']; ?>

                                        </h4>
                                        <!-- Otros detalles del perfil, como descripción, fecha de registro, etc. -->

                                        <p>Description: *Lorem ipsum dolor sit amet*.</p>

                                        <p>Member since:
                                            <?php echo date_format(date_create($_SESSION['fecha_creacion']), 'F d, Y'); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="card col-md-6 align-items-center">
                                    <div>
                                        <?php
                                        $imageInfo = getimagesizefromstring($_SESSION['foto_perfil']);

                                        if ($imageInfo !== false) {
                                            $mime = $imageInfo['mime'];

                                            switch ($mime) {
                                                case 'image/jpeg':
                                                    $mime = 'jpeg';
                                                    break;
                                                case 'image/png':
                                                    $mime = 'png';
                                                    break;
                                                case 'image/gif':
                                                    $mime = 'gif';
                                                    break;
                                                case 'image/jpg':
                                                    $mime = 'jpg';
                                                    break;
                                                default:
                                                    // El tipo de imagen no es reconocido
                                                    break;
                                            }
                                        } else {
                                            // No se pudo obtener información sobre la imagen
                                        }

                                        echo "<img src='data:image/$mime;base64," . base64_encode($_SESSION['foto_perfil']) . "' class='img-circle elevation-2' alt='User Image' style='width: 30%; opacity: 0.9; margin: 0 auto; display: block;'>";
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Aquí puedes incluir los datos adicionales del perfil, estadísticas y otros elementos que desees mostrar -->
                            <div class="row">
                                <div class="card col-md-6">
                                    <div class="data-item">
                                        <h4>Days Streak:</h4>
                                        <p>10</p>
                                    </div>
                                </div>
                                <div class="card col-md-6">
                                    <div class="data-item">
                                        <h4>Ranking:</h4>
                                        <p>#5</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Puedes mostrar los logros -->
                            <div class="row">
                                <div class="card col-md-12 achievements">
                                    <h4>Achievements:</h4>
                                    <ul>
                                        <li>
                                            <span>Achievement 1</span>
                                            <button class="btn btn-primary btn-sm">Claim Reward</button>
                                        </li>
                                        <li>
                                            <span>Achievement 2</span>
                                            <button class="btn btn-primary btn-sm">Claim Reward</button>
                                        </li>
                                        <li>
                                            <span>Achievement 3</span>
                                            <button class="btn btn-primary btn-sm">Claim Reward</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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