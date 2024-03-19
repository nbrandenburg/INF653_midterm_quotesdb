<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate object
    $author = new Author($db);

    // Clean and decode data
    $author->author = htmlspecialchars(strip_tags($data['author']));

    try {
        // Check if parameters were provided
        if($author->author == NULL) {
            throw new Exception();
        }

        // Create
        $author->create();
        $id = $author->id;
        $author_arr = $author->read_single($id);
        $result = array(
            'id' => strval($author_arr['id']),
            'author' => $author_arr['author']
        );

        // Encode and return
        echo json_encode($result);

    } catch(Exception $noAuthor) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }