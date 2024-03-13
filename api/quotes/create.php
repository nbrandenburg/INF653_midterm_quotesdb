<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    $quote->quote = $data['quote'];
    $quote->author_id = intval($data['author_id']);
    $quote->category_id = intval($data['category_id']);

    // Create quote
    try {
        if($quote->quote == NULL ||
           $quote->author_id == NULL ||
           $quote->category_id == NULL) {
            throw new Exception();
        }

        $quote->create();

        $id = $quote->id;
        $result = isValid($id, $quote);
        $quote =  $result['quote'];

        // Get author_id
        $authorModel = "author";
        $author_id = intval($quote->author_id);
        $author_arr = isValid($author_id, $authorModel);
        $author_id = $author_arr['id'];

        // Get category_id
        $category_arr = isValid($quote->category_id, $category);
        $category_id = $category_arr['id'];

        $quotes_arr = array(
            $id,
            $quote,
            $author_id,
            $category_id
        );

        echo json_encode($quotes_arr);

    } catch(PDOException $e) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    } catch(Exception $noQuote) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }

    // Create quote
    if($quote->create()) {

        $result = $quote->read_single();

        // Get row count
        $num = $result->rowCount();

        // Check if any quotes
        if($num > 0) {
            
            $quote_arr = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $quote_arr = array(
                    'id' => $id,
                    'quote' => $quote,
                    'author_id' => $author_id,
                    'category_id' => $category_id
                );

                // Turn to JSON & output
                echo json_encode($quote_arr);
            }
        }

    } else {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }