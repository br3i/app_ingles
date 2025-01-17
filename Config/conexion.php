<?php
$host = 'free.clusters.zeabur.com';
$user = 'root';
$pass = 'qp2J94vAF018mLQ5dPisN3raEh7ybH6S';
$db = 'zeabur';
$port = '30476';

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