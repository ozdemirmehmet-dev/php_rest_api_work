<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/DataBase.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new DataBase();
$db = $database->connect();

// Instantiate blog category object
$category = new Category($db);

// Blog category query
$result = $category->read();
// get row count
$num = $result->rowCount();

// check if any post
if($num > 0){
    // category array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $cat_item = array(
            'id' => $id,
            'name' => $name,
        );

        // push to data
        array_push($cat_arr['data'], $cat_item);
    }
    echo json_encode($cat_arr);
}else{
    // no posts
    echo json_encode(
        array('message' => 'No Posts Found')
    );

}

?>