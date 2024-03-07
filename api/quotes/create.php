<?php
    // Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();
    
    // Instantiate quote object
    $quote = new Quote($db);

    $quote->quote = $data->quote;

    // Create Quote
    if($quote->create()) {
        echo json_encode(
        array('message' => 'Quote Created')
        );
    } else {
        echo json_encode(
        array('message' => 'Quote Not Created')
        );
    }