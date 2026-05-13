<?php

$host = getenv('MYSQLHOST');
$user = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');
$database = getenv('MYSQLDATABASE');
$port = getenv('MYSQLPORT');

$connect = mysqli_connect(
    $host,
    $user,
    $password,
    $database,
    $port
);

if (!$connect) {
    die('Error connect to DataBase: ' . mysqli_connect_error());
}
?>