<?php

$host = getenv('mysql.railway.internal');
$user = getenv('railway');
$password = getenv('FaBlEQjFuVnPMBlASaPtvPhACaJcedNu');
$database = getenv('FaBlEQjFuVnPMBlASaPtvPhACaJcedNu@mysql.railway.internal:3306/railway');
$port = getenv('3306');

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