<?php
    // Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();
    
    // Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Set ID to update
    $category->id = $data->id;

    // Delete category
    if($category->delete()) {
        echo json_encode(
        array('message' => 'Category deleted')
        );
    } else {
        echo json_encode(
        array('message' => 'Category not deleted')
        );
    }
