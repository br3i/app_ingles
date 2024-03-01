<?php
if (isset($_REQUEST['guardar'])) {
  include_once "..\Config\conexion.php";

  $username = mysqli_real_escape_string($con, $_POST['username'] ?? '');
  $nombre = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
  $password = mysqli_real_escape_string($con, $_POST['passw'] ?? '');
  $rol = mysqli_real_escape_string($con, $_POST['rol'] ?? '');

  if ($username == '' || $nombre == '' || $password == '' || $rol == '') {
    $errorMessage = "Todos los campos son obligatorios";
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);

    $fotoPerfil = "";

    if (isset($_FILES['fperfil']['tmp_name']) && !empty($_FILES['fperfil']['tmp_name'])) {
      $fotoPerfil = addslashes(file_get_contents($_FILES['fperfil']['tmp_name']));
    } else if (isset($_POST['fotDefault']) && $_POST['fotDefault'] == 'ftDefault') {
      $fotoPerfil = addslashes(file_get_contents("..\Publico\img\arq1.jpg"));
    } else if (isset($_POST['fotDefault']) && $_POST['fotDefault'] == 'ftDefault2') {
      $fotoPerfil = addslashes(file_get_contents("..\Publico\img\arq2.jpg"));
    }

    $query = "INSERT INTO usuario (username, nombre, passw, rol, foto_perfil) VALUES ('$username', '$nombre','$password', '$rol', '$fotoPerfil');";
    $result = mysqli_query($con, $query);
    if ($result) {
      echo "<meta http-equiv='refresh' content='0;url=..\index.php?mensaje=Usuario creado exitosamente'/>";
    } else {
      ?>
      <div class="alert alert-danger" role="alert">
        Error al crear el usuario
        <?php echo mysqli_error($con); ?>
      </div>
      <?php
    }
    mysqli_close($con);
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplicación Ingles</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Publico/css/fontawesome-free/css/all.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="../Publico/css/adminlte.min.css">

  <!-- Mi css -->
  <link rel="stylesheet" href="../Publico/css/style.css">
</head>



<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create an Account</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="nombre" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="passw" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="">Role</label>
                    <select name="rol" class="form-control">
                      <?php
                      $usuario_actual = "estudiante"; // Coloca aquí el rol del usuario actual obtenido de tu base de datos o autenticación
                      
                      // Opciones permitidas según el rol del usuario actual
                      $opciones_admin = ['admin', 'estudiante', 'docente'];
                      $opciones_estudiante_docente = ['estudiante', 'docente'];

                      $opciones = ($usuario_actual === 'admin') ? $opciones_admin : $opciones_estudiante_docente;

                      // Generar las opciones
                      foreach ($opciones as $opcion) {
                        echo "<option value=\"$opcion\">$opcion</option>";
                      }
                      ?>
                    </select>
                  </div>


                  <div class="form-group">
                    <label for="">Profile photo</label>
                    <br>
                    <div style="display: flex; justify-content: space-evenly; border: 1px solid #ced4da;border-radius: .25rem; box-shadow: inset 0 0 0 transparent;">
                      <div>
                        <input type="radio" id="ftDeafault" name="fotDefault" value="ftDefault">
                        <img src="..\Publico\img\arq1.jpg" alt="" style='width: 150px;'>
                      </div>
                      <div>
                        <input type="radio" id="ftDeafault2" name="fotDefault" value="ftDefault2">
                        <img src="..\Publico\img\arq2.jpg" alt="" style='width: 150px;'>
                      </div>
                      <button type="button" class="btn bg-gradient-info btn-sm" id="btnDeseleccionar"
                        style="position: absolute; left: 20px" onclick="uncheckRadioButtons()">X</button>
                    </div>
                  </div>
                  
                  <br>
                  <label for="">Select a default image or upload one of your choice</label>
                  <input type="file" name="fperfil" class="form-control" id="inpFoto" value="UPLOAD">
                  <br>

                  <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-primary alert-dismissible fade show position-fixed"
                      style="top: 20px; right: 20px;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                      <?php echo $errorMessage; ?>
                    </div>
                  <?php endif; ?>



                  <div class="form-group">
                    <button type="submit" class="btn btn-success" name="guardar">Create</button>
                    <button type="button" class="btn btn-primary" id="btnCancelar"
                      onclick="window.location.href='../index.php'">Cancel</button>
                  </div>
                </form>
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
  <script src="../Publico/js/my-scripts.js"></script>




  <!-- jQuery -->
  <script src="../Publico/js/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../Publico/ext/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>