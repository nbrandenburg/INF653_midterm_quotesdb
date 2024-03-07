<?php
    // Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

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