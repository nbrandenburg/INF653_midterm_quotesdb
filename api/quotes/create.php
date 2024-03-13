<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    $quote->quote = htmlspecialchars(strip_tags($data['quote']));
    $quote->author_id = htmlspecialchars(strip_tags($data['author_id']));
    $quote->category_id = htmlspecialchars(strip_tags($data['category_id']));

    // Make sure author_id is valid
    $author_arr -> $author->read_single($quote->author_id);
    if($quote->author_id != $author_arr['id']) {
        echo json_encode($author_arr);
        exit();
    }
    
    // Make sure category_id is valid
    $category_arr -> $category->read_single($quote->category_id);
    if($quote->category_id != $category_arr['id']) {
        echo json_encode($category_arr);
        exit();
    }   
    

    // Create quote
    try {
        if($quote->quote == NULL) {
            throw new Exception();
        }

        $quote->create();
        $id = $quote->id;
        $result = $quote->read_single($id);

        echo json_encode($result);

    } catch(PDOException $e) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    } catch(Exception $noCategory) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }