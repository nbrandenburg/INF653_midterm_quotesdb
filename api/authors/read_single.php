<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    // If id is set
    if(isset($_GET['id'])) {

        // Get ID
        $author->id = $_GET['id'];

        // Get author
        $author->read_single();

        // Create array
        $author_arr = array(
            'id' => $author->id,
            'author' => $author->author
        );

        // Check if there is an author assigned to that id
        if($author_arr['author'] != NULL) {
            // If author is not null, print json array
            echo json_encode($author_arr);

        } else {
            // If author is null, print message
            echo json_encode(array('message' => 'author_id Not Found'));
        }
        
    } else {

        // Id not set
        echo json_encode(array('message' => 'author_id Not Found'));
    }