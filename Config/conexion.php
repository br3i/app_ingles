<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'app_ingles';

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die('Error de conexión: ' . mysqli_connect_error());
}
?>