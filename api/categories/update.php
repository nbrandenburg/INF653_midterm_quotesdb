<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $category = new Category($db);

    $category->category = htmlspecialchars(strip_tags($data['category']));
    $category->id = htmlspecialchars(strip_tags($data['id']));


    // Update category
    try {
        if($category->category == NULL || $category->id == NULL) {
            throw new Exception();
        }

        $category->update(); 
        $id = $category->id;
        $result = $category->read_single($id);

        echo json_encode($result);

    } catch(PDOException $e) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        
    } catch(Exception $noCategory) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }