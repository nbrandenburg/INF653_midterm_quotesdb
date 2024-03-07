<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');

    //require_once '../../config/DatabaseLocal.php';
    require_once '../../config/Database.php';
    require_once '../../models/Author.php';

    // Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    $method = $_SERVER['REQUEST_METHOD'];

    // required for tests
    if ($method === 'OPTIONS') { 
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        exit();
    }

    // read
    elseif ($method === 'GET' && !isset($_GET['id'])) {
        header('Access-Control-Allow-Methods: GET');
        require_once 'read.php';
    }

    // read_single
    elseif ($method === 'GET' && isset($_GET['id'])) {
        header('Access-Control-Allow-Methods: GET');
        require_once 'read_single.php';
    }

    // create
    elseif ($method === 'POST') {
        header('Access-Control-Allow-Methods: POST');
        require_once 'create.php';
    }

    // update
    elseif ($method === 'PUT') {
        header('Access-Control-Allow-Methods: PUT');
        require_once 'update.php';
    }

    // delete
    elseif ($method === 'DELETE') {
        header('Access-Control-Allow-Methods: DELETE');
        require_once 'delete.php';
    }