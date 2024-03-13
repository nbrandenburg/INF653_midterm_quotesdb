<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $quote = new Quote($db);

    $quote->quote = htmlspecialchars(strip_tags($data['quote']));
    $quote->id = htmlspecialchars(strip_tags($data['id']));
    $quote->author_id = htmlspecialchars(strip_tags($data['author_id']));
    $quote->category_id = htmlspecialchars(strip_tags($data['category_id']));

    // Make sure quote id is valid
    $quote_arr -> $quote->read_single($quote->id);
    if($quote->id != $quote_arr['id']) {
        echo json_encode($quote_arr);
        exit();
    }

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


    // Update quote
    try {
        if($quote->quote == NULL || 
           $quote->id == NULL ||
           $quote->author_id == NULL || 
           $quote->category_id == NULL) {
            throw new Exception();
        }

        $quote->update(); 
        
        $result = array(
            'id' => $quote->id,
            'quote' => $quote->quote,
            'author_id' => $quote->author_id,
            'category_id' => $quote->category_id
        );

        echo json_encode($result);

    } catch(PDOException $e) {
        echo json_encode(array('message' => 'No Quotes Found'));
        
    } catch(Exception $noQuote) {
        echo json_encode(array('message' => 'No Quotes Found'));
    }