<?php
    class NoAuthor extends Exception {}
    class AuthorAlreadyExists extends Exception {}

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    $author->author = htmlspecialchars(strip_tags($data['author']));

    // Create author
    try {
        // Make sure author name is provided
        if($author->author == NULL) {
            throw new NoAuthor();
        }

        // Create an author array
        $author_arr = array(
            'id' => 0,
            'author' => ''
        );

        // Make sure author doesn't already exist
        $author_arr = $author->read_single($author->author);
        $name = $author_arr['author'];
        if($author->author == $name) {
            throw new AuthorAlreadyExists();
        }

        $author->create();
        $id = $author->id;
        // Fill Array with new Author data
        $author_arr = $author->read_single($id);

/*         $result = array(
            'id' => $new_author_arr['id'],
            'author' => $new_author_arr['author']
        );
 */
        echo json_encode($author_arr);

    } catch(NoAuthor $noAuthor) {
        echo json_encode(array('message' => 'Missing Required Parameters'));

    } catch(AuthorAlreadyExists $AuthorAlreadyExists) {
        
/*         $result = array(
            'id' => $author_arr['id'],
            'author' => $author_arr['author']
        );
 */
            echo json_encode($author_arr);
    }