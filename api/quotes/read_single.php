<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    // If id is set
    if(isset($_GET['id'])) {
        // Clean data
        $id = htmlspecialchars(strip_tags($_GET['id']));

        $result = $quote->read_single($id);

        // Turn to JSON and output
        echo json_encode($result);
    }

    else {
        
        // no quotes
        echo json_encode(array('message' => 'No Quotes Found'));
        exit();
    }        
    