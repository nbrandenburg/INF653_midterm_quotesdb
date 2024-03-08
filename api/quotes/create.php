<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    require_once '../../config/Database.php';
    //require_once '../../config/DatabaseLocal.php';
    require_once '../../models/Quote.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $quote->quote = $data->quote;

    // Create quote
    if($quote->create()) {
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
        echo json_encode(array('message' => 'Quote Not Created'));
    }