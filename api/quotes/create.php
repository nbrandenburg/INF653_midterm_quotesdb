<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

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