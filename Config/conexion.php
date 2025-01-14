<?php
$host = 'free.clusters.zeabur.com';
$user = 'root';
$pass = 'wFyz56v2EVCZWgi1j8LX04PeA9u3SDk7';
$db = 'zeabur';
$port = '30839';

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