<?php
$host = 'free.clusters.zeabur.com';
$user = 'root';
$pass = 'Z6DmKf4rTgp92VbWl0GLkMR8E5N3X1x7';
$db = 'zeabur';
$port = '32411';

$con = mysqli_connect($host, $user, $pass, $db, $port);

if (!$con) {
    die('Error de conexión: ' . mysqli_connect_error());
}
// ?>
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