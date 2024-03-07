<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

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