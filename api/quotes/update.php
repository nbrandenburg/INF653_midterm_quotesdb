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

    $quote->quote = $data->quote;

    // Update post
    if($quote->update()) {
        echo json_encode(array('message' => 'Quote Updated'));
    } else {
        echo json_encode(array('message' => 'Quote not updated'));
    }
