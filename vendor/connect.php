<?php

    $connect = mysqli_connect('localhost', 'root', '', 'bd');

    if (!$connect) {
        die('Error connect to DataBase');
    }
