<?php
    //require_once '../../config/Database.php';
    require_once '../../config/DatabaseLocal.php';
    require_once '../../models/Author.php';   

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    // Set ID to delete
    $author->id = $data->id;

    // Delete post
    if($author->delete()) {
        echo json_encode(array('message' => 'Author deleted'));
    } else {
        echo json_encode(array('message' => 'Author not deleted'));
    }