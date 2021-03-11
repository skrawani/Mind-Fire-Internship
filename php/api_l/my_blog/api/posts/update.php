<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, 
Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

include_once("../../config/Database.php");
include_once("../../models/Post.php");

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    echo json_encode(array("message" => "Action Not Allowed"));
    exit;
}

$database = new Database();
$db = $database->connect();

$post = new POST($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;
$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;


if ($post->update()) {
    echo json_encode(
        array('message' => 'Post Update')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Updated!!')
    );
}
