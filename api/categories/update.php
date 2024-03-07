<?php
    // Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();
    
    // Instantiate category object
    $category = new Category($db);

    // Set ID to update
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