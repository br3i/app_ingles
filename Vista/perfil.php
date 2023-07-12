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
                            <div>
                                <div>
                                    <?php


                                    $imageInfo = getimagesizefromstring($_SESSION['foto_perfil']);

                                    if ($imageInfo !== false) {
                                        $mime = $imageInfo['mime'];

                                        switch ($mime) {
                                            case 'image/jpeg':
                                                echo "<img src='data:image/jpeg;base64," . base64_encode($_SESSION['foto_perfil']) . "'";
                                                break;
                                            case 'image/png':
                                                echo "<img src='data:image/png;base64," . base64_encode($_SESSION['foto_perfil']) . "'";
                                                break;
                                            case 'image/gif':
                                                echo "<img src='data:image/gif;base64," . base64_encode($_SESSION['foto_perfil']) . "'";
                                                break;
                                            case 'image/jpg':
                                                echo "<img src='data:image/jpg;base64," . base64_encode($_SESSION['foto_perfil']) . "'";
                                                break;
                                            default:
                                                // El tipo de imagen no es reconocido
                                                break;
                                        }
                                    } else {
                                        // No se pudo obtener información sobre la imagen
                                    }
                                    ?>
                                </div>
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

                            <!-- Aquí puedes incluir los datos adicionales del perfil, estadísticas y otros elementos que desees mostrar -->
                            <div class="profile-data">
                                <div class="data-item">
                                    <h4>Days Streak:</h4>
                                    <p>10</p>
                                </div>
                                <div class="data-item">
                                    <h4>Total Experience:</h4>
                                    <p>1000</p>
                                </div>
                            </div>

                            <!-- Puedes mostrar los logros -->
                            <div class="achievements">
                                <h4>Achievements:</h4>
                                <ul>
                                    <li>Achievement 1</li>
                                    <li>Achievement 2</li>
                                    <li>Achievement 3</li>
                                </ul>
                            </div>

                            <!-- Puedes añadir un botón para reclamar los logros -->
                            <div>
                                <button class="btn btn-primary">Claim Achievements</button>
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