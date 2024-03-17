<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    $author->author = htmlspecialchars(strip_tags($data['author']));

    // Create author
    try {
        if($author->author == NULL) {
            throw new Exception();
        }

        $author->create();
        $id = $author->id;
        $author_arr = $author->read_single($id);
        $result = array(
            'id' => $author_arr['id'],
            'author' => $author_arr['author']
        );

        echo json_encode($result);

    } catch(Exception $noAuthor) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }