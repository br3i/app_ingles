<?php
$host = 'free.clusters.zeabur.com';
$user = 'root';
$pass = 'm5cqj2dG8Obf4VZ7130r6EQIiz9SLPHe';
$db = 'zeabur';
$port = '32606';

$con = mysqli_connect($host, $user, $pass, $db, $port);

if (!$con) {
    die('Error de conexión: ' . mysqli_connect_error());
}
?>
<?php
// $host = 'localhost';
// $user = 'root';
// $pass = '';
// $db = 'app_ingles';

// $con = mysqli_connect($host, $user, $pass, $db);

// if (!$con) {
//     die('Error de conexión: ' . mysqli_connect_error());
// }
?>