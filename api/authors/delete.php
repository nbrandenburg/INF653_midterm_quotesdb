<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate object
    $author = new Author($db);

    // Clean input data
    $data->id = htmlspecialchars(strip_tags($data->id));
    $author->id = $data->id;

    try {
        // Make sure id is provided
        if($data->id == NULL) {
            throw new Exception();
        }

        // Store id before deletion
        $id = $data->id;

        // DELETE id
        if($author->delete()) {
            $result = array(
                'id' => $id
            );

            echo json_encode($result);
        }

    } catch(Exception $noAuthor) {
        
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }