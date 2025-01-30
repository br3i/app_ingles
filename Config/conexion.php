<?php
$host = 'free.clusters.zeabur.com';
$user = 'root';
$pass = 'hQV1oS5OzitIng2Z3l07fCm8yYbW96A4';
$db = 'zeabur';
$port = '30761';

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