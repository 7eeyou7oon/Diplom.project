<?php

session_start();

require_once 'vendor/connect.php';



$user_id = $_SESSION['user']['id'] ?? 0;



$name = $_POST['name'] ?? '';

$phone = $_POST['phone'] ?? '';

$service = $_POST['service'] ?? '';

$comment = $_POST['message'] ?? '';


$service_sql = mysqli_real_escape_string(
    $connect,
    $service
);

$comment_sql = mysqli_real_escape_string(
    $connect,
    $comment
);


mysqli_query(

    $connect,

    "INSERT INTO orders
    (user_id, service_name, comment)

    VALUES

    ('$user_id', '$service_sql', '$comment_sql')"

);



$data = [

    "name" => $name,

    "phone" => $phone,

    "service" => $service,

    "comment" => $comment

];

$options = [

    "http" => [

        "header"  =>
            "Content-type: application/json\r\n",

        "method"  => "POST",

        "content" => json_encode($data)

    ]

];

$context = stream_context_create($options);



$result = file_get_contents(

    "https://telegram-ai-bot-j21p.onrender.com/create-order",

    false,

    $context

);

echo json_encode([
    "status" => "success"
]);

?>