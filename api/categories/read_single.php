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

        // category read_single query
        $result = $category->read_single();

        // Get row count
        $num = $result->rowCount();

        // Check if any categories
        if($num > 0) {
            $category_arr = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $category_arr = array(
                    'id' => $id,
                    'category' => $category
                );

                // Turn to JSON & output
                echo json_encode($category_arr);
            }

        } else {
                // No Categories
                echo json_encode(
                array('message' => 'category_id Not Found')
                );
        }
    }