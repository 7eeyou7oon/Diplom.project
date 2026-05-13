<?php

$connect = mysqli_connect(

    getenv('MYSQLHOST'),

    getenv('MYSQLUSER'),

    getenv('MYSQLPASSWORD'),

    getenv('MYSQLDATABASE'),

    getenv('MYSQLPORT')

);

if (!$connect) {

    die('Error connect to DataBase');

}
?>