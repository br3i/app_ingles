<!DOCTYPE html>
<html lang="en">
<?php
session_start();
session_regenerate_id(true);

if (isset($_GET['sesion']) && $_GET['sesion'] == 'cerrar') {
  session_destroy();
  header("location: ../index.php");
  exit;
}

if (!isset($_SESSION['id_usuario'])) {
  header("location: ../index.php");
  exit;
}

$modulo = isset($_GET['modulo']) ? $_GET['modulo'] : '';

include_once "../Config/conexion.php";

function obtenerPreguntas($tipo) {
    global $con;
    $query = "SELECT a.*, r.location 
              FROM actividad a
              JOIN recurso r ON a.id_recurso = r.id_recurso
              WHERE a.tipo = '$tipo'";
    $result = mysqli_query($con, $query);

    $preguntas = array();
    $id = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        $opciones = explode(',', $row['opciones']);
        $preguntas[] = array(
            'id' => $id,
            'tipo' => $row['tipo'],
            'id_recurso' => intval($row['id_recurso']),
            'id_actividad' => intval($row['id_actividad']),
            'descripcion' => $row['descripcion'],
            'pregunta' => $row['pregunta'],
            'respuesta' => $row['respuesta'],
            'opciones' => $opciones,
            'ruta_video' => $row['location']
        );
        $id++;
    }

    return $preguntas;
}

$preguntasPrueba = obtenerPreguntas('Prueba');
$preguntasActividad = obtenerPreguntas('Actividad');

$preguntasJsonPrueba = json_encode($preguntasPrueba, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
$preguntasJsonActividad = json_encode($preguntasActividad, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$filePrueba = fopen('../Publico/js/PreguntasPrueba.js', 'w');
fwrite($filePrueba, 'let preguntas = ' . $preguntasJsonPrueba . ';');
fclose($filePrueba);

$fileActividad = fopen('../Publico/js/PreguntasActividad.js', 'w');
fwrite($fileActividad, 'let preguntasActividad = ' . $preguntasJsonActividad . ';');
fclose($fileActividad);
?>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>App Ingles</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Publico/plugins/fontawesome-free/css/all.min.css" />
  <!-- FontAweome CDN Link for Icons-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../Publico/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
  <!-- iCheck -->
  <link rel="stylesheet" href="../Publico/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <!-- JQVMap -->
  <link rel="stylesheet" href="../Publico/plugins/jqvmap/jqvmap.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="../Publico/css/adminlte.min.css" />
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../Publico/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../Publico/plugins/daterangepicker/daterangepicker.css" />
  <!-- summernote -->
  <link rel="stylesheet" href="../Publico/plugins/summernote/summernote-bs4.min.css" />
  <!-- DataTables -->
  <!-- <link rel="stylesheet" href="../Publico/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../Publico/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../Publico/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> -->


  <!-- My css -->
  <link rel="stylesheet" href="../Publico/css/my-css.css" />
  <link rel="stylesheet" href="../Publico/css/prueba.css">

  <!-- Ventana modal para eliminar usuarios -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
  <div class="wrapper">
    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../Publico/img/soloLogoRatbio.png" alt="My App Logo" height="60" width="60" />
    </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- Navbar Search -->

        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                  aria-label="Search" />
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li> -->

        <!-- Norifications Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li> -->


        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
          <a class="nav-link" href="panel.php?modulo=racha">
            <i class="fas fa-fire text-dark"></i>
            <span class="badge badge-danger navbar-badge" style="position: relative; top: -10px; right: 7px;">
              3
            </span>
          </a>
        </li>

        <!-- Editar Perfil -->
        <!-- echo 'panel.php?' . http_build_query(['modulo' => 'editarUsuario']); ?> -->
        <a href="panel.php?modulo=perfil" class="nav-link text-dark">
          <i class=" far fa-user"></i>
        </a>
        <a class="nav-link text-danger" href="panel.php?modulo=&sesion=cerrar" title="Sign out">
          <i class="fa fa-door-closed"></i>
        </a>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="panel.php?modulo=inicio" class="brand-link">
        <img src="../Publico/img/soloLogoRatbio.png" alt="My App Logo" class="brand-image img-circle elevation-3"
          style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Ratbio</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <div>
              <?php

              $imageInfo = getimagesizefromstring($_SESSION['foto_perfil']);

              if ($imageInfo !== false) {
                $mime = $imageInfo['mime'];

                switch ($mime) {
                  case 'image/jpeg':
                    echo "<img src='data:image/jpeg;base64," . base64_encode($_SESSION['foto_perfil']) . "' class='img-circle elevation-2' alt='User Image' style='opacity: 0.9'>";
                    break;
                  case 'image/png':
                    echo "<img src='data:image/png;base64," . base64_encode($_SESSION['foto_perfil']) . "' class='img-circle elevation-2' alt='User Image' style='opacity: 0.9'>";
                    break;
                  case 'image/gif':
                    echo "<img src='data:image/gif;base64," . base64_encode($_SESSION['foto_perfil']) . "' class='img-circle elevation-2' alt='User Image' style='opacity: 0.9'>";
                    break;
                  case 'image/jpg':
                    echo "<img src='data:image/jpg;base64," . base64_encode($_SESSION['foto_perfil']) . "' class='img-circle elevation-2' alt='User Image' style='opacity: 0.9'>";
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
          </div>
          <div class="info">
            <a href="#" class="d-block">
              <?php echo $_SESSION['username'] ?>
            </a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <!--
          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input
                class="form-control form-control-sidebar"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>
          -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="fas fa-book-open nav-icon" aria-hidden="true"></i>
                <p>
                  Menu
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="panel.php?modulo=actividades"
                    class="nav-link <?php echo ($modulo == "actividades" || $modulo == "inicio" || $modulo == "") ? " active " : " "; ?>">
                    <i class="fas fa-pencil-alt nav-icon" aria-hidden="true"></i>
                    <p>Activities</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=prueba"
                    class="nav-link <?php echo ($modulo == "prueba" || $modulo == "inicio" || $modulo == "") ? " active " : " "; ?>">
                    <i class="fas fa-file-signature nav-icon" aria-hidden="true"></i>
                    <p>Tests</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=repaso"
                    class="nav-link <?php echo ($modulo == "repaso" || $modulo == "inicio" || $modulo == "") ? " active " : " "; ?>">
                    <i class="fas fa-dumbbell nav-icon" aria-hidden="true"></i>
                    <p>Training</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=ranking"
                    class="nav-link <?php echo ($modulo == "ranking" || $modulo == "inicio" || $modulo == "") ? " active " : " "; ?>">
                    <i class="fas fa-crown nav-icon" aria-hidden="true"></i>
                    <p>Ranking</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=logros"
                    class="nav-link <?php echo ($modulo == "logros" || $modulo == "inicio" || $modulo == "") ? " active " : " "; ?>">
                    <i class="fas fa-trophy nav-icon" aria-hidden="true"></i>
                    <p>Achivements</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=bonificacion"
                    class="nav-link <?php echo ($modulo == "bonificacion" || $modulo == "inicio" || $modulo == "") ? " active " : " "; ?>">
                    <i class="fas fa-star nav-icon" aria-hidden="true"></i>
                    <p>Bonification</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=racha"
                    class="nav-link <?php echo ($modulo == "racha" || $modulo == "inicio" || $modulo == "") ? " active " : " "; ?>">
                    <i class="fas fa-fire nav-icon" aria-hidden="true"></i>
                    <p>Streak</p>
                  </a>
                </li>
                <?php
                if ($_SESSION['rol'] == 'admin' || $_SESSION['rol'] == 'docente') {
                  ?>
                  <li class="nav-item">
                    <a href="panel.php?modulo=recursos"
                      class="nav-link <?php echo ($modulo == "recursos" || $modulo == "inicio" || $modulo == "") ? " active " : " "; ?>">
                      <i class="fas fa-film nav-icon" aria-hidden="true"></i>
                      <p>Resources</p>
                    </a>
                  </li>
                  <?php
                }
                ?>
              </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <?php
    if (isset($_REQUEST['mensaje'])) {
      ?>
      <div class="alert alert-primary alert-dismissible fade show"
        style="position: absolute; top: 8%; right: 20px; z-index: 9999;" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <?php echo $_REQUEST['mensaje']; ?>
      </div>
      <?php
    }
    if ($modulo == 'inicio' || $modulo == '') {
      include_once 'inicio.php';
    }
    if ($modulo == 'actividades') {
      include_once 'actividades.php';
    }
    if ($modulo == 'repaso') {
      include_once 'repaso.php';
    }
    if ($modulo == 'ranking') {
      include_once 'ranking.php';
    }
    if ($modulo == 'logros') {
      include_once 'logros.php';
    }
    if ($modulo == 'bonificacion') {
      include_once 'bonificacion.php';
    }
    if ($modulo == 'racha') {
      include_once 'racha.php';
    }
    if ($modulo == 'perfil') {
      include_once 'perfil.php';
    }
    if ($modulo == 'editarUsuario') {
      include_once 'editarUsuario.php';
    }
    if ($modulo == 'ahorcado') {
      include_once 'ahorcado.php';
    }
    if ($modulo == 'crucigrama') {
      include_once 'crucigrama.php';
    }
    if ($modulo == 'recursos') {
      include_once 'admin_recursos.php';
    }
    if ($modulo == 'ver_recurso') {
      include_once 'ver_recurso.php';
    }
    if ($modulo == 'eliminar_recurso') {
      include_once 'eliminar_recurso.php';
    }
    if ($modulo == 'prueba') {
      include_once 'prueba.php';
    }
    if ($modulo == 'ejRep1') {
      include_once 'ejRep1.php';
    }
    if ($modulo == 'ejRep2') {
      include_once 'ejRep2.php';
    }
    ?>

    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <strong>Copyright &copy; 2022-2023
        <a href="panel.php?modulo=inicio">App Ingles</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>

  </div>
<<<<<<< HEAD
  <script src="../Publico/"></script>
  <script src="../Publico/js/jquery-3.2.1.min.js"></script>
  <script src="../Publico/js/bootstrap.min.js"></script>
=======
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
>>>>>>> 084a356a6bf8d281d23780a6c6a8c4cb9f5b27e4
  <!-- jQuery -->
  <script src="../Publico/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../Publico/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge("uibutton", $.ui.button);
  </script>
  <!-- Bootstrap 4 -->
  <script src="../Publico/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="../Publico/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="../Publico/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="../Publico/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="../Publico/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="../Publico/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="../Publico/plugins/moment/moment.min.js"></script>
  <script src="../Publico/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../Publico/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="../Publico/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../Publico/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../Publico/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
<<<<<<< HEAD
  <script src="../Publico/js/demo.js"></script>
=======
  <script src="../Publico/js/js/demo.js"></script>
>>>>>>> 084a356a6bf8d281d23780a6c6a8c4cb9f5b27e4
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../Publico/js/pages/dashboard.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../Publico/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../Publico/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../Publico/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../Publico/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../Publico/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../Publico/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../Publico/plugins/jszip/jszip.min.js"></script>
  <script src="../Publico/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../Publico/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../Publico/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../Publico/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../Publico/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Page specific script -->
  <script>
    $(function () {
      $("#example2").DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
      });
    });
  </script>

  <!-- Script para confirmar la eliminacion de un registro -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

  <!-- Script para confirmar la eliminacion de un registro -->
  <script>
    $(document).ready(function () {
      $(".borrarU").click(function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        $("#confirmModal").modal("show");
        $("#confirmBtn").click(function () {
          window.location = link;
        });
      });
    });
  </script>

  <!-- Script para llamar a la función nuevoProducto -->
  <!-- <script>
    document.getElementById("nuevoProductoBtn").addEventListener("click", function () {
      $("#modalAñadir").modal("show");
    });
  </script> -->

  <!-- Ventana Modal Para eliminar un registro -->
  <!-- <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Estás seguro de eliminar este registro?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" id="confirmBtn" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div> -->

  <!-- Modal para editar -->
  <!-- <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar valores</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="nombrePro">Nombre</label>
              <input type="text" class="form-control" id="nombrePro">
            </div>
            <div class="form-group">
              <label for="precioPro">Precio</label>
              <input type="number" class="form-control" id="precioPro">
            </div>
            <div class="form-group">
              <label for="existenciaPro">Existencia</label>
              <input type="number" class="form-control" id="existenciaPro">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="GuCaProductos()">Guardar
            cambios</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div> -->

  <!-- Modal para añadir producto -->
  <!-- <div class="modal fade" id="modalAñadir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Añadir producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="nPro">Nombre</label>
              <input type="text" class="form-control" id="nPro">
            </div>
            <div class="form-group">
              <label for="pPro">Precio</label>
              <input type="number" class="form-control" id="pPro">
            </div>
            <div class="form-group">
              <label for="ePro">Existencia</label>
              <input type="number" class="form-control" id="ePro">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="nuevoProducto()">Añadir producto</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div> -->

<<<<<<< HEAD
  <!-- My Scripts -->
=======

>>>>>>> 084a356a6bf8d281d23780a6c6a8c4cb9f5b27e4
  <script src="../Publico/js/my-scripts.js"></script>


  <!-- Inside this JavaScript file I've inserted Questions and Options only -->
  <script src="../Publico/js/PreguntasActividad.js"></script>
  <script src="../Publico/js/PreguntasPrueba.js"></script>
  <!-- Inside this JavaScript file I've coded all Quiz Codes -->
  <script src="../Publico/js/pruebas.js"></script>
</body>

</html>