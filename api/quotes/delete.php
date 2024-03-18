<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate object
    $quote = new Quote($db);

    $quote->id = htmlspecialchars(strip_tags($data['id']));

    // Delete quote
    try {
        // Make sure id is valid
        if($quote->id == NULL) {
            throw new Exception();
        }

        $quote_arr = $quote->read_single($quote->id);
        if($quote_arr['quote'] == NULL) {
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

    } catch(Exception $noQuote) {
        echo json_encode(array('message' => 'No Quotes Found'));
    }