<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

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
