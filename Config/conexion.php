<?php
$host = 'free.clusters.zeabur.com';
$user = 'root';
$pass = 'n1PkWZ362UAI85uEv7By4XjgH09oqfQO';
$db = 'zeabur';
$port = '30464';

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