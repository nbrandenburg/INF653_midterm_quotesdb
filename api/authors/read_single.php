<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    // If id is set
    if(isset($_GET['id'])) {

        $id = htmlspecialchars(strip_tags($_GET['id']));

        $result = isValid($id, $author);

        // Turn to JSON & output
        echo json_encode($result);
    }
    
    else {
        // No Authors
        echo json_encode(
        array('message' => 'author_id Not Found'));
    }