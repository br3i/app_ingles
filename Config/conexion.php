<?php
$host = 'free.clusters.zeabur.com';
$user = 'root';
$pass = 'zDoJZP80vCw2h6RkBydeg749q3sS1Kc5';
$db = 'zeabur';
$port = '30122';

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