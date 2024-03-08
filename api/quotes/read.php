<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: GET');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    require_once '../../config/Database.php';
    //require_once '../../config/DatabaseLocal.php';
    require_once '../../models/Quote.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate quote object
  $quote = new Quote($db);

  // Quote read query
  $result = $quote->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any quotes
  if($num > 0) {
        $quote_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author_id' => $author_id,
            'category_id' => $category_id
          );

          array_push($quote_arr, $quote_item);
        }

        // Turn to JSON & output
        echo json_encode($quote_arr);

  } else {
        // No Authors
        echo json_encode(
          array('message' => 'No Quotes Found')
        );
  }