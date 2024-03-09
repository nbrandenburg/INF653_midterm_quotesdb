<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Set ID to update
    $category->id = $data->id;

    $category->category = $data->category;

    // Update post
    if($category->update()) {
        echo json_encode(array('message' => 'Category Updated'));
    } else {
        echo json_encode(array('message' => 'Category not updated'));
    }
