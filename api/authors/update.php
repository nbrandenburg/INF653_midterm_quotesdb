<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    // require_once '../../config/DatabaseLocal.php';
    require_once '../../config/Database.php';
    require_once '../../models/Author.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $author->id = $data->id;
    $author->author = $data->author;

    // Make sure id and author name are provided
    if($author->id != null && $author->author != null) {
        // Update author
        $author->update();
        echo json_encode(
            array('message' => 'Author Updated')
        );
    } else {
        // Missing Parameters
        echo json_encode(
        array('message' => 'Missing Required Parameters')
        );
    }