<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    // require_once '../../config/DatabaseLocal.php';
    require_once '../../config/Database.php';
    require_once '../../models/Category.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to UPDATE
    $category->id = $data->id;
    $category->category = $data->category;

    // Make sure id and category name are provided
    if($category->id != null && $category->category != null) {
        // Update category
        $category->update();
        echo json_encode(
            array('message' => 'Category Updated')
        );
    } else {
        // Missing Parameters
        echo json_encode(
        array('message' => 'Missing Required Parameters')
        );
    }