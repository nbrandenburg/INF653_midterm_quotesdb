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

        if($author->create()) {
            
            $id = $author->id;
            $model = "author";
            $result = isValid($id, $model);
    
            echo json_encode($result);

        } else {
            throw new Exception();
        }        

    } catch(PDOException $e) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        
    } catch(Exception $noAuthor) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }