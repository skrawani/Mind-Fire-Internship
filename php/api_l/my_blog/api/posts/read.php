<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once("../../config/Database.php");
include_once("../../models/Post.php");


$database = new Database();
$db = $database->connect();


$post = new POST($db);

$res = $post->read();

$num = $res->rowCount();


if ($num > 0) {
    $post_arr = array();
    $post_arr['data'] = array();

    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'category_id' => $category_id,
            'category_name' => $category_name
        );
        array_push($post_arr['data'], $post_item);
    }

    echo json_encode($post_arr);
} else {
    echo json_decode(array('msg' => 'No Posts Found'));
}
