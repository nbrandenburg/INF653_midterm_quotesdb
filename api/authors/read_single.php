<?php
    // Get ID
    $author->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get author
    $author->read_single();

    // Create array
    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author
    );    

    if($author_arr['author'] != 'default') {
        // Make JSON
        print_r(json_encode($author_arr));
    } else {       
        // author_id not found
        echo json_encode(
        array('message' => 'author_id Not Found')
        );
    }  