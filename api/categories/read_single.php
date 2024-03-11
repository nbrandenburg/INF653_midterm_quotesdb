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

        // Category read query
        $result = $category->read_single();

        // Get row count
        $num = $result->rowCount();

        // Check if any Categories
        if($num > 0) {
                $category_arr = array();

                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $category_item = array(
                    'id' => $id,
                    'category' => $category
                );

                array_push($category_arr, $category_item);
                }

                // Turn to JSON & output
                echo json_encode($category_arr);

        } else {
                // No Categories
                echo json_encode(
                array('message' => 'category_id Not Found')
                );
        }
    }