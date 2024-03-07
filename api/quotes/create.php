<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    // require_once '../../config/DatabaseLocal.php';
    require_once '../../config/Database.php';
    require_once '../../models/Quote.php';

    // Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $quote = new Quote($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $quote->quote = $data->quote;

    // Create Author
    if($quote->create()) {
        echo json_encode(
        array('message' => 'Quote Created')
        );
    } else {
        echo json_encode(
        array('message' => 'Quote Not Created')
        );
    }