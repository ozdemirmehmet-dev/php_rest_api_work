<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/DataBase.php';
include_once '../../models/Post.php';

// Instantiate DB & connect
$database = new DataBase();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Blog post query
$result = $post->read();
// get row count
$num = $result->rowCount();

// check if any post
if($num > 0){
    // Post array
    $posts_arr = array();
    $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        // push to data
        array_push($posts_arr['data'], $post_item);
    }
    echo json_encode($posts_arr);
}else{
    // no posts
    echo json_encode(
        array('message' => 'No Posts Found')
    );

}

?>