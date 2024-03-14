<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    $category->category = htmlspecialchars(strip_tags($data['category']));

    // Create category
    try {
        if($category->category == NULL) {
            throw new Exception();
        }

        $category->create();
        $id = $category->id;
        $result = $category->read_single($id);

        print_r(json_encode($result));

    } catch(PDOException $e) {
        echo json_encode(array('message' => 'Missing Required Parameters'));

    } catch(Exception $noCategory) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }