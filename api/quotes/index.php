<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require_once '../../models/Quote.php';

    $method = $_SERVER['REQUEST_METHOD'];

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // required for testing
    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    // read
    elseif ($method === 'GET' && !isset($_GET['id'])) {
        header('Access-Control-Allow-Methods: GET');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        require_once 'read.php';
    }

    // read_single
    elseif ($method === 'GET' && isset($_GET['id'])) {
        header('Access-Control-Allow-Methods: GET');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        require_once 'read_single.php';
    }

    // create
    elseif ($method === 'POST') {
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        require_once 'create.php';
    }

    // update
    elseif ($method === 'PUT') {
        header('Access-Control-Allow-Methods: PUT');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        require_once 'update.php';
    }

    // delete
    elseif ($method === 'DELETE') {
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        require_once 'delete.php';
    }