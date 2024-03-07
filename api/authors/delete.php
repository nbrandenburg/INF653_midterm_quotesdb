<?php
    // Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    // Set ID to delete
    $author->id = $data->id;

    if($author->delete()) {
        echo json_encode(
        array('message' => 'Author deleted')
        );
    } else {
        echo json_encode(
        array('message' => 'Author not deleted')
        );
    }
