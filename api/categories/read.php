<?php
  //require_once '../../config/Database.php';
  require_once '../../config/DatabaseLocal.php';
  require_once '../../models/Category.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate author object
  $category = new Category($db);

  // Category read query
  $result = $category->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
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
        // No Authors
        echo json_encode(
          array('message' => 'category_id Not Found')
        );
  }