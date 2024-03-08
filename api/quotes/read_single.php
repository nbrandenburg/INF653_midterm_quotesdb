<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    // Check set parameters
    if (isset($_GET['id'])) {
        $quote->id = $_GET['id'];
    }

    if (isset($_GET['author_id'])) {
        $quote->author_id = $_GET['author_id'];
    }

    if (isset($_GET['category_id'])) {
        $quote->category_id = $_GET['category_id'];
    }

    // Get quote
    $quote->read_single();

    if ($quote->read_single()) {
        // Create array
        $quote_arr = array(
            'id' => $quote->id,
            'quote' => $quote->quote,
            'author_id' => $quote->author_id,
            'category_id' => $quote->category_id
        );

        // Make JSON
        echo json_encode($quote_arr);
    } else {
        echo json_encode(array('message' => 'No Quotes Found'));
    }