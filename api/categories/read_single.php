<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // If id is set
    if(isset($_GET['id'])) {

        // Clean data
        $id = htmlspecialchars(strip_tags($_GET['id']));

        $result = $category->read_single($id);

        // Turn to JSON & output
        echo json_encode($result);
    }
    
    else {
        // No categories
        echo json_encode(
        array('message' => 'category_id Not Found'));
    }