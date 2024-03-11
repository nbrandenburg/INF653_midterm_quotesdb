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

    // If author_id is set
    if(isset($_GET['author_id'])) {
        // Get author_id
        $quote->author_id = $_GET['author_id'];
    }

    // If category_id is set
    if(isset($_GET['category_id'])) {
        // Get category_id
        $quote->category_id = $_GET['category_id'];
    }

    // If no parameters are set, return json message
    if(!isset($_GET['id']) && !isset($_GET['author_id']) && !isset($_GET['category_id'])) {
        echo json_encode(array('message' => 'No Quote Found'));
    }

    // If both author_id and category_id are set
    elseif(isset($_GET['author_id']) && isset($_GET['category_id'])) {
        // Get author_id
        $quote->author_id = $_GET['author_id'];

        // Get category_id
        $quote->category_id = $_GET['category_id'];
    }

    // If only author_id is set
    elseif(isset($_GET['author_id'])) {
        // Get author_id
        $quote->author_id = $_GET['author_id'];
    }

    // If only category_id is set
    elseif(isset($_GET['category_id'])) {
        // Get category_id
        $quote->category_id = $_GET['category_id'];
    }

    // If id is set
    elseif(isset($_GET['id'])) {
        // Get ID
        $quote->id = $_GET['id'];
    }
    
    // Get quote
    $quote->read_single();

    // Create array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author_id' => $quote->author_id,
        'category_id' => $quote->category_id
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
    