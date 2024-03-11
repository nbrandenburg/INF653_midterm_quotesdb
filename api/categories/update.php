<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Set ID to update
    $category->id = $data->id ?? NULL;
    $category->category = $data->category ?? NULL;

    // Category update query
    $updateResult = $category->update();

    if($updateResult) {
        // Category read_single query
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
            echo json_encode(array('message' => 'Missing Required Parameters'));
        }
    }