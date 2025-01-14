<?php
$host = 'free.clusters.zeabur.com';
$user = 'root';
$pass = 'dJap1XjSN87m0yeT9M436qEQzR25hOoG';
$db = 'zeabur';
$port = '31691';

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