<?php
    // Instantiate quote object
    $quote = new Quote($db);

    // Quote query
    $result = $quote->read();
    // Get row count
    $num = $result->rowCount();

    // Check if any quotes
    if($num > 0) {
        // Quote array
        $quotes_arr = array();
        $quotes_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $quote_item = array(
                'id' => $id,
                'quote' => $quote,
                'author_id' => $author_id,
                'category_id' => $category_id
            );

            // Push to "data"
            array_push($quotes_arr['data'], $quote_item);
        }

        // Turn to JSON & output
        echo json_encode($quotes_arr);

    } else {
        // No Quotes
        echo json_encode(
        array('message' => 'No Quotes Found')
        );
    }