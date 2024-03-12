<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    $author->author = $data->author;

    if(isset($_GET['author']) && $author->create()) {        
        
        $author->read_single();
    
    } else {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }