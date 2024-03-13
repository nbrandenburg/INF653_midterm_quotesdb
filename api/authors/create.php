<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    $author->author = htmlspecialchars(strip_tags($data['author']));

    // Create author
    try {
        if($author->author == NULL) {
            throw new Exception();
        }

        $author->create(); 
        $id = $author->id;
        $result = $author->read_single($id);

        echo json_encode($result);

    } catch(PDOException $e) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        
    } catch(Exception $noAuthor) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }