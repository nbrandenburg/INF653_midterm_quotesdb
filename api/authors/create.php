<?php
    // Instantiate author object
    $author = new Author($db);

    if(!empty($data->author)) {
        $author->author = $data->author;
    } 

    // Make sure author name is provided
    if ($author->author == null) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }

    // Create author
    else {
        $author->create();
        echo json_encode(array('message' => 'Author Created'));
    }