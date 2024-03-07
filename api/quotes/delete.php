<?php
    // Instantiate quote object
    $quote = new Quote($db);

    // Set ID to update
    $quote->id = $data->id;

    // Delete quote
    if($quote->delete()) {
        echo json_encode(
        array('message' => 'Quote deleted')
        );
    } else {
        echo json_encode(
        array('message' => 'Quote not deleted')
        );
    }
