<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    $author->author = htmlspecialchars(strip_tags($data['author']));
    $author->id = htmlspecialchars(strip_tags($data['id']));


    // Update author
    try {
        if($author->author == NULL || $author->id == NULL) {
            throw new Exception();
        }

        $author->update(); 
        $id = $author->id;
        $result = $author->read_single($id);

        echo json_encode($result);

    } catch(PDOException $e) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        
    } catch(Exception $noAuthor) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }