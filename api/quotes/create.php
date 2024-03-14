<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    $quote->quote = htmlspecialchars(strip_tags($data['quote']));
    $quote->author_id = htmlspecialchars(strip_tags($data['author_id']));
    $quote->category_id = htmlspecialchars(strip_tags($data['category_id']));

    // Create quote
    try {
        if($quote->quote == NULL) {
            throw new Exception();
        }

        $quote->create();
        $id = $quote->id;
        $result = $quote->read_single($id);

        print_r(json_encode($result));

    } catch(PDOException $e) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    } catch(Exception $noCategory) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }