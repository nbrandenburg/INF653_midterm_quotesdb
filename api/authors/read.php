<?php 
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate author object
  $author = new Author($db);

  // Author read query
  $result = $author->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any authors
  if($num > 0) {
        $author_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $author_item = array(
            'id' => $id,
            'author' => $author
          );

          array_push($author_arr, $author_item);
        }

        // Turn to JSON & output
        echo json_encode($author_arr);

  } else {
        // No Authors
        echo json_encode(
          array('message' => 'author_id Not Found')
        );
  }