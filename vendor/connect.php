<?php

$connect = mysqli_connect(
    'mysql.railway.internal',
    'mysql://root:FaBlEQjFuVnPMBlASaPtvPhACaJcedNu@mysql.railway.internal:3306/railway',
    'FaBlEQjFuVnPMBlASaPtvPhACaJcedNu',
    'railway',
    3306
);

if (!$connect) {
    die('Error connect to DataBase');
}
?>