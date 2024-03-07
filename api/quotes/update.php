<?php
    // Instantiate quote object
    $quote = new Quote($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to UPDATE
    $quote->id = $data->id;
    $quote->quote = $data->quote;

    // Update quote
    if($quote->update()) {
        echo json_encode(
        array('message' => 'Quote Updated')
        );
    } else {
        echo json_encode(
        array('message' => 'Quote not updated')
        );
    }
