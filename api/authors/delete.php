<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate object
    $author = new Author($db);

    $author->id = htmlspecialchars(strip_tags($data['id']));

    // Delete author
    try {
        if($author->id == NULL) {
            throw new Exception();
        }

        $author_arr = $author->read_single($author->id);

        if($author->delete()) {

            $result = array(
                'id' => $author_arr['id']
            );

            echo json_encode($result);
        }
        else {
            throw new Exception();
        }        

    } catch(Exception $noAuthor) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }