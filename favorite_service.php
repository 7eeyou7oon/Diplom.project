<?php

session_start();

require_once 'vendor/connect.php';

if(empty($_SESSION['user'])){

    header('Location: auth.php');
    exit();

}

if(!isset($_GET['service'])){

    header('Location: index.php');
    exit();

}

$user_id = $_SESSION['user']['id'];

$service_name = $_GET['service'];

$service_name = mysqli_real_escape_string(
    $connect,
    $service_name
);

$check = mysqli_query(

    $connect,

    "SELECT * FROM favorite_services

     WHERE user_id='$user_id'
     AND service_name='$service_name'"
);

if(mysqli_num_rows($check) == 0){

    mysqli_query(

        $connect,

        "INSERT INTO favorite_services
        (user_id, service_name)

        VALUES

        ('$user_id', '$service_name')"
    );

}

header('Location: index.php');