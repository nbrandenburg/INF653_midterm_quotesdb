<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    // require_once '../../config/DatabaseLocal.php';
    require_once '../../config/Database.php';
    require_once '../../models/Author.php';

    // Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->author)) {
        $author->author = $data->author;
    } 

    // Make sure author name is provided
    if ($author->author == null) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }

    // Create author
    else {
        $author->create();
        echo json_encode(array('message' => 'Author Created'));
    }