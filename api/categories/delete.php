<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Set ID to delete
    $category->id = $data->id;

    // Delete post
    try {
        $category->delete();

        $category_arr = array(
            'id' => $data->id,
        );

        echo json_encode($category_arr);

    } catch(PDOException $e) {

        $category_arr = array(
            'id' => $data->id,
        );

        echo json_encode($category_arr);
    }