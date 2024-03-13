<?php
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    $category->id = htmlspecialchars(strip_tags($data['id']));

    // Delete category
    try {
        if($category->id == NULL) {
            throw new Exception();
        }

        if($category->delete()) {
            $result = array(
                'id' => $category->id
            );

            echo json_encode($result);
        }
        else {
            throw new Exception();
        }        

    } catch(PDOException $e) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        
    } catch(Exception $noCategory) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }