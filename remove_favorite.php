<?php

session_start();

require_once 'vendor/connect.php';

if(empty($_SESSION['user'])){

    exit();

}

if(!isset($_POST['id'])){

    exit();

}

$user_id = $_SESSION['user']['id'];

$id = (int)$_POST['id'];

mysqli_query(

    $connect,

    "DELETE FROM favorite_services

     WHERE id='$id'
     AND user_id='$user_id'"
);

echo 'success';