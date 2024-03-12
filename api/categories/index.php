<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD']; 

    // Required for tests
    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    } 

    require_once '../../config/Database.php';
    //require_once '../../config/DatabaseLocal.php';
    require_once '../../models/Category.php';
    require_once '../../functions/isValid.php';  
    
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Read
    if ($method === 'GET' && !isset($_GET['id'])) {
        header('Access-Control-Allow-Methods: GET');
        require_once 'read.php';    
    }

    // Read Single
    elseif ($method === 'GET' && isset($_GET['id'])) {
        header('Access-Control-Allow-Methods: GET');
        require_once 'read_single.php';    
    }

    // Create
    elseif ($method === 'POST') {
        header('Access-Control-Allow-Methods: POST');
        require_once 'create.php';
    }
    
    // Update
    elseif ($method === 'PUT') {
        header('Access-Control-Allow-Methods: PUT');
        require_once 'update.php';
    }
    
    // Delete
    elseif ($method === 'DELETE') {
        header('Access-Control-Allow-Methods: DELETE');
        require_once 'delete.php';
    }
?>