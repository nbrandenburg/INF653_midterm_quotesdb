<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $quote = new Quote($db);

    $quote->id = htmlspecialchars(strip_tags($data['id']));

    // Delete quote
    try {
        if($quote->id == NULL) {
            throw new Exception();
        }

        if($quote->delete()) {
            $result = array(
                'id' => $quote->id
            );

            echo json_encode($result);
        }
        else {
            throw new Exception();
        }        

    } catch(PDOException $e) {
        echo json_encode(array('message' => 'No Quotes Found'));
        
    } catch(Exception $noQuote) {
        echo json_encode(array('message' => 'No Quotes Found'));
    }