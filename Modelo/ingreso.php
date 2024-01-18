<?php
// $conexion = mysqli_connect('localhost','root','','prueba');
include("../Config/conexion.php");
$username = $_REQUEST['username'] ?? '';
$password = $_REQUEST['passw'] ?? '';
$rol = $_REQUEST['rol'] ?? '';
$hash = password_hash($password, PASSWORD_DEFAULT);
include_once "Config/conexion.php";
$query = "INSERT into usuarios (username, passw, rol) VALUES ('$username', '$hash', '$rol');";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);

if ($result) {
    echo "<meta http-equiv='refresh' content='0;url=panel.php?modulo=usuarios&mensaje=Usuario creado exitosamente'/>";
} else {
    ?>
    <div class="alert alert-danger" role="alert">
        Error al crear el usuario
        <?php echo mysqli_error($con); ?>
    </div>
    <?php
}
mysqli_close($con);

?>



<!-- <?php
/* if (isset($_REQUEST['guardar'])) {
    include_once "conexion.php";


    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $email = mysqli_real_escape_string($con, $_POST['email'] ?? '');
    $password = mysqli_real_escape_string($con, $_POST['passw'] ?? '');

    if ($nombre == '' || $email == '' || $password == '') {
        echo "Todos los campos son obligatorios";
        exit;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $fotoPerfil = "";

    if (isset($_FILES['fperfil']['tmp_name']) && !empty($_FILES['fperfil']['tmp_name'])) {
        $fotoPerfil = addslashes(file_get_contents($_FILES['fperfil']['tmp_name']));
    } else if (isset($_POST['fotDefault']) && $_POST['fotDefault'] == 'ftDefault') {
        $fotoPerfil = addslashes(file_get_contents("dist\img\michiSandia.png"));
    } else if (isset($_POST['fotDefault']) && $_POST['fotDefault'] == 'ftDefault2') {
        $fotoPerfil = addslashes(file_get_contents("dist\img\avatar2.png"));
    }

    $query = "INSERT INTO usuarios (email, pass, nombre, fotoPerfil) VALUES ('$email', '$password', '$nombre', '$fotoPerfil');";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo "<meta http-equiv='refresh' content='0;url=panel.php?modulo=usuarios&mensaje=Usuario creado exitosamente'/>";
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
?>
*/