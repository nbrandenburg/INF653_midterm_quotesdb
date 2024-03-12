<?php
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate author object
  $author = new Author($db);

  $author->author = $data->author;

  // Create author
  if($author->create()) {

        // Author read_single query
        $result = $author->read_single();

        // Get row count
        $num = $result->rowCount();

        // Check if any Authors
        if($num > 0) {
            $author_arr = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $author_arr = array(
                    'id' => $id,
                    'author' => $author
                );

                // Turn to JSON & output
                echo json_encode($author_arr);
            }
        }

    } else {
        echo json_encode(
        array('message' => 'Missing Required Parameters'));
    }