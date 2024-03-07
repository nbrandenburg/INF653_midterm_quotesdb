<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $author->id = $data->id;
    $author->author = $data->author;

    // Make sure id and author name are provided
    if($author->id != null && $author->author != null) {
        // Update author
        $author->update();
        echo json_encode(
            array('message' => 'Author Updated')
        );
    } else {
        // Missing Parameters
        echo json_encode(
        array('message' => 'Missing Required Parameters')
        );
    }