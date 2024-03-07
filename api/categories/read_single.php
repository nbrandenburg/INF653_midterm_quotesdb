<?php
    // Instantiate category object
    $category = new Category($db);

    // Get ID
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get category
    $category->read_single();

    // Create array
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );    

    if($category_arr['category'] != 'default') {
        // Make JSON
        print_r(json_encode($category_arr));
    } else {       
        // category_id not found
        echo json_encode(
        array('message' => 'category_id Not Found')
        );
    }  