<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $quote->id = $data->id;

    // Delete post
    if($quote->delete()) {
        echo json_encode(array('message' => 'Quote deleted'));
    } else {
        echo json_encode(array('message' => 'Quote not deleted'));
    }