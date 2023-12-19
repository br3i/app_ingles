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
                            <h3 class="card-title">Welcome to Your English Learning Dashboard!</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p>Get started with your English learning journey. Choose from a variety of activities and
                                tests to improve your language skills.</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box bg-primary">
                                        <span class="info-box-icon"><i class="fas fa-pencil-alt"></i></span>
                                        <div class="info-box-content">
                                            <h4 class="info-box-text">Activities</h4>
                                            <a href="panel.php?modulo=actividades"
                                                class="btn btn-outline-light text-ellipsis"><b>Do
                                                    Activities</b></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-success">
                                        <span class="info-box-icon"><i class="fas fa-file-signature"></i></span>
                                        <div class="info-box-content">
                                            <h4 class="info-box-text">Tests</h4>
                                            <a href="panel.php?modulo=prueba"
                                                class="btn btn-outline-light text-ellipsis"><b>Try
                                                    Lessons</b></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-dark">
                                        <span class="info-box-icon"><i class="fas fas fa-dumbbell"></i></span>
                                        <div class="info-box-content">
                                            <h4 class="info-box-text">Training</h4>
                                            <a href="panel.php?modulo=repaso"
                                                class="btn btn-outline-light text-ellipsis"><b>Train</b></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-warning">
                                        <span class="info-box-icon"><i class="fas fa-crown"></i></span>
                                        <div class="info-box-content">
                                            <h4 class="info-box-text">Ranking</h4>
                                            <a href="panel.php?modulo=ranking"
                                                class="btn btn-outline-light text-ellipsis text-dark"><b>View
                                                    Rank</b></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-info">
                                        <span class="info-box-icon"><i class="fas fa-trophy"></i></span>
                                        <div class="info-box-content">
                                            <h4 class="info-box-text">Achiviements</h4>
                                            <a href="panel.php?modulo=logros"
                                                class="btn btn-outline-light text-ellipsis"><b>Achiviements</b></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon"><i class="fas fa-star"></i></span>
                                        <div class="info-box-content">
                                            <h4 class="info-box-text">Bonification</h4>
                                            <a href="panel.php?modulo=bonificacion"
                                                class="btn btn-outline-dark text-ellipsis text-dark"><b>Get
                                                    Bonus</b></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-danger">
                                        <span class="info-box-icon"><i class="fas fa-fire"></i></span>
                                        <div class="info-box-content">
                                            <h4 class="info-box-text">Streak</h4>
                                            <a href="panel.php?modulo=racha"
                                                class="btn btn-outline-light text-ellipsis"><b>Keep on
                                                    fire!</b></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($_SESSION['rol'] == 'admin' || $_SESSION['rol'] == 'docente') {
                                    ?>
                                    <div class="col-md-3">
                                        <div class="info-box bg-secondary">
                                            <span class="info-box-icon"><i class="fas fa-film"></i></span>
                                            <div class="info-box-content">
                                                <h4 class="info-box-text">Resources</h4>
                                                <a href="panel.php?modulo=recursos"
                                                    class="btn btn-outline-light text-ellipsis"><b>Upload!</b></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
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