<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    $category->category = $data->category;

    // Create category
    if($category->create()) {
        // Create array
        $category_arr = array(
            'id' => $category->id,
            'category' => $category->category
        );

        // Make JSON
        echo json_encode($category_arr);

    } else {
        echo json_encode(array('message' => 'Category Not Created'));
    }