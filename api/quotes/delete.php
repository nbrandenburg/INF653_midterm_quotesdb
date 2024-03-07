<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    // require_once '../../config/DatabaseLocal.php';
    require_once '../../config/Database.php';
    require_once '../../models/Quotes.php';

    // Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to UPDATE
    $quote->id = $data->id;

    // Delete post
    if($quote->delete()) {
        echo json_encode(
        array('message' => 'Quote deleted')
        );
    } else {
        echo json_encode(
        array('message' => 'Quote not deleted')
        );
    }
