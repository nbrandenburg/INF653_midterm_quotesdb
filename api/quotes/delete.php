<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    // Set ID to delete
    $quote->id = $data->id;

    // Delete quote

    if($quote->delete()) {

            $quote_arr = array(
                'id' => $data->id
            );

            // Turn to JSON & output
            echo json_encode($quote_arr);

    } else {
        echo json_encode(array('message' => 'No Quotes Found'));
    }