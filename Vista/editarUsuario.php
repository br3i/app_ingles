<?php
include_once "..\Config\conexion.php";

$query = "SELECT * FROM usuario WHERE id_usuario = '" . $_SESSION['id_usuario'] . "';";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$passAuxiliar = $row['passw'];

if (isset($_POST['canEditar'])) {
  echo "<meta http-equiv='refresh' content='0;url=panel.php?modulo=usuarios'/>";
} elseif (isset($_POST['editar'])) {
  $username = mysqli_real_escape_string($con, $_POST['username'] ?? '');
  $passw = mysqli_real_escape_string($con, $_POST['passw'] ?? '');
  $foto_perfil = mysqli_real_escape_string($con, $_POST['foto_perfil'] ?? '');
  if ($passw == '') {
    $passw = $passAuxiliar;
  } else {
    $passw = password_hash($passw, PASSWORD_DEFAULT);
  }
  $id = mysqli_real_escape_string($con, $_POST['id_usuario'] ?? '');


  if ($username == '' || $passw == '') {
    ?>
    <div class="alert alert-danger" role="alert">
      No se admiten valores en blanco
      <?php echo mysqli_error($con); ?>
    </div>
    <?php

    return;
  } else {
    $fotoPerfil = $row['foto_perfil'];
    $queryFields = "username = '" . $username . "', password = '" . $passw . "', foto_perfil  = '" . $foto_perfil . "'";


    if (isset($_FILES['fperfilEditar']) && $_FILES['fperfilEditar']['error'] == 0) {
      if ($_FILES['fperfilEditar']['size'] <= 10485760) {
        $fotoPerfilType = $_FILES['fperfilEditar']['type'];
        if ($fotoPerfilType == "image/x-icon" || $fotoPerfilType == "image/jpg" || $fotoPerfilType == "image/jpeg" || $fotoPerfilType == "image/png" || $fotoPerfilType == "image/gif") {
          $fotoPerfil = addslashes(file_get_contents($_FILES['fperfilEditar']['tmp_name']));
          $queryFields .= ", fotoPerfil = '" . $fotoPerfil . "'";
        } else {
          ?>
          <div class="alert alert-danger alert-dismissible fade show content-wrapper" role="alert">
            <p style="font-size: 25px;">
              <strong>Error:</strong>
              El tipo de archivo seleccionado no es válido, por favor seleccione un archivo de imagen. (Ej: jpg, jpeg, png, gif)
            </p>
          </div>
          <script>   setTimeout(function () { window.location.href = "panel.php?modulo=editarUsuario&id=<?php echo $id_usuario; ?>"; }, 4500);
          </script>
          <?php
          return;
        }
      } else {
        ?>
    <div class="alert alert-danger alert-dismissible fade show content-wrapper" role="alert">
      <p style="font-size: 25px;">
        <strong>Error:</strong>
        El peso de la imagen seleccionada supera los 10MB, por favor seleccione una imagen más pequeña.
      </p>
    </div>
    <script>   setTimeout(function () { window.location.href = "panel.php?modulo=editarUsuario&id_usuario=<?php echo $id_usuario; ?>"; }, 4500);
    </script>
    <?php
            return;
      }
    }

    $query = "UPDATE usuarios SET " . $queryFields . " WHERE id_usuarios = '" . $id_usuario . "';";


    $result = mysqli_query($con, $query);
    if ($result) {
      echo "<meta http-equiv='refresh' content='0;url=panel.php?modulo=usuarios&mensaje=Usuario " . $username . " editado exitosamente'/>";
    } else {
      ?>
    <div class="alert alert-danger" role="alert">
      Error al editar el usuario
      <?php echo mysqli_error($con); ?>
    </div>
    <?php
    }
    mysqli_close($con);
  }
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit User</h1>
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
              <form action="panel.php?modulo=editarUsuario" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="">Username</label>
                  <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>"
                    required>
                </div>
                <div class="form-group">
                  <label for="">Password</label>
                  <div class="input-group">
                    <input type="password" name="passw" class="form-control" id="passwordInput"
                      onfocus="verifyPassword()">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="fa fa-eye" id="passwordEye"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Profile Photo</label>
                  <br>
                  <div style="display: flex;
                       justify-content: space-evenly;
                       border: 1px solid #ced4da;border-radius: .25rem;
                       box-shadow: inset 0 0 0 transparent;
                       align-items: center;">
                    <img src="data:image/jpg;base64,<?php echo base64_encode($row['foto_perfil']); ?>" alt=""
                      style="width: 125px;">
                    <input type="file" name="fperfilEditar" class="form-control" value="UPLOAD">
                  </div>
                  <div class="form-group">
                    <br>
                    <input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario'] ?>">
                    <button type="submit" class="btn btn-success" name="editar">Save</button>
                    <button type="button" class="btn btn-primary" name="canEditar"
                      onclick="window.location.href='panel.php?modulo=perfil'">Cancel</button>
                  </div>
              </form>
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