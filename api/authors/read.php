<?php
    // Author query
    $result = $author->read();
    // Get row count
    $num = $result->rowCount();

    // Check if any authors
    if($num > 0) {
        // Author array
        $authors_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $author_item = array(
                'id' => $id,
                'author' => $author
            );

            // Push to authors_arr
            array_push($authors_arr, $author_item);
        }

        // Turn to JSON & output
        echo json_encode($authors_arr);

    } else {       
        // No Authors 
        echo json_encode(
        array('message' => 'author_id Not Found')
        );
    }