<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    // Set ID to delete
    $author->id = $data->id;

    // Delete post
    try {
        $author->delete();

        $author_arr = array(
            'id' => $data->id,
        );

        echo json_encode($author_arr);

    } catch(PDOException $e) {

        $author_arr = array(
            'id' => $data->id,
        );

        echo json_encode($author_arr);
    }