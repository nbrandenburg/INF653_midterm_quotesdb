<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // If id is set
    if(isset($_GET['id'])) {

        // Get ID
        $category->id = $_GET['id'];

        // Get category
        $category->read_single();

        // Create array
        $category_arr = array(
            'id' => $category->id,
            'category' => $category->category
        );

        // Check if there is an category assigned to that id
        if($category_arr['category'] != NULL) {

            // If category is not null, print json array
            echo json_encode($category_arr);

        } else {
            
            // If category is null, print message
            echo json_encode(array('message' => 'category_id Not Found'));
        }
        
    } else {

        // Id not set
        echo json_encode(array('message' => 'author_id Not Found'));
    }