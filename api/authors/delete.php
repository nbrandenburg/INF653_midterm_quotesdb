<?php
    class NoAuthor extends Exception {}

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    // Clean input data
    $author->id = htmlspecialchars(strip_tags($data['id']));

    try {
        // author id must be provided
        if($author->id == NULL) {
            throw new NoAuthor();
        }

        // delete author
        if($author->delete()) {

            // return id of deleted author in json
            $result = array(
                'id' => $author_arr['id']
            );

            echo json_encode($result);
        }
        else {
            throw new Exception();
        }        

    } catch(NoAuthor $noAuthor) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        
    } catch(Exception $authorNotDeleted) {
        echo json_encode(array('message' => 'Author Not Deleted'));
    }