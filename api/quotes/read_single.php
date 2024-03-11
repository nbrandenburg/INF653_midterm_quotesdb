<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    // Check set parameters
    // If id is set
    if(isset($_GET['id'])) {
        // Get id
        $quote->id = $_GET['id'];
    }

    // Get quote
    $quote->read_single();

    // Create array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author,
        'category' => $quote->category
    );

    // Check if there is an quote assigned to that id
    if($quote_arr['quote'] != NULL) {

        // If quote is not null, print json array
        echo json_encode($quote_arr);

    } else {
        
        // If quote is null, print message
        echo json_encode(array('message' => 'No Quote Found'));
        exit();
    }        
    