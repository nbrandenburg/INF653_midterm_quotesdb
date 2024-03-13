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