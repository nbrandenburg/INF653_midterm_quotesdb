<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    // require_once '../../config/DatabaseLocal.php';
    require_once '../../config/Database.php';
    require_once '../../models/Category.php';

    // Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->category)) {
        $category->category = $data->category;
    } 

    // Make sure category name is provided
    if ($category->category == null) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }

    // Create category
    else {
        $category->create();
        echo json_encode(array('message' => 'Category Created'));
    }