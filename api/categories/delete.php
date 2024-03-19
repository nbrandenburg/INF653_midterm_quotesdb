<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate object
    $category = new Category($db);

    $category->id = htmlspecialchars(strip_tags($data['id']));

    // Delete category
    try {
        if($category->id == NULL) {
            throw new Exception();
        }

        $category_arr = $category->read_single($category->id);

        if($category->delete()) {

            $result = array(
                'id' => $category_arr['id']
            );

            echo json_encode($result);
        }
        else {
            throw new Exception();
        }        

    } catch(Exception $noCategory) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }