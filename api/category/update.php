<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog category object
$category = new Category($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// set id to update
$category->id = $data->id;

$category->name = $data->name;

// update category
if($category->update()) {
    echo json_encode(
        array('message' => 'Categoru Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Category Not Updated')
    );
}