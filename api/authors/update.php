<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    if($author->update()) {
        
        // Author read_single query
        $result = $author->read_single();

        // Get row count
        $num = $result->rowCount();

        // Check if any Authors
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
            echo json_encode(array('message' => 'Missing Required Parameters'));
        }
    }