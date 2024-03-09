<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    $author->author = $data->author;

    // Create author
    if($author->create()) {
        // Create array
        $author_arr = array(
            'id' => $author->id,
            'author' => $author->author
        );

        // Make JSON
        echo json_encode($author_arr);

    } else {
        echo json_encode(array('message' => 'Author Not Created'));
    }