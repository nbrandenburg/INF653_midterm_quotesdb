<?php
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $category = new Category($db);

  $category->category = $data->category;

  // Create category
  if($category->create()) {

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
        }

    } else {
        echo json_encode(
        array('message' => 'Missing Required Parameters'));
    }