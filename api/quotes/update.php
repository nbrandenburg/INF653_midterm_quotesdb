<?php
    class NoAuthor extends Exception {}
    class NoCategory extends Exception {}
    class NoQuote extends Exception {}
    class MissingParams extends Exception {}
    
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
        // Check if all required parameters were provided
        if($quote->quote == NULL || 
           $quote->id == NULL ||
           $quote->author_id == NULL || 
           $quote->category_id == NULL) {
            throw new MissingParams();
        }

        // Check if quote id is valid
        $quote_arr = $quote->read_single($quote->id);
        if($quote_arr['quote'] != $quote->quote) {
            throw new NoQuote();
        }

        // Check if author_id is valid
        $author = new Author($db);
        $author->id = $quote->author_id;
        $author_arr = $author->read_single($author->id);
        if($author_arr['message'] != NULL) {
            throw new NoAuthor();
        }

        // Check if category_id is valid
        $category = new Category($db);
        $category->id = $quote->category_id;
        $category_arr = $category->read_single($category->id);
        if($category_arr['message'] != NULL) {
            throw new NoCategory();
        }

        $quote->update(); 
        
        $result = array(
            'id' => $quote->id,
            'quote' => $quote->quote,
            'author_id' => $quote->author_id,
            'category_id' => $quote->category_id
        );

        echo json_encode($result);

    } catch(MissingParams $e) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        
    } catch(NoQuote $noQuote) {
        echo json_encode(array('message' => 'No Quotes Found'));

    } catch(NoAuthor $noAuthor) {
        echo json_encode(array('message' => 'author_id Not Found'));

    } catch(NoCategory $noCategory) {
        echo json_encode(array('message' => 'category_id Not Found'));
    }