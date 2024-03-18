<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate object
    $author = new Author($db);

    // Clean and decode input data
    $author->id = htmlspecialchars(strip_tags($data['id']));

    try {
        // Make sure id is valid
        if($author->id == NULL) {
            throw new Exception();
        }

        $author_arr = $author->read_single($author->id);
        if($author->delete()) {
            $id = $author->id;
            $result = array(
                'id' => $id
            );

            echo json_encode($result);
        }

    } catch(Exception $noAuthor) {
        
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }